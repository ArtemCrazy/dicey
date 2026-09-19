<?php
// Run over authenticated SSH stdin, never upload as a web-accessible endpoint.
if ( PHP_SAPI !== 'cli' ) { exit(1); }
chdir('daysi');
require 'wp-load.php';
if ( strpos(home_url(), 'korovai.crazytest.ru/daysi') === false ) { throw new Exception('Preview only'); }
$mode = $argv[1] ?? 'inspect';
if ($mode === 'inspect') {
    foreach (get_posts(array('post_type'=>'product','post_status'=>'publish','numberposts'=>8)) as $p) {
        $o=dicey_monthly_five_day_option($p->ID);
        $wc=wc_get_product($p->ID);
        echo json_encode(array('id'=>$p->ID,'name'=>$p->post_title,'option'=>$o,'purchasable'=>$wc->is_purchasable(),'stock'=>$wc->is_in_stock(),'managed'=>$wc->managing_stock(),'consultation'=>dicey_is_consultation_product($p->ID),'price'=>$wc->get_price(),'terms'=>dicey_get_product_meta($p->ID)['terms'],'details'=>dicey_product_menu_price_details($p->ID,array(),'5 дней')),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES)."\n";
    }
    exit;
}
// Dedicated, hidden-from-catalog fixtures. Existing menus and prices are untouched.
$ids=get_option('dicey_monthly_qa_ids',array());
if ($mode === 'setup') {
    if (!$ids) {
        foreach (array('Исходное меню', 'Замена +100 ₽', 'Не разрешённое меню') as $i=>$title) {
            $p=new WC_Product_Simple();
            $p->set_name('ТЕСТ месячного заказа — '.$title);
            $p->set_status('publish');
            $p->set_catalog_visibility('hidden');
            $p->set_regular_price(1200);
            $p->set_manage_stock(false);
            $id=$p->save(); $ids[]=$id;
            update_post_meta($id,'_dicey_product_terms',"3 дня\n5 дней\n1 месяц");
            $examples=array();
            foreach (array(400+$i*100,300,500,600,700) as $n=>$price) {
                $examples[]=array('title'=>'Тестовое блюдо '.($n+1),'price'=>(string)$price);
            }
            update_post_meta($id,'_dicey_product_menu_examples',$examples);
        }
        update_option('dicey_monthly_qa_ids',$ids,false);
    }
    foreach ($ids as $i=>$id) {
        carbon_set_post_meta($id,'dicey_product_terms',array('3 дня','5 дней','1 месяц'));
        $examples=array();
        foreach (array(400+$i*100,300,500,600,700) as $n=>$price) {
            $examples[]=array('title'=>'Тестовое блюдо '.($n+1),'price'=>(string)$price);
        }
        carbon_set_post_meta($id,'dicey_product_menu_examples',$examples);
    }
    update_post_meta($ids[0],'_dicey_monthly_replacements',array($ids[1]));
    echo json_encode(array('ids'=>$ids,'url'=>get_permalink($ids[0]),'admin'=>admin_url('post.php?post='.$ids[0].'&action=edit'),'options'=>dicey_monthly_options($ids[0])),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES)."\n";
    exit;
}
if ($mode === 'verify') {
    if (count($ids)!==3) { throw new Exception('Fixtures missing'); }
    $admins=get_users(array('role'=>'administrator','number'=>1));
    wp_set_current_user($admins[0]->ID);
    require_once ABSPATH . 'wp-admin/includes/template.php';
    require_once ABSPATH . 'wp-admin/includes/class-wp-screen.php';
    require_once ABSPATH . 'wp-admin/includes/screen.php';
    set_current_screen('product');
    dicey_add_monthly_settings_box();
    if (!isset($GLOBALS['wp_meta_boxes']['product']['normal']['default']['dicey_monthly_settings'])) { throw new Exception('Admin box not registered'); }
    ob_start(); dicey_render_monthly_settings(get_post($ids[0])); $admin_html=ob_get_clean();
    if (strpos($admin_html,'name="dicey_monthly_nonce"')===false || strpos($admin_html,'name="dicey_monthly_replacements[]"')===false) { throw new Exception('Admin controls missing'); }
    $_POST=array('dicey_monthly_settings_present'=>1,'dicey_monthly_nonce'=>wp_create_nonce('dicey_monthly_settings'),'dicey_monthly_replacements'=>array($ids[1]));
    dicey_save_monthly_settings($ids[0]);
    if (dicey_monthly_allowed_ids($ids[0])!==array($ids[1])) { throw new Exception('Admin save'); }
    echo "PASS actual product admin box, nonce-protected save, Carbon Fields coexistence.\n";
    wp_set_current_user(0);
    unset($GLOBALS['current_screen']);
    if (!WC()->cart) { wc_load_cart(); }
    $_POST=array('dicey_product_period'=>'1 месяц','dicey_monthly_products'=>implode(',',array($ids[0],$ids[1],$ids[0],$ids[0],$ids[0],$ids[0])));
    if (!dicey_monthly_validate_add(true,$ids[0],1)) { throw new Exception('Validation'); }
    $key=WC()->cart->add_to_cart($ids[0],1);
    WC()->cart->calculate_totals();
    $line=WC()->cart->get_cart()[$key];
    if ((float)$line['data']->get_price()!==15100.0) { throw new Exception('Cart price'); }
    $errors=new WP_Error(); dicey_monthly_validate_checkout(array(),$errors);
    if ($errors->has_errors()) { throw new Exception('Checkout rejected'); }
    $order_item=new WC_Order_Item_Product();
    dicey_save_order_item_period($order_item,$key,$line,null);
    if (count($order_item->get_meta('_dicey_monthly_blocks'))!==6) { throw new Exception('Order snapshot'); }
    echo "PASS real WooCommerce cart, totals, checkout validation, order-line metadata (no order saved, no payment).\n";
    WC()->cart->empty_cart();
    $variable=wc_get_products(array('type'=>'variable','status'=>'publish','limit'=>1));
    if ($variable) {
        $root=$variable[0]->get_id();
        $saved=get_post_meta($root,'_dicey_monthly_replacements',true);
        try {
            update_post_meta($root,'_dicey_monthly_replacements',array($ids[1]));
            $periods=dicey_get_wc_product_period_options($root);
            foreach ($periods as $period) {
                if (dicey_product_period_day_count($period['label'])!==30) { continue; }
                $_POST=array('dicey_product_period'=>$period['label'],'dicey_monthly_products'=>implode(',',array($root,$ids[1],$root,$root,$root,$root)));
                if (!dicey_monthly_validate_add(true,$root,1,$period['variation_id'])) { throw new Exception('Monthly variation validation'); }
                $expected=dicey_monthly_details($root,$_POST['dicey_monthly_products'],$period['variation_id']);
                $key=WC()->cart->add_to_cart($root,1,$period['variation_id'],$period['attributes']);
                WC()->cart->calculate_totals();
                if (!$key || (float)WC()->cart->get_cart()[$key]['data']->get_price()!==$expected['total']) { throw new Exception('Variable cart price'); }
                $short=current(array_filter($periods,function($p){return dicey_product_period_day_count($p['label'])===5;}));
                if ($short && dicey_monthly_validate_add(true,$root,1,$short['variation_id'])) { throw new Exception('Wrong variation allowed'); }
                echo "PASS real WooCommerce monthly variation and rejection of a mismatched five-day variation.\n";
                break;
            }
        } finally {
            update_post_meta($root,'_dicey_monthly_replacements',$saved);
            WC()->cart->empty_cart();
        }
    }
    exit;
}
throw new Exception('Unknown mode');
