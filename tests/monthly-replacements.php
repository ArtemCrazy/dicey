<?php
require __DIR__ . '/menu-commerce.php';
class WP_Error {
    public $errors = array();
    function __construct( $code = '', $message = '' ) { if ($code) { $this->add($code,$message); } }
    function add( $code, $message ) { $this->errors[$code] = $message; }
    function get_error_message() { return reset($this->errors); }
}
function is_wp_error($value) { return $value instanceof WP_Error; }
function get_post_status($id) { return $GLOBALS['statuses'][$id] ?? 'publish'; }
function get_post_type($id) { return isset($GLOBALS['fixture'][$id]) ? 'product' : 'page'; }
function get_the_title($id) { return 'Menu ' . $id; }
function get_posts($args) { return array_values(array_filter(array_keys($GLOBALS['fixture']), function($id){return get_post_status($id)==='publish';})); }
function wc_add_notice($message,$type) { $GLOBALS['notices'][] = $message; }
function wp_verify_nonce($nonce,$action) { return $nonce === 'valid' && $action === 'dicey_monthly_settings'; }
function current_user_can(...$args) { return $GLOBALS['can_edit'] ?? true; }
function update_post_meta($id,$key,$value) { $GLOBALS['fixture'][$id][$key] = $value; }
function esc_html($value) { return htmlspecialchars($value,ENT_QUOTES); }
class TestOrderItem {
    public $meta = array();
    function add_meta_data($key,$value,$unique) { $this->meta[$key] = $value; }
}
$fixture[1]['_dicey_product_menu_examples'][4]['price'] = '700';
$fixture[1]['_dicey_product_match_age_groups']=array('adult');
$fixture[1]['_dicey_product_match_weight_min']='3';
$fixture[1]['_dicey_product_match_weight_max']='5';
$fixture[1]['_dicey_product_match_breeds']=array('Мопс');
$fixture[2] = $fixture[1];
$fixture[2]['_dicey_product_match_breeds']=array('Мальтипу');
$fixture[2]['_dicey_product_menu_examples'][0]['price'] = '500';
$fixture[3] = $fixture[2];
$fixture[3]['_dicey_product_match_age_groups']=array('senior');
$fixture[1]['_dicey_monthly_replacements'] = array(3);
$test_products = array(1=>new TestProduct(),2=>new TestProduct(),3=>new TestProduct());
$test_products[2]->id=2;
$test_products[3]->id=3;
check(array_keys(dicey_monthly_options(1)) === array(1,2), 'Automatic age/weight match ignores breed and obsolete manual allowlist');
$mixed = dicey_monthly_details(1,'1,2,1,1,1,1');
check($mixed['total'] === 15100.0 && $mixed['ids'] === array(1,2,1,1,1,1), 'Only selected block changes and six five-day prices are summed');
check(dicey_monthly_details(1,'2,2,2,2,2,2')['total'] === 15600.0, 'Alternative may be repeated in every block');
foreach (array('', '1,2', '1,2,1,1,1,1,1', '1,3,1,1,1,1', '1,-2,1,1,1,1', array(1,array(2),1,1,1,1), 1) as $invalid) {
    check(is_wp_error(dicey_monthly_details(1,$invalid)), 'Malformed or unlisted composition rejected: ' . json_encode($invalid));
}
$_POST = array('dicey_product_period'=>'1 месяц','dicey_monthly_products'=>'1,2,1,1,1,1','dicey_menu_total'=>1);
check(dicey_monthly_validate_add(true,1,1), 'Valid monthly add accepted');
check(!dicey_monthly_validate_add(false,1,1), 'Other WooCommerce rejection is preserved');
$added = dicey_product_add_period_to_cart_item(array(),1,0);
check($added['dicey_menu_total']===15100.0 && count($added['dicey_monthly_blocks'])===6, 'Server ignores submitted total and stores six blocks');
$composite = dicey_product_restore_menu_price(array_merge($added,array('product_id'=>1,'data'=>$test_products[1],'quantity'=>2)));
check($composite['data']->price===15100.0 && $test_products[1]->price===2880, 'Session rehydrates composite price without mutating catalog object');
$other = $composite;
$other['dicey_monthly_products']=array(2,2,2,2,2,2);
$cart->cart_contents=array('first'=>$composite,'second'=>$other);
dicey_product_apply_menu_price_to_cart($cart);
dicey_product_apply_menu_price_to_cart($cart);
check($cart->cart_contents['first']['data']->price===15100.0 && $cart->cart_contents['second']['data']->price===15600.0, 'Different compositions retain independent prices across recalculation');
$_POST['dicey_product_period']='5 дней';
check(!dicey_monthly_validate_add(true,1,1), 'Monthly composition cannot be submitted for five days');
$woo->cart=$cart;
$errors=new WP_Error(); dicey_monthly_validate_checkout(array(),$errors);
check(!$errors->errors,'Valid composition passes final checkout validation');
$orderItem=new TestOrderItem(); dicey_save_order_item_period($orderItem,'first',$composite,null);
check(count($orderItem->meta['_dicey_monthly_blocks'])===6 && strpos($orderItem->meta['Рацион 2 (дни 6–10)'],'Menu 2')===0 && !isset($orderItem->meta['Выбранные рационы']), 'Order contains readable block names and structured composition, not misleading original dishes');
ob_start(); dicey_render_monthly_cart_composition($composite); $composition=ob_get_clean();
check(substr_count($composition,'dicey-monthly__composition')===6 && strpos($composition,'Дни 6–10: Menu 2')!==false,'Cart summary contains all six block ranges');
$fixture[2]['_dicey_product_menu_examples'][0]['price']='600';
$errors=new WP_Error(); dicey_monthly_validate_checkout(array(),$errors);
check((bool)$errors->errors,'Price change after totals blocks checkout instead of charging a stale amount');
$thrown=false; try { dicey_save_order_item_period(new TestOrderItem(),'first',$composite,null); } catch(Exception $e) { $thrown=true; }
check($thrown,'Order creation independently refuses a changed price');
$fixture[2]['_dicey_product_menu_examples'][0]['price']='500';
foreach (array('stock','managed','tax','status','price') as $reason) {
    $test_products[2]->stock=$reason!=='stock';
    $test_products[2]->managed=$reason==='managed';
    $test_products[2]->tax=$reason==='tax'?'reduced':'';
    $statuses[2]=$reason==='status'?'draft':'publish';
    $fixture[2]['_dicey_product_menu_examples'][0]['price']=$reason==='price'?'':'500';
    check(is_wp_error(dicey_monthly_details(1,'1,2,1,1,1,1')),'Unavailable alternative rejected: '.$reason);
}
$test_products[2]->stock=true; $test_products[2]->managed=false; $test_products[2]->tax=''; $statuses[2]='publish'; $fixture[2]['_dicey_product_menu_examples'][0]['price']='500';
$fixture[2]['_dicey_product_match_weight_min']='4';
$stale=dicey_product_restore_menu_price($composite);
check(!empty($stale['dicey_monthly_error']),'Changed weight eligibility invalidates an old cart');
$errors=new WP_Error(); dicey_monthly_validate_checkout(array(),$errors);
check((bool)$errors->errors,'Ineligible weight blocks final checkout');
ob_start(); dicey_render_monthly_cart_composition($stale); $warning=ob_get_clean();
check(strpos($warning,'role="alert"')!==false,'Invalid composition is visibly explained in cart');
$fixture[2]['_dicey_product_match_weight_min']='3';
$profile_cases=array(
    array('3','5',array('adult'),true,'Exact range and age'),
    array('2,5','5.5',array('adult','senior'),true,'Wider range, decimal comma and superset of ages'),
    array('4','6',array('adult'),false,'Partial weight overlap'),
    array('5','7',array('adult'),false,'Shared endpoint alone'),
    array('1','2.9',array('adult'),false,'Disjoint weight range'),
    array('3','5',array('senior'),false,'Wrong age'),
    array('3','5',array(),true,'Empty age follows existing any-age editor contract'),
    array('','',array('adult'),false,'Missing weight is not a wildcard'),
    array('3','',array('adult'),true,'Unbounded maximum'),
    array('','5',array('adult'),true,'Unbounded minimum'),
    array('6','3',array('adult'),false,'Reversed bounds'),
    array('-1','5',array('adult'),false,'Negative bound'),
    array('oops','5',array('adult'),false,'Non-numeric bound'),
    array('3','5',array('unknown'),false,'Unknown age label'),
);
foreach($profile_cases as [$min,$max,$ages,$allowed,$label]) {
    $fixture[2]['_dicey_product_match_weight_min']=$min;
    $fixture[2]['_dicey_product_match_weight_max']=$max;
    $fixture[2]['_dicey_product_match_age_groups']=$ages;
    check(in_array(2,dicey_monthly_allowed_ids(1),true)===$allowed,$label);
}
$fixture[2]['_dicey_product_match_weight_min']='3'; $fixture[2]['_dicey_product_match_weight_max']='5'; $fixture[2]['_dicey_product_match_age_groups']=array('adult');
$fixture[1]['_dicey_product_match_age_groups']=array('adult','senior');
check(!in_array(2,dicey_monthly_allowed_ids(1),true),'Candidate must cover every source age, not just one');
$fixture[1]['_dicey_product_match_age_groups']=array('adult');
$fixture[1]['_dicey_product_match_weight_min']=''; $fixture[1]['_dicey_product_match_weight_max']='';
check(dicey_monthly_allowed_ids(1)===array(),'Missing source weight never offers random alternatives');
$fixture[1]['_dicey_product_match_weight_min']='3'; $fixture[1]['_dicey_product_match_weight_max']='5';
$fixture[2]['_dicey_product_match_age_groups']=array('senior');
$errors=new WP_Error(); dicey_monthly_validate_checkout(array(),$errors);
check((bool)$errors->errors,'Changed age eligibility is rechecked at checkout');
check(!function_exists('dicey_save_monthly_settings'),'Obsolete manual-save endpoint is removed');
echo "All monthly replacement regressions passed.\n";
