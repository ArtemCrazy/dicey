<?php
ob_start();
?>
<!doctype html>
<html lang="ru">
<head>
	<meta name="Content-Type" content="text/html;charset=UTF-8">
	<meta name="viewport" content="width=device-width,height=device-height, initial-scale=1.0, user-scalable=no,maximum-scale=1.0, minimal-ui"/>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php $dicey_city = function_exists( 'dicey_get_detected_city' ) ? dicey_get_detected_city() : array( 'label' => 'Москва' ); ?>
<?php $dicey_cart_count = function_exists( 'WC' ) && WC()->cart ? WC()->cart->get_cart_contents_count() : 0; ?>
<?php $dicey_cart_url = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/basket/' ); ?>

<header>
  <div class="promo-line">
    <div class="promo-line__track">
  
      <div class="promo-line__group">
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
      </div>
  
      <div class="promo-line__group">
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
        <a href="/#banner-sale" class="promo-line__item">Скидка −30% на первый заказ</a>
      </div>
  
    </div>
  </div>
  <div class="container">
    <div class="header-burger">
      <div></div>
      <div></div>
      <div></div>
    </div>
    <a href="/" class="header-logo">
      <img src="/static/imgs/icons/logo.svg" alt="Логотип">
    </a>
    <a href="/shop.php" class="header__link-shop">Магазин</a>
    <div class="header__links">
       <ul>
        <li><a href="/dietology.php">Диетология</a></li>
        <li><a href="/about.php">О нас</a></li>
        <li><a href="/delivery.php">Доставка и оплата</a></li>
        <li><a href="/contacts.php">Контакты</a></li>
       </ul>
    </div>
    <div class="header__wr">
      <div class="header-city">
        <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M6.08962 7.33036C6.08962 7.33036 6.19943 7.21875 6.41904 6.99554C6.63866 6.77233 6.74846 6.34524 6.74846 5.71429C6.74846 5.08334 6.52885 4.54465 6.08962 4.09822C5.6504 3.65179 5.1204 3.42858 4.49963 3.42858C3.87885 3.42858 3.34885 3.65179 2.90963 4.09822C2.4704 4.54465 2.25079 5.08334 2.25079 5.71429C2.25079 6.34524 2.4704 6.88393 2.90963 7.33036C3.34885 7.77679 3.87885 8 4.49963 8C5.1204 8 5.6504 7.77679 6.08962 7.33036ZM8.9973 5.71429C8.9973 6.3631 8.90067 6.89584 8.70741 7.3125L5.50985 14.2232C5.41614 14.4196 5.27706 14.5744 5.09258 14.6875C4.90811 14.8006 4.71045 14.8571 4.49963 14.8571C4.2888 14.8571 4.09115 14.8006 3.90667 14.6875C3.7222 14.5744 3.58604 14.4196 3.49819 14.2232L0.291842 7.3125C0.0985828 6.89584 0.00195312 6.3631 0.00195312 5.71429C0.00195312 4.45238 0.441179 3.375 1.31963 2.48215C2.19808 1.58929 3.25808 1.14286 4.49963 1.14286C5.74117 1.14286 6.80117 1.58929 7.67962 2.48215C8.55807 3.375 8.9973 4.45238 8.9973 5.71429Z" fill="#5182A6"/>
        </svg>            
        <span class="header-city__label"><?php echo esc_html( $dicey_city['label'] ); ?></span>
      </div>
      <button class="header__btn-consult" data-fancybox data-src="#consult-modal">Консультация диетолога</button>
      <div class="header__nav">
        <a href="<?php echo esc_url( home_url( '/lk/' ) ); ?>" class="header__nav-link">
          <svg width="25" height="20" viewBox="0 0 25 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0.550781 19.0278C2.30729 16.1799 6.157 14.2307 12.163 14.2307C18.1691 14.2307 22.0188 16.1799 23.7753 19.0278M16.934 5.18756C16.934 7.74882 14.798 9.82514 12.163 9.82514C9.52813 9.82514 7.39212 7.74882 7.39212 5.18756C7.39212 2.6263 9.52813 0.549988 12.163 0.549988C14.798 0.549988 16.934 2.6263 16.934 5.18756Z" stroke="#5182A6" stroke-width="1.1" stroke-linecap="round"/>
          </svg>            
        </a>
        <a href="<?php echo esc_url( $dicey_cart_url ); ?>" class="header__nav-link">
          <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.902 7.98264H13.6035" stroke="#5182A6" stroke-width="1.09886" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M9.30469 7.98264H13.6033" stroke="#5182A6" stroke-width="1.09886" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M13.6026 24.8008H3.12305L5.21895 7.98264H6.29611" stroke="#5182A6" stroke-width="1.09886" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M13.6035 24.8008H24.0829L21.987 7.98264H20.9099" stroke="#5182A6" stroke-width="1.09886" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M7.75391 10.7863V7.99997C7.75391 4.7362 10.3889 2.09039 13.6394 2.09039C16.8899 2.09039 19.525 4.7362 19.525 7.99997V10.7863" stroke="#5182A6" stroke-width="1.09886" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>   
          <?php if ( $dicey_cart_count ) : ?><div class="header__nav-num"><?php echo esc_html( $dicey_cart_count ); ?></div><?php endif; ?>
        </a>
      </div>
    </div>
  </div>
</header>
<div class="header-shadow"></div>

<div class="dark" style="display: none;"></div>

<div class="burger-menu">
  <div class="burger-menu-wr">
    <svg class="burger-menu__close" width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
      <g opacity="0.3">
      <path d="M8.45312 8.45407L27.545 27.546" stroke="#5182A6" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
      <path d="M27.5469 8.45407L8.45499 27.546" stroke="#5182A6" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
      </g>
      </svg>
      
    <a href="/index.php" class="logo"><img src="static/imgs/icons/logo.svg" alt="Логотип"></a>
    <ul>
      <li><a href="/dietology.php">Диетология</a></li>
      <li><a href="/about.php">О нас</a></li>
      <li><a href="/delivery.php">Доставка и оплата</a></li>
      <li><a href="/contacts.php">Контакты</a></li>
    </ul>
    <a href="/shop.php" class="header__link-shopm header__link-shop">Магазин</a>
    <button class="header__btn-consultm header__btn-consult" data-fancybox data-src="#consult-modal">Консультация диетолога</button>
  </div>
 
</div>

<div class="authorization-modal" id="authorization-modal">
  <div class="modal__wr">
    <p class="authorization__name">Добро пожаловать!</p>
    <form class="authorization__form">
      <div class="lk__form-block">
        <p class="lk__form-name">Почта</p>
        <input type="text" class="lk__form-input" placeholder="info@mail.ru">
      </div>
      <div class="lk__form-block">
        <p class="lk__form-name">Код с почты</p>
        <input type="password" class="lk__form-input">
      </div>
      <label class="checkbox__parent authorization__checkbox">
        <input type="checkbox" name="checkbox" required="" checked="">
        <span class="checkbox__icon">
          <svg width="12" height="9" viewBox="0 0 12 9" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M11 0L4 6.5L1 4L0 4.5L4 9L12 0.5L11 0Z" fill="#5182A6"></path>
          </svg>

        </span>

        <p class="consult__text">
          Я подтверждаю ознакомление и даю <a href="policy.php">Согласие на обработку моих персональных данных</a> в
          порядке и на условиях, указанных в <a href="policy.php">Политике обработки персональных данных</a>
        </p>
      </label>
      <button class="authorization__btn">Войти</button>
    </form>
  </div>
</div>

<div class="consult-modal" id="consult-modal">
  <div class="modal__wr">
    <p class="cons__name">Консультация диетолога</p>
    <p class="cons__text"><span>1.</span> Выберете необходимую форму консультации. Стоимость консультации возвращается при заказе и оплате рациона</p>
    <form class="cons__form">
      <div class="nutritionist">
        <label class="service-card">
          <input type="radio" name="service" />
      
          <span class="custom-radio"></span>
      
          <div class="service-content">
         <p>   Консультация ветеринарного врача
          <strong>1 500 ₽</strong></p>
          </div>
        </label>
        <label class="service-card">
          <input type="radio" name="service" />
      
          <span class="custom-radio"></span>
      
          <div class="service-content">
           <p> Консультация ветеринарного врача
            <strong>1 500 ₽</strong></p>
          </div>
        </label>
        <label class="service-card">
          <input type="radio" name="service" />
      
          <span class="custom-radio"></span>
      
          <div class="service-content">
            <p>Консультация ветеринарного врача
              <strong>1 500 ₽</strong></p>
          </div>
        </label>
        <label class="service-card">
          <input type="radio" name="service" />
      
          <span class="custom-radio"></span>
      
          <div class="service-content">
          <p>  Ведение питания
            <strong>2 500 ₽</strong></p>
          </div>
        </label>
      </div>
      <p class="cons__text"><span>2.</span> Заполните контактные данные</p>
      <div class="consult-modal__wr">
        <div class="consult-modal__inputs">
        <input type="text" placeholder="Иван Иванов" class="consult-modal__input">
        <input type="tel" placeholder="8(800)800-00-00" class="consult-modal__input">
        <input type="mail" placeholder="ivan@mail.ru" class="consult-modal__input">
        </div>
        <textarea class="consult-modal__textarea" placeholder="Комментарий при необходимости"></textarea>
        <label class="checkbox__parent authorization__checkbox">
          <input type="checkbox" name="checkbox" required="" checked="" wfd-id="id2">
          <span class="checkbox__icon">
            <svg width="12" height="9" viewBox="0 0 12 9" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M11 0L4 6.5L1 4L0 4.5L4 9L12 0.5L11 0Z" fill="#5182A6"></path>
            </svg>
  
          </span>
  
          <p class="consult__text">
            Я подтверждаю ознакомление и даю <a href="policy.php">Согласие на обработку моих персональных данных</a> в
            порядке и на условиях, указанных в <a href="policy.php">Политике обработки персональных данных</a>
          </p>
        </label>
        <button class="authorization__btn">Оплатить</button>
      </div>
    </form>
  </div>
</div>

<div class="why-modal" id="why-modal">
  <div class="modal__wr">
    <p class="cons__name">Остались вопросы?</p>
    <p class="why-modal__text">Оставьте ваши контактные данные, и наш специалист свяжется с вами, поможет подобрать подходящий рацион для вашего питомца и ответит на все вопросы</p>
    <div class="consult-modal__wr">
      <div class="consult-modal__inputs">
      <input type="text" placeholder="Иван Иванов" class="consult-modal__input">
      <input type="tel" placeholder="8(800)800-00-00" class="consult-modal__input">
      </div>
      <textarea class="consult-modal__textarea" placeholder="Ваш вопрос"></textarea>
      <label class="checkbox__parent authorization__checkbox">
        <input type="checkbox" name="checkbox" required="" checked="" wfd-id="id2">
        <span class="checkbox__icon">
          <svg width="12" height="9" viewBox="0 0 12 9" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M11 0L4 6.5L1 4L0 4.5L4 9L12 0.5L11 0Z" fill="#5182A6"></path>
          </svg>

        </span>

        <p class="consult__text">
          Я подтверждаю ознакомление и даю <a href="policy.php">Согласие на обработку моих персональных данных</a> в
          порядке и на условиях, указанных в <a href="policy.php">Политике обработки персональных данных</a>
        </p>
      </label>
      <button class="authorization__btn">Оплатить</button>
    </div>
  </div>
</div>


<?php
echo dicey_rewrite_legacy_html( ob_get_clean() );
