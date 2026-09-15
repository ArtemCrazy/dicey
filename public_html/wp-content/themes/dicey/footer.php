<?php
ob_start();
?>
<footer>
    <div class="container">
        <div class="footer__top">
            <div class="footer__info">
                <a href="/" class="footer__logo"><img src="https://daysi.ru/wp-content/uploads/2026/09/Fra324me.svg" alt="Логотип"></a>
                <div class="footer__cont xs-hide">
                    <p>ООО «ДАЙСИ», <br>
                        192171, г. Санкт-Петербург, <br> ул Седова, д. 70 литера. А <br> ОГРН 1267800025283 / <br> ИНН 7811815173 / КПП 781101001</p>
                </div>
                <div class="footer__cont xs-show">
                    <p>ООО «ДАЙСИ», <br>
                        192171, г. Санкт-Петербург, ул Седова, д. 70 литера. А</p>
                    <p>ОГРН 1267800025283 / <br> ИНН 7811815173 / <br> КПП 781101001</p>
                </div>
                <div class="footer__contacts">
                    <img src="https://daysi.ru/wp-content/uploads/2026/09/Frame-2087325785.svg" alt="">
                </div>
            </div>
            <div class="footer__menu">
                <div class="footer__menu-block">
                    <ul>
                        <li><a href="shop.php">Магазин</a></li>
                        <li><a href="dietology.php">Диетология</a></li>
                        <li><a href="about.php">О нас</a></li>
                        <li><a href="delivery.php">Доставка и оплата</a></li>
                    </ul>
                </div>
                <div class="footer__menu-block">
                    <ul>
                        <li><a href="contacts.php">Контакты</a></li>
                        <li><a href="partners.php">Сотрудничество </a></li>
                        <li><a href="blog.php">Блог</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer__wr">
                <p class="footer__wr-name">Подпишитесь на наши новости</p>
                <form class="footer__form dicey-newsletter-form">
                    <div class="footer__form-info">
                        <input type="email" name="email" placeholder="Почта" autocomplete="email" required>
                        <button class="footer__form-btn" type="submit" aria-label="Подписаться">
                            <svg width="35" height="20" viewBox="0 0 35 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 9.47565C1.01194 9.47565 1.02388 9.47565 5.83598 9.5086C10.6481 9.54154 20.26 9.60743 25.8332 9.6562C31.4064 9.70497 32.6496 9.73462 33.0868 9.67247C34.1046 9.52782 28.781 5.94837 25.9727 2.84667C25.5743 2.38308 25.317 2.13518 25.0324 1.87466C24.7479 1.61415 24.444 1.34854 24.0772 1" stroke="white" stroke-width="2" stroke-linecap="round" />
                                <path d="M32.9277 10.25C32.8758 10.25 31.4399 11.5006 29.0664 13.6575C28.102 14.5636 27.6251 15.0875 27.0965 15.7893C26.568 16.4911 26.0022 17.3551 24.8477 18.8929" stroke="white" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </button>
                    </div>
                    <label class="checkbox__parent">
                        <input type="checkbox" name="consent" value="1" required>
                        <span class="checkbox__icon">
                            <svg width="9" height="9" viewBox="0 0 9 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.30976 0.289932C7.45835 0.104877 7.65894 0.000729047 7.86817 3.81298e-06C8.07739 -0.000721421 8.27843 0.102035 8.42783 0.286057C8.57723 0.470079 8.66298 0.720581 8.66655 0.983405C8.67012 1.24623 8.59121 1.50026 8.44689 1.69057L4.20842 8.34692C4.13558 8.4455 4.04766 8.52461 3.94992 8.57952C3.85219 8.63443 3.74664 8.66401 3.6396 8.6665C3.53255 8.66899 3.42621 8.64434 3.32692 8.59401C3.22764 8.54369 3.13745 8.46872 3.06175 8.3736L0.253446 4.844C0.17521 4.75241 0.112459 4.64196 0.068936 4.51924C0.0254133 4.39651 0.00201041 4.26404 0.000123926 4.12971C-0.00176256 3.99537 0.017906 3.86194 0.0579559 3.73737C0.0980058 3.61279 0.157617 3.49963 0.233232 3.40463C0.308848 3.30963 0.398919 3.23473 0.498073 3.18442C0.597227 3.1341 0.703432 3.10939 0.810352 3.11176C0.917272 3.11413 1.02272 3.14353 1.1204 3.19821C1.21808 3.25289 1.30599 3.33173 1.37889 3.43002L3.60217 6.22196L7.28959 0.319279C7.29617 0.308944 7.30326 0.299142 7.31082 0.289932H7.30976Z" fill="#5182A6" />
                            </svg>
                        </span>

                        <p class="consult__text">
                            Я даю <a href="<?php echo esc_url(home_url('/mailing-consent/')); ?>">согласие на получение рекламной информации</a> о поступлении новых товаров, скидках и распродажах посредством электронной почты
                        </p>
                    </label>
                    <div class="footer__form-message" aria-live="polite"></div>
                </form>
            </div>
        </div>
        <div class="footer__bottom">
            <div class="footer__links">
                <p>© 2026. Все права защищены.</p>
                <a href="<?php echo esc_url(home_url('/policy/')); ?>">Политика обработки персональных данных</a>
                <a href="<?php echo esc_url(home_url('/offer/')); ?>">Договор оферты</a>
                <a href="<?php echo esc_url(home_url('/mailing-consent/')); ?>">Согласие на получение информационной и рекламной рассылки</a>
                <a href="<?php echo esc_url(home_url('/personal-data-consent/')); ?>">Согласие об обработке персональных данных</a>
                <a href="https://crazy.studio/" target="_blank" rel="noopener">Разработка сайта</a>
                <!-- <a href="https://kraya.ru/" target="_blank" rel="noopener">Дизайн сайта</a> -->
            </div>
        </div>
    </div>
</footer>
<?
if (is_user_logged_in()) {
?>
    <br><br>
    <div class="decoration__left">
        <div class="decoration__wr">
            <button type="submit" class="decoration__btn" name="woocommerce_checkout_place_order" value="Оформить заказ">
                <span>Оплатить </span>
                <div class="decoration__btn-line"></div><img src="https://daysi.ru/wp-content/uploads/2026/09/sbp.svg" alt="">
                <div class="decoration__btn-line"></div><img src="https://daysi.ru/wp-content/uploads/2026/09/cart.png" alt="">
                <div class="decoration__btn-line"></div> <img src="https://daysi.ru/wp-content/uploads/2026/09/split.svg" alt="">
            </button>
        </div>
    </div>

    <br><br>

    <section class="popularity">
        <div class="container">
            <h2 class="popularity__title">Заказывают чаще всего</h2>
            <div class="popularity__blocks">
                <div class="popularity__block" data-dicey-product="1" data-age-groups="adult" data-weight-min="2" data-weight-max="3.5" data-breeds="" data-vip="1">
                    <a href="https://daysi.ru/product/%d1%80%d0%b0%d1%86%d0%b8%d0%be%d0%bd%d1%8b-%d0%bd%d0%b0-%d0%bc%d0%be%d1%80%d0%b5%d0%bf%d1%80%d0%be%d0%b4%d1%83%d0%ba%d1%82%d0%b0%d1%85-%d0%b8-%d0%be%d0%b2%d0%be%d1%89%d0%b0%d1%85/" class="popularity__link">
                        <div class="popularity__img-wr">
                            <div class="popularity__tags">
                                <div class="popularity__tag vip"><img decoding="async" src="https://daysi.ru/wp-content/themes/dicey/assets/imgs/icons/vip.svg" alt="">ВИП</div>
                            </div>
                            <img decoding="async" src="https://daysi.ru/wp-content/uploads/2026/09/11s11-1-1-768x576.jpg" alt="Рационы на морепродуктах и овощах для собак весом 2-3,5 кг." class="popularity__diet">
                            <img decoding="async" src="https://daysi.ru/wp-content/themes/dicey/assets/imgs/icons/popularity__hover.svg" alt="" class="popularity__hover">
                            <div class="popularity__shadow"></div>
                        </div>
                        <div class="popularity__head">
                            <p class="popularity__name">Рационы на морепродуктах и овощах для собак весом 2-3,5 кг.</p>
                        </div>
                        <div class="popularity__term">
                            <span>Срок:</span>
                            <div class="popularity__term-blocks">
                                <div class="popularity__term-block active">3 дня</div>
                                <div class="popularity__term-block">5 дней</div>
                                <div class="popularity__term-block">1 месяц</div>
                            </div>
                            
                        </div>
                        <p class="popularity__price">2 400 ₽</p>
                    </a>
                    <form class="popularity__cart-form" method="post" action="https://daysi.ru/basket/">
                        <input type="hidden" name="add-to-cart" value="470">
                        <input type="hidden" name="product_id" value="470">
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="dicey_product_period" value="3 дня">
                        <input type="hidden" name="dicey_product_menu_selection" value="0,1,2">
                        <button type="submit" class="popularity__btn">В корзину</button>
                    </form>
                </div>
                <div class="popularity__block" data-dicey-product="1" data-age-groups="adult" data-weight-min="2" data-weight-max="3.5" data-breeds="" data-vip="1">
                    <a href="https://daysi.ru/product/%d1%80%d0%b0%d1%86%d0%b8%d0%be%d0%bd%d1%8b-%d0%bd%d0%b0-%d1%80%d1%8b%d0%b1%d0%b5-%d0%ba%d1%80%d1%83%d0%bf%d0%b5-%d0%b8-%d0%be%d0%b2%d0%be%d1%89%d0%b0%d1%85-%d0%b4%d0%bb%d1%8f-%d1%81%d0%be%d0%b1%d0%b0/" class="popularity__link">
                        <div class="popularity__img-wr">
                            <div class="popularity__tags">
                                <div class="popularity__tag vip"><img decoding="async" src="https://daysi.ru/wp-content/themes/dicey/assets/imgs/icons/vip.svg" alt="">ВИП</div>
                            </div>
                            <img decoding="async" src="https://daysi.ru/wp-content/uploads/2026/08/11s11-1-5-768x576.jpg" alt="Рационы на рыбе, крупе и овощах для собак весом 2-3,5 кг." class="popularity__diet">
                            <img decoding="async" src="https://daysi.ru/wp-content/themes/dicey/assets/imgs/icons/popularity__hover.svg" alt="" class="popularity__hover">
                            <div class="popularity__shadow"></div>
                        </div>
                        <div class="popularity__head">
                            <p class="popularity__name">Рационы на рыбе, крупе и овощах для собак весом 2-3,5 кг.</p>
                        </div>
                        <div class="popularity__term">
                            <span>Срок:</span>
                            <div class="popularity__term-blocks">
                                <div class="popularity__term-block active">3 дня</div>
                                <div class="popularity__term-block">5 дней</div>
                                <div class="popularity__term-block">1 месяц</div>
                            </div>
                            
                        </div>
                        <p class="popularity__price">2 100 ₽</p>
                    </a>
                    <form class="popularity__cart-form" method="post" action="https://daysi.ru/basket/">
                        <input type="hidden" name="add-to-cart" value="444">
                        <input type="hidden" name="product_id" value="444">
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="dicey_product_period" value="3 дня">
                        <input type="hidden" name="dicey_product_menu_selection" value="0,1,2">
                        <button type="submit" class="popularity__btn">В корзину</button>
                    </form>
                </div>
                <div class="popularity__block" data-dicey-product="1" data-age-groups="adult" data-weight-min="2" data-weight-max="3.5" data-breeds="" data-vip="0">
                    <a href="https://daysi.ru/product/%d1%80%d0%b0%d1%86%d0%b8%d0%be%d0%bd%d1%8b-%d0%bd%d0%b0-%d0%b8%d0%bd%d0%b4%d0%b5%d0%b9%d0%ba%d0%b5-%d1%81-%d0%ba%d1%83%d1%80%d0%b8%d1%86%d0%b5%d0%b9-%d0%ba%d1%80%d1%83%d0%bf%d0%b5-%d0%b8-%d0%be%d0%b2/" class="popularity__link">
                        <div class="popularity__img-wr">
                            <img decoding="async" src="https://daysi.ru/wp-content/uploads/2026/08/11s11-1-23-768x576.jpg" alt="Рационы на индейке, курице, крупе и овощах для собак весом 2-3,5 кг." class="popularity__diet">
                            <img decoding="async" src="https://daysi.ru/wp-content/themes/dicey/assets/imgs/icons/popularity__hover.svg" alt="" class="popularity__hover">
                            <div class="popularity__shadow"></div>
                        </div>
                        <div class="popularity__head">
                            <p class="popularity__name">Рационы на индейке, курице, крупе и овощах для собак весом 2-3,5 кг.</p>
                        </div>
                        <div class="popularity__term">
                            <span>Срок:</span>
                            <div class="popularity__term-blocks">
                                <div class="popularity__term-block active">3 дня</div>
                                <div class="popularity__term-block">5 дней</div>
                                <div class="popularity__term-block">1 месяц</div>
                            </div>
                            
                        </div>
                        <p class="popularity__price">1 650 ₽</p>
                    </a>
                    <form class="popularity__cart-form" method="post" action="https://daysi.ru/basket/">
                        <input type="hidden" name="add-to-cart" value="443">
                        <input type="hidden" name="product_id" value="443">
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="dicey_product_period" value="3 дня">
                        <input type="hidden" name="dicey_product_menu_selection" value="0,1,2">
                        <button type="submit" class="popularity__btn">В корзину</button>
                    </form>
                </div>
                <div class="popularity__block" data-dicey-product="1" data-age-groups="senior" data-weight-min="2" data-weight-max="3.5" data-breeds="" data-vip="0">
                    <a href="https://daysi.ru/product/%d1%80%d0%b0%d1%86%d0%b8%d0%be%d0%bd%d1%8b-%d0%bd%d0%b0-%d0%ba%d1%83%d1%80%d0%b8%d1%86%d0%b5-%d0%ba%d1%80%d1%83%d0%bf%d0%b5-%d0%b8-%d0%be%d0%b2%d0%be%d1%89%d0%b0%d1%85-%d0%b4%d0%bb%d1%8f-%d1%81%d0%be/" class="popularity__link">
                        <div class="popularity__img-wr">
                            <div class="popularity__tags">
                                <div class="popularity__tag">Для пожилых собак</div>
                            </div>
                            <img decoding="async" src="https://daysi.ru/wp-content/uploads/2026/08/11s11-1-18-768x576.jpg" alt="Рационы на курице, крупе и овощах для собак весом 2-3,5 кг" class="popularity__diet">
                            <img decoding="async" src="https://daysi.ru/wp-content/themes/dicey/assets/imgs/icons/popularity__hover.svg" alt="" class="popularity__hover">
                            <div class="popularity__shadow"></div>
                        </div>
                        <div class="popularity__head">
                            <p class="popularity__name">Рационы на курице, крупе и овощах для собак весом 2-3,5 кг</p>
                        </div>
                        <div class="popularity__term">
                            <span>Срок:</span>
                            <div class="popularity__term-blocks">
                                <div class="popularity__term-block active">3 дня</div>
                                <div class="popularity__term-block">5 дней</div>
                                <div class="popularity__term-block">1 месяц</div>
                            </div>
                            
                        </div>
                        <p class="popularity__price">1 560 ₽</p>
                    </a>
                    <form class="popularity__cart-form" method="post" action="https://daysi.ru/basket/">
                        <input type="hidden" name="add-to-cart" value="433">
                        <input type="hidden" name="product_id" value="433">
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="dicey_product_period" value="3 дня">
                        <input type="hidden" name="dicey_product_menu_selection" value="0,1,2">
                        <button type="submit" class="popularity__btn">В корзину</button>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <section class="carte" data-menu-limit="3" data-menu-selection="0,1,2" data-fallback-price="3 180 ₽">
        <div class="container">
            <div class="standart-nav">
                <a href="https://daysi.ru/">Главная</a>
                <a href="https://daysi.ru/shop/">Магазин</a>
                <p>Рационы на рыбе, крупе и овощах для собак весом 23-25 кг.</p>
            </div>
            <div class="carte__wr">
                <div class="carte__left">
                    <h2 class="carte-var__title">Пример меню</h2>
                    <div class="carte-var__tabs" role="tablist" aria-label="Дни меню">
                        <button
                            type="button"
                            class="carte-var__tab active"
                            data-menu-index="0"
                            role="tab"
                            aria-selected="true">1 день</button>
                        <button
                            type="button"
                            class="carte-var__tab "
                            data-menu-index="1"
                            role="tab"
                            aria-selected="false">2 день</button>
                        <button
                            type="button"
                            class="carte-var__tab "
                            data-menu-index="2"
                            role="tab"
                            aria-selected="false">3 день</button>
                        <button
                            type="button"
                            class="carte-var__tab "
                            data-menu-index="3"
                            role="tab"
                            aria-selected="false"
                            style="display: none;">4 день</button>
                        <button
                            type="button"
                            class="carte-var__tab "
                            data-menu-index="4"
                            role="tab"
                            aria-selected="false"
                            style="display: none;">5 день</button>
                    </div>
                    <div class="carte-var__contets">
                        <div class="carte-var__content" data-menu-content="0" data-menu-price="1060" style="display: flex;">

                            <button type="button" class="carte-var__btn" data-menu-replace>Заменить блюдо <span aria-hidden="true"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.32899 13.8003C6.51072 13.7787 6.69361 13.8299 6.83762 13.9429C6.98163 14.0558 7.07502 14.2212 7.09733 14.4028L7.41399 16.9795C7.43498 17.161 7.38359 17.3434 7.27096 17.4872C7.15833 17.6311 6.99354 17.7247 6.81233 17.7478L4.27483 18.0645C3.83233 18.0987 3.54649 17.8128 3.50233 17.462C3.48061 17.2799 3.53163 17.0967 3.64429 16.952C3.75696 16.8074 3.92216 16.713 4.10399 16.6895L4.94816 16.5845C3.5751 15.5463 2.56001 14.1057 2.04424 12.4634C1.52847 10.8211 1.5377 9.05881 2.07066 7.422C3.16566 4.00866 6.39316 1.66366 9.95483 1.667C10.4173 1.667 10.6898 1.99366 10.6832 2.37533C10.6723 2.75616 10.3932 3.04866 9.95483 3.04866C6.98566 3.05533 4.29816 5.00616 3.38316 7.84783C2.93552 9.22437 2.93213 10.7068 3.37346 12.0854C3.81479 13.464 4.67849 14.6688 5.84233 15.5295L5.72649 14.5728C5.71519 14.4825 5.72181 14.3909 5.74599 14.3031C5.77017 14.2154 5.81143 14.1333 5.8674 14.0615C5.92338 13.9898 5.99296 13.9297 6.07217 13.8849C6.15138 13.8401 6.23865 13.8114 6.32899 13.8003ZM15.894 3.3145L15.0498 3.4195C16.422 4.45687 17.4366 5.89629 17.9524 7.53736C18.4682 9.17843 18.4594 10.9395 17.9273 12.5753C16.8323 15.9887 13.6048 18.3337 10.0407 18.3337C9.57816 18.3337 9.30566 18.007 9.31233 17.6253C9.32316 17.2445 9.60149 16.952 10.0407 16.952C13.0098 16.9453 15.6973 14.9953 16.6123 12.1528C17.06 10.7763 17.0634 9.29383 16.622 7.91526C16.1807 6.53668 15.317 5.33181 14.1532 4.47116L14.2682 5.42783C14.2847 5.52032 14.2823 5.61521 14.2609 5.70672C14.2396 5.79823 14.1999 5.88443 14.1441 5.96007C14.0884 6.03571 14.0178 6.0992 13.9367 6.14666C13.8556 6.19412 13.7657 6.22456 13.6724 6.23613C13.5792 6.24769 13.4846 6.24013 13.3943 6.21392C13.3041 6.1877 13.2202 6.14338 13.1476 6.08365C13.0751 6.02392 13.0155 5.95004 12.9725 5.86651C12.9294 5.78298 12.9039 5.69156 12.8973 5.59783L12.5848 3.02533C12.5636 2.8436 12.615 2.66084 12.7278 2.5168C12.8407 2.37276 13.0058 2.27909 13.1873 2.25616L15.724 1.9395C16.1665 1.90533 16.4523 2.19116 16.4965 2.542C16.5182 2.72418 16.4671 2.90757 16.3542 3.05224C16.2414 3.19692 16.076 3.29117 15.894 3.3145Z" fill="white"/>
                                </svg>
                                </span></button>

                            <div class="carte-var__info">
                                <h3>Треска с сельдью, рисом и тыквой</h3>

                            </div>

                            <div class="carte-var__imgswr">
                                <div class="carte-var__img-big">
                                    <div class="carte-var__img-slider owl-carousel">
                                        <img src="https://daysi.ru/wp-content/uploads/2026/08/11s11-2-8-1024x768.jpg" alt="Треска с сельдью, рисом и тыквой">
                                        <img src="https://daysi.ru/wp-content/uploads/2026/08/11s11-1-13-1024x768.jpg" alt="Треска с сельдью, рисом и тыквой">
                                    </div>
                                </div>
                                <div class="carte-var__imgs">
                                    <img class="active" src="https://daysi.ru/wp-content/uploads/2026/08/11s11-2-8-300x225.jpg" alt="Треска с сельдью, рисом и тыквой">
                                    <img class="" src="https://daysi.ru/wp-content/uploads/2026/08/11s11-1-13-300x225.jpg" alt="Треска с сельдью, рисом и тыквой">
                                </div>
                            </div>


                            <div class="carte-var__info">
                                <h4>Состав</h4>
                                <p>Треска, сельдь атлантическая, рис длиннозерный, тыква, масло тыквенное, витаминно-минеральный премикс.</p>
                                <h4>Энергетическая ценность суточного рациона</h4>
                                <p>1090 ккал.</p>
                                <h4>Пищевая ценность суточного рациона</h4>
                                <p>Сырой протеин 44%; сырой жир 19%; углеводы 30%; клетчатка 2%; сырая зола 5%; Ca/P: 1,2:1</p>
                                <h4>Витамины и минеральные вещества</h4>
                                <p>Витамины: витамин А 2889 МЕ; витамин Д 2164 МЕ; витамин Е 25 МЕ; витамин В1 4,34 мг; витамин В2 16,98 мг; витамин В3 27,25 мг; витамин В5 11,92 мг; витамин В6 3,77 мг; витамин В7 61 мкг; витамин В9 447 мкг; витамин В12 70 мкг.<br />
                                    Минеральные вещества: кальций 1519 мг; фосфор 1294 мг; натрий 463 мг; железо 32,63 мг; медь 3,64 мг; цинк 32,9 мг; марганец 2,67 мг; йод 1395 мкг.</p>
                                <h4>Вес суточного рациона</h4>
                                <p>882 гр.</p>
                                <h4>Стоимость</h4>
                                <p>1 060 ₽</p>
                            </div>

                        </div>
                        <div class="carte-var__content" data-menu-content="1" data-menu-price="1060" style="display: none;">

                            <button type="button" class="carte-var__btn" data-menu-replace>Заменить блюдо <span aria-hidden="true"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.32899 13.8003C6.51072 13.7787 6.69361 13.8299 6.83762 13.9429C6.98163 14.0558 7.07502 14.2212 7.09733 14.4028L7.41399 16.9795C7.43498 17.161 7.38359 17.3434 7.27096 17.4872C7.15833 17.6311 6.99354 17.7247 6.81233 17.7478L4.27483 18.0645C3.83233 18.0987 3.54649 17.8128 3.50233 17.462C3.48061 17.2799 3.53163 17.0967 3.64429 16.952C3.75696 16.8074 3.92216 16.713 4.10399 16.6895L4.94816 16.5845C3.5751 15.5463 2.56001 14.1057 2.04424 12.4634C1.52847 10.8211 1.5377 9.05881 2.07066 7.422C3.16566 4.00866 6.39316 1.66366 9.95483 1.667C10.4173 1.667 10.6898 1.99366 10.6832 2.37533C10.6723 2.75616 10.3932 3.04866 9.95483 3.04866C6.98566 3.05533 4.29816 5.00616 3.38316 7.84783C2.93552 9.22437 2.93213 10.7068 3.37346 12.0854C3.81479 13.464 4.67849 14.6688 5.84233 15.5295L5.72649 14.5728C5.71519 14.4825 5.72181 14.3909 5.74599 14.3031C5.77017 14.2154 5.81143 14.1333 5.8674 14.0615C5.92338 13.9898 5.99296 13.9297 6.07217 13.8849C6.15138 13.8401 6.23865 13.8114 6.32899 13.8003ZM15.894 3.3145L15.0498 3.4195C16.422 4.45687 17.4366 5.89629 17.9524 7.53736C18.4682 9.17843 18.4594 10.9395 17.9273 12.5753C16.8323 15.9887 13.6048 18.3337 10.0407 18.3337C9.57816 18.3337 9.30566 18.007 9.31233 17.6253C9.32316 17.2445 9.60149 16.952 10.0407 16.952C13.0098 16.9453 15.6973 14.9953 16.6123 12.1528C17.06 10.7763 17.0634 9.29383 16.622 7.91526C16.1807 6.53668 15.317 5.33181 14.1532 4.47116L14.2682 5.42783C14.2847 5.52032 14.2823 5.61521 14.2609 5.70672C14.2396 5.79823 14.1999 5.88443 14.1441 5.96007C14.0884 6.03571 14.0178 6.0992 13.9367 6.14666C13.8556 6.19412 13.7657 6.22456 13.6724 6.23613C13.5792 6.24769 13.4846 6.24013 13.3943 6.21392C13.3041 6.1877 13.2202 6.14338 13.1476 6.08365C13.0751 6.02392 13.0155 5.95004 12.9725 5.86651C12.9294 5.78298 12.9039 5.69156 12.8973 5.59783L12.5848 3.02533C12.5636 2.8436 12.615 2.66084 12.7278 2.5168C12.8407 2.37276 13.0058 2.27909 13.1873 2.25616L15.724 1.9395C16.1665 1.90533 16.4523 2.19116 16.4965 2.542C16.5182 2.72418 16.4671 2.90757 16.3542 3.05224C16.2414 3.19692 16.076 3.29117 15.894 3.3145Z" fill="white"/>
                                </svg>
                                </span></button>

                            <div class="carte-var__info">
                                <h3>Треска с сельдью, рисом и тыквой</h3>

                            </div>

                            <div class="carte-var__imgswr">
                                <div class="carte-var__img-big">
                                    <div class="carte-var__img-slider owl-carousel">
                                        <img src="https://daysi.ru/wp-content/uploads/2026/08/11s11-2-8-1024x768.jpg" alt="Треска с сельдью, рисом и тыквой">
                                        <img src="https://daysi.ru/wp-content/uploads/2026/08/11s11-1-13-1024x768.jpg" alt="Треска с сельдью, рисом и тыквой">
                                    </div>
                                </div>
                                <div class="carte-var__imgs">
                                    <img class="active" src="https://daysi.ru/wp-content/uploads/2026/08/11s11-2-8-300x225.jpg" alt="Треска с сельдью, рисом и тыквой">
                                    <img class="" src="https://daysi.ru/wp-content/uploads/2026/08/11s11-1-13-300x225.jpg" alt="Треска с сельдью, рисом и тыквой">
                                </div>
                            </div>


                            <div class="carte-var__info">
                                <h4>Состав</h4>
                                <p>Треска, сельдь атлантическая, рис длиннозерный, тыква, масло тыквенное, витаминно-минеральный премикс.</p>
                                <h4>Энергетическая ценность суточного рациона</h4>
                                <p>1090 ккал.</p>
                                <h4>Пищевая ценность суточного рациона</h4>
                                <p>Сырой протеин 44%; сырой жир 19%; углеводы 30%; клетчатка 2%; сырая зола 5%; Ca/P: 1,2:1</p>
                                <h4>Витамины и минеральные вещества</h4>
                                <p>Витамины: витамин А 2889 МЕ; витамин Д 2164 МЕ; витамин Е 25 МЕ; витамин В1 4,34 мг; витамин В2 16,98 мг; витамин В3 27,25 мг; витамин В5 11,92 мг; витамин В6 3,77 мг; витамин В7 61 мкг; витамин В9 447 мкг; витамин В12 70 мкг.<br />
                                    Минеральные вещества: кальций 1519 мг; фосфор 1294 мг; натрий 463 мг; железо 32,63 мг; медь 3,64 мг; цинк 32,9 мг; марганец 2,67 мг; йод 1395 мкг.</p>
                                <h4>Вес суточного рациона</h4>
                                <p>882 гр.</p>
                                <h4>Стоимость</h4>
                                <p>1 060 ₽</p>
                            </div>

                        </div>
                        <div class="carte-var__content" data-menu-content="2" data-menu-price="1060" style="display: none;">

                            <button type="button" class="carte-var__btn" data-menu-replace>Заменить блюдо <span aria-hidden="true"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.32899 13.8003C6.51072 13.7787 6.69361 13.8299 6.83762 13.9429C6.98163 14.0558 7.07502 14.2212 7.09733 14.4028L7.41399 16.9795C7.43498 17.161 7.38359 17.3434 7.27096 17.4872C7.15833 17.6311 6.99354 17.7247 6.81233 17.7478L4.27483 18.0645C3.83233 18.0987 3.54649 17.8128 3.50233 17.462C3.48061 17.2799 3.53163 17.0967 3.64429 16.952C3.75696 16.8074 3.92216 16.713 4.10399 16.6895L4.94816 16.5845C3.5751 15.5463 2.56001 14.1057 2.04424 12.4634C1.52847 10.8211 1.5377 9.05881 2.07066 7.422C3.16566 4.00866 6.39316 1.66366 9.95483 1.667C10.4173 1.667 10.6898 1.99366 10.6832 2.37533C10.6723 2.75616 10.3932 3.04866 9.95483 3.04866C6.98566 3.05533 4.29816 5.00616 3.38316 7.84783C2.93552 9.22437 2.93213 10.7068 3.37346 12.0854C3.81479 13.464 4.67849 14.6688 5.84233 15.5295L5.72649 14.5728C5.71519 14.4825 5.72181 14.3909 5.74599 14.3031C5.77017 14.2154 5.81143 14.1333 5.8674 14.0615C5.92338 13.9898 5.99296 13.9297 6.07217 13.8849C6.15138 13.8401 6.23865 13.8114 6.32899 13.8003ZM15.894 3.3145L15.0498 3.4195C16.422 4.45687 17.4366 5.89629 17.9524 7.53736C18.4682 9.17843 18.4594 10.9395 17.9273 12.5753C16.8323 15.9887 13.6048 18.3337 10.0407 18.3337C9.57816 18.3337 9.30566 18.007 9.31233 17.6253C9.32316 17.2445 9.60149 16.952 10.0407 16.952C13.0098 16.9453 15.6973 14.9953 16.6123 12.1528C17.06 10.7763 17.0634 9.29383 16.622 7.91526C16.1807 6.53668 15.317 5.33181 14.1532 4.47116L14.2682 5.42783C14.2847 5.52032 14.2823 5.61521 14.2609 5.70672C14.2396 5.79823 14.1999 5.88443 14.1441 5.96007C14.0884 6.03571 14.0178 6.0992 13.9367 6.14666C13.8556 6.19412 13.7657 6.22456 13.6724 6.23613C13.5792 6.24769 13.4846 6.24013 13.3943 6.21392C13.3041 6.1877 13.2202 6.14338 13.1476 6.08365C13.0751 6.02392 13.0155 5.95004 12.9725 5.86651C12.9294 5.78298 12.9039 5.69156 12.8973 5.59783L12.5848 3.02533C12.5636 2.8436 12.615 2.66084 12.7278 2.5168C12.8407 2.37276 13.0058 2.27909 13.1873 2.25616L15.724 1.9395C16.1665 1.90533 16.4523 2.19116 16.4965 2.542C16.5182 2.72418 16.4671 2.90757 16.3542 3.05224C16.2414 3.19692 16.076 3.29117 15.894 3.3145Z" fill="white"/>
                                </svg>
                                </span></button>

                            <div class="carte-var__info">
                                <h3>Треска с сельдью, рисом и тыквой</h3>

                            </div>

                            <div class="carte-var__imgswr">
                                <div class="carte-var__img-big">
                                    <div class="carte-var__img-slider owl-carousel">
                                        <img src="https://daysi.ru/wp-content/uploads/2026/08/11s11-2-8-1024x768.jpg" alt="Треска с сельдью, рисом и тыквой">
                                        <img src="https://daysi.ru/wp-content/uploads/2026/08/11s11-1-13-1024x768.jpg" alt="Треска с сельдью, рисом и тыквой">
                                    </div>
                                </div>
                                <div class="carte-var__imgs">
                                    <img class="active" src="https://daysi.ru/wp-content/uploads/2026/08/11s11-2-8-300x225.jpg" alt="Треска с сельдью, рисом и тыквой">
                                    <img class="" src="https://daysi.ru/wp-content/uploads/2026/08/11s11-1-13-300x225.jpg" alt="Треска с сельдью, рисом и тыквой">
                                </div>
                            </div>


                            <div class="carte-var__info">
                                <h4>Состав</h4>
                                <p>Треска, сельдь атлантическая, рис длиннозерный, тыква, масло тыквенное, витаминно-минеральный премикс.</p>
                                <h4>Энергетическая ценность суточного рациона</h4>
                                <p>1090 ккал.</p>
                                <h4>Пищевая ценность суточного рациона</h4>
                                <p>Сырой протеин 44%; сырой жир 19%; углеводы 30%; клетчатка 2%; сырая зола 5%; Ca/P: 1,2:1</p>
                                <h4>Витамины и минеральные вещества</h4>
                                <p>Витамины: витамин А 2889 МЕ; витамин Д 2164 МЕ; витамин Е 25 МЕ; витамин В1 4,34 мг; витамин В2 16,98 мг; витамин В3 27,25 мг; витамин В5 11,92 мг; витамин В6 3,77 мг; витамин В7 61 мкг; витамин В9 447 мкг; витамин В12 70 мкг.<br />
                                    Минеральные вещества: кальций 1519 мг; фосфор 1294 мг; натрий 463 мг; железо 32,63 мг; медь 3,64 мг; цинк 32,9 мг; марганец 2,67 мг; йод 1395 мкг.</p>
                                <h4>Вес суточного рациона</h4>
                                <p>882 гр.</p>
                                <h4>Стоимость</h4>
                                <p>1 060 ₽</p>
                            </div>

                        </div>
                        <div class="carte-var__content" data-menu-content="3" data-menu-price="1060" style="display: none;">

                            <button type="button" class="carte-var__btn" data-menu-replace>Заменить блюдо <span aria-hidden="true"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.32899 13.8003C6.51072 13.7787 6.69361 13.8299 6.83762 13.9429C6.98163 14.0558 7.07502 14.2212 7.09733 14.4028L7.41399 16.9795C7.43498 17.161 7.38359 17.3434 7.27096 17.4872C7.15833 17.6311 6.99354 17.7247 6.81233 17.7478L4.27483 18.0645C3.83233 18.0987 3.54649 17.8128 3.50233 17.462C3.48061 17.2799 3.53163 17.0967 3.64429 16.952C3.75696 16.8074 3.92216 16.713 4.10399 16.6895L4.94816 16.5845C3.5751 15.5463 2.56001 14.1057 2.04424 12.4634C1.52847 10.8211 1.5377 9.05881 2.07066 7.422C3.16566 4.00866 6.39316 1.66366 9.95483 1.667C10.4173 1.667 10.6898 1.99366 10.6832 2.37533C10.6723 2.75616 10.3932 3.04866 9.95483 3.04866C6.98566 3.05533 4.29816 5.00616 3.38316 7.84783C2.93552 9.22437 2.93213 10.7068 3.37346 12.0854C3.81479 13.464 4.67849 14.6688 5.84233 15.5295L5.72649 14.5728C5.71519 14.4825 5.72181 14.3909 5.74599 14.3031C5.77017 14.2154 5.81143 14.1333 5.8674 14.0615C5.92338 13.9898 5.99296 13.9297 6.07217 13.8849C6.15138 13.8401 6.23865 13.8114 6.32899 13.8003ZM15.894 3.3145L15.0498 3.4195C16.422 4.45687 17.4366 5.89629 17.9524 7.53736C18.4682 9.17843 18.4594 10.9395 17.9273 12.5753C16.8323 15.9887 13.6048 18.3337 10.0407 18.3337C9.57816 18.3337 9.30566 18.007 9.31233 17.6253C9.32316 17.2445 9.60149 16.952 10.0407 16.952C13.0098 16.9453 15.6973 14.9953 16.6123 12.1528C17.06 10.7763 17.0634 9.29383 16.622 7.91526C16.1807 6.53668 15.317 5.33181 14.1532 4.47116L14.2682 5.42783C14.2847 5.52032 14.2823 5.61521 14.2609 5.70672C14.2396 5.79823 14.1999 5.88443 14.1441 5.96007C14.0884 6.03571 14.0178 6.0992 13.9367 6.14666C13.8556 6.19412 13.7657 6.22456 13.6724 6.23613C13.5792 6.24769 13.4846 6.24013 13.3943 6.21392C13.3041 6.1877 13.2202 6.14338 13.1476 6.08365C13.0751 6.02392 13.0155 5.95004 12.9725 5.86651C12.9294 5.78298 12.9039 5.69156 12.8973 5.59783L12.5848 3.02533C12.5636 2.8436 12.615 2.66084 12.7278 2.5168C12.8407 2.37276 13.0058 2.27909 13.1873 2.25616L15.724 1.9395C16.1665 1.90533 16.4523 2.19116 16.4965 2.542C16.5182 2.72418 16.4671 2.90757 16.3542 3.05224C16.2414 3.19692 16.076 3.29117 15.894 3.3145Z" fill="white"/>
                                </svg>
                                </span></button>

                            <div class="carte-var__info">
                                <h3>Треска с сельдью, рисом и тыквой</h3>

                            </div>

                            <div class="carte-var__imgswr">
                                <div class="carte-var__img-big">
                                    <div class="carte-var__img-slider owl-carousel">
                                        <img src="https://daysi.ru/wp-content/uploads/2026/08/11s11-2-8-1024x768.jpg" alt="Треска с сельдью, рисом и тыквой">
                                        <img src="https://daysi.ru/wp-content/uploads/2026/08/11s11-1-13-1024x768.jpg" alt="Треска с сельдью, рисом и тыквой">
                                    </div>
                                </div>
                                <div class="carte-var__imgs">
                                    <img class="active" src="https://daysi.ru/wp-content/uploads/2026/08/11s11-2-8-300x225.jpg" alt="Треска с сельдью, рисом и тыквой">
                                    <img class="" src="https://daysi.ru/wp-content/uploads/2026/08/11s11-1-13-300x225.jpg" alt="Треска с сельдью, рисом и тыквой">
                                </div>
                            </div>


                            <div class="carte-var__info">
                                <h4>Состав</h4>
                                <p>Треска, сельдь атлантическая, рис длиннозерный, тыква, масло тыквенное, витаминно-минеральный премикс.</p>
                                <h4>Энергетическая ценность суточного рациона</h4>
                                <p>1090 ккал.</p>
                                <h4>Пищевая ценность суточного рациона</h4>
                                <p>Сырой протеин 44%; сырой жир 19%; углеводы 30%; клетчатка 2%; сырая зола 5%; Ca/P: 1,2:1</p>
                                <h4>Витамины и минеральные вещества</h4>
                                <p>Витамины: витамин А 2889 МЕ; витамин Д 2164 МЕ; витамин Е 25 МЕ; витамин В1 4,34 мг; витамин В2 16,98 мг; витамин В3 27,25 мг; витамин В5 11,92 мг; витамин В6 3,77 мг; витамин В7 61 мкг; витамин В9 447 мкг; витамин В12 70 мкг.<br />
                                    Минеральные вещества: кальций 1519 мг; фосфор 1294 мг; натрий 463 мг; железо 32,63 мг; медь 3,64 мг; цинк 32,9 мг; марганец 2,67 мг; йод 1395 мкг.</p>
                                <h4>Вес суточного рациона</h4>
                                <p>882 гр.</p>
                                <h4>Стоимость</h4>
                                <p>1 060 ₽</p>
                            </div>

                        </div>
                        <div class="carte-var__content" data-menu-content="4" data-menu-price="1060" style="display: none;">

                            <button type="button" class="carte-var__btn" data-menu-replace>Заменить блюдо <span aria-hidden="true"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.32899 13.8003C6.51072 13.7787 6.69361 13.8299 6.83762 13.9429C6.98163 14.0558 7.07502 14.2212 7.09733 14.4028L7.41399 16.9795C7.43498 17.161 7.38359 17.3434 7.27096 17.4872C7.15833 17.6311 6.99354 17.7247 6.81233 17.7478L4.27483 18.0645C3.83233 18.0987 3.54649 17.8128 3.50233 17.462C3.48061 17.2799 3.53163 17.0967 3.64429 16.952C3.75696 16.8074 3.92216 16.713 4.10399 16.6895L4.94816 16.5845C3.5751 15.5463 2.56001 14.1057 2.04424 12.4634C1.52847 10.8211 1.5377 9.05881 2.07066 7.422C3.16566 4.00866 6.39316 1.66366 9.95483 1.667C10.4173 1.667 10.6898 1.99366 10.6832 2.37533C10.6723 2.75616 10.3932 3.04866 9.95483 3.04866C6.98566 3.05533 4.29816 5.00616 3.38316 7.84783C2.93552 9.22437 2.93213 10.7068 3.37346 12.0854C3.81479 13.464 4.67849 14.6688 5.84233 15.5295L5.72649 14.5728C5.71519 14.4825 5.72181 14.3909 5.74599 14.3031C5.77017 14.2154 5.81143 14.1333 5.8674 14.0615C5.92338 13.9898 5.99296 13.9297 6.07217 13.8849C6.15138 13.8401 6.23865 13.8114 6.32899 13.8003ZM15.894 3.3145L15.0498 3.4195C16.422 4.45687 17.4366 5.89629 17.9524 7.53736C18.4682 9.17843 18.4594 10.9395 17.9273 12.5753C16.8323 15.9887 13.6048 18.3337 10.0407 18.3337C9.57816 18.3337 9.30566 18.007 9.31233 17.6253C9.32316 17.2445 9.60149 16.952 10.0407 16.952C13.0098 16.9453 15.6973 14.9953 16.6123 12.1528C17.06 10.7763 17.0634 9.29383 16.622 7.91526C16.1807 6.53668 15.317 5.33181 14.1532 4.47116L14.2682 5.42783C14.2847 5.52032 14.2823 5.61521 14.2609 5.70672C14.2396 5.79823 14.1999 5.88443 14.1441 5.96007C14.0884 6.03571 14.0178 6.0992 13.9367 6.14666C13.8556 6.19412 13.7657 6.22456 13.6724 6.23613C13.5792 6.24769 13.4846 6.24013 13.3943 6.21392C13.3041 6.1877 13.2202 6.14338 13.1476 6.08365C13.0751 6.02392 13.0155 5.95004 12.9725 5.86651C12.9294 5.78298 12.9039 5.69156 12.8973 5.59783L12.5848 3.02533C12.5636 2.8436 12.615 2.66084 12.7278 2.5168C12.8407 2.37276 13.0058 2.27909 13.1873 2.25616L15.724 1.9395C16.1665 1.90533 16.4523 2.19116 16.4965 2.542C16.5182 2.72418 16.4671 2.90757 16.3542 3.05224C16.2414 3.19692 16.076 3.29117 15.894 3.3145Z" fill="white"/>
                                </svg>
                                </span></button>

                            <div class="carte-var__info">
                                <h3>Треска с сельдью, рисом и тыквой</h3>

                            </div>

                            <div class="carte-var__imgswr">
                                <div class="carte-var__img-big">
                                    <div class="carte-var__img-slider owl-carousel">
                                        <img src="https://daysi.ru/wp-content/uploads/2026/08/11s11-2-8-1024x768.jpg" alt="Треска с сельдью, рисом и тыквой">
                                        <img src="https://daysi.ru/wp-content/uploads/2026/08/11s11-1-13-1024x768.jpg" alt="Треска с сельдью, рисом и тыквой">
                                    </div>
                                </div>
                                <div class="carte-var__imgs">
                                    <img class="active" src="https://daysi.ru/wp-content/uploads/2026/08/11s11-2-8-300x225.jpg" alt="Треска с сельдью, рисом и тыквой">
                                    <img class="" src="https://daysi.ru/wp-content/uploads/2026/08/11s11-1-13-300x225.jpg" alt="Треска с сельдью, рисом и тыквой">
                                </div>
                            </div>


                            <div class="carte-var__info">
                                <h4>Состав</h4>
                                <p>Треска, сельдь атлантическая, рис длиннозерный, тыква, масло тыквенное, витаминно-минеральный премикс.</p>
                                <h4>Энергетическая ценность суточного рациона</h4>
                                <p>1090 ккал.</p>
                                <h4>Пищевая ценность суточного рациона</h4>
                                <p>Сырой протеин 44%; сырой жир 19%; углеводы 30%; клетчатка 2%; сырая зола 5%; Ca/P: 1,2:1</p>
                                <h4>Витамины и минеральные вещества</h4>
                                <p>Витамины: витамин А 2889 МЕ; витамин Д 2164 МЕ; витамин Е 25 МЕ; витамин В1 4,34 мг; витамин В2 16,98 мг; витамин В3 27,25 мг; витамин В5 11,92 мг; витамин В6 3,77 мг; витамин В7 61 мкг; витамин В9 447 мкг; витамин В12 70 мкг.<br />
                                    Минеральные вещества: кальций 1519 мг; фосфор 1294 мг; натрий 463 мг; железо 32,63 мг; медь 3,64 мг; цинк 32,9 мг; марганец 2,67 мг; йод 1395 мкг.</p>
                                <h4>Вес суточного рациона</h4>
                                <p>882 гр.</p>
                                <h4>Стоимость</h4>
                                <p>1 060 ₽</p>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="carte__right">
                    <div class="carte__right-wr">
                        <h1 class="carte__title">Рационы на рыбе, крупе и овощах для собак весом 23-25 кг.</h1>
                        <div class="carte__term">
                            <p class="carte__term-name">Срок</p>
                            <div class="carte__term-tabs" role="tablist" aria-label="Срок рациона">
                                <button type="button" class="carte__term-tab active" data-menu-limit="3" data-day="3" data-period-value="3 дня" aria-selected="true">3 дня</button>
                                <button type="button" class="carte__term-tab " data-menu-limit="5" data-day="5" data-period-value="5 дней" aria-selected="false">5 дней</button>
                                <button type="button" class="carte__term-tab " data-menu-limit="5" data-day="30" data-period-value="1 месяц" aria-selected="false">1 месяц</button>
                            </div>
                            <div class="carte__term-text">
                                В месячный рацион входят 6 пятидневных рационов. При необходимости рационы можно заменить ниже.
                            </div>

                        </div>

                        <div class="carte__right-contents">
                            <div class="carte__right-content" style="display: block;">
                                <div class="carte__right-price">
                                    <p>Итого:</p>
                                    <span data-product-price>3 180 ₽</span>
                                </div>
                                <form class="dicey-product-cart" method="post" action="https://daysi.ru/basket/">
                                    <input type="hidden" name="add-to-cart" value="652">
                                    <input type="hidden" name="product_id" value="652">
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="dicey_product_period" value="3 дня" data-product-period-input>
                                    <input type="hidden" name="dicey_product_menu_selection" value="0,1,2" data-product-menu-selection-input>
                                    <div class="carte__right-btns">
                                        <button type="submit" name="dicey_product_action" value="checkout" class="carte__right-btn">Перейти к оформлению</button>
                                        <button type="submit" name="dicey_product_action" value="cart" class="carte__right-btn blue">В корзину</button>
                                    </div>
                                </form>

                                <div class="carte__right-info">
                                    <h3>Описание рациона</h3>
                                    <p><strong>Рыбное меню с треской и сельдью — максимум океанской пользы для вашего питомца!</strong></p>
                                    <p>Подарите любимцу рацион, созданный на основе ценных морских рыб: нежная треска обеспечивает лёгкий диетический белок, а атлантическая сельдь добавляет полезные омега-3 жирные кислоты — для здоровья сердца, суставов и сияющей шерсти.</p>
                                    <p>В качестве гарнира — длиннозерный рис, который легко усваивается и даёт питомцу энергию, а также мягкая тыква, богатая бета-каротином и клетчаткой для комфортного пищеварения. Тыквенное масло усиливает пользу рациона, поддерживая иммунитет и работу ЖКТ.</p>
                                    <p>Витаминно-минеральная добавка гарантирует полный баланс микроэлементов. Блюда чередуются: отварные и тушёные — без соли и специй, с сохранением натурального вкуса и всех питательных веществ.</p>
                                    <p>Суточный рацион разделен на утренний и вечерний приемы, которые поставляются на каждый день в двух лотках равными порциями.</p>
                                    <p><strong>!!! РАЦИОНЫ С РЫБОЙ И МОРЕПРОДУКТАМИ РЕКОМЕНДУЕТСЯ ДАВАТЬ ПИТОМЦАМ НЕ ЧАЩЕ 1 РАЗА В МЕСЯЦ !!!</strong></p>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="carte__dietary" style="display: none;" aria-hidden="true">
                        <div class="carte__dietary-top">
                            <h3>Соберите свой рацион</h3>
                        </div>
                        <div class="carte__dietary-blocks">
                            <div class="carte__dietary-block active">
                                <p class="carte__dietary-num"><span>1</span> рацион</p>
                                <div class="carte__dietary-wr">
                                    <img src="https://daysi.ru/wp-content/uploads/2026/08/11s11-2-8-300x225.jpg" alt="Рационы на рыбе, крупе и овощах для собак весом 23-25 кг." class="carte__dietary-img">
                                    <div class="carte__dietary-info">
                                        <p class="carte__dietary-name">Рационы на рыбе, крупе и овощах для собак весом 23-25 кг.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="carte__dietary-block ">
                                <p class="carte__dietary-num"><span>2</span> рацион</p>
                                <div class="carte__dietary-wr">
                                    <img src="https://daysi.ru/wp-content/uploads/2026/08/11s11-2-8-300x225.jpg" alt="Рационы на рыбе, крупе и овощах для собак весом 23-25 кг." class="carte__dietary-img">
                                    <div class="carte__dietary-info">
                                        <p class="carte__dietary-name">Рационы на рыбе, крупе и овощах для собак весом 23-25 кг.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="carte__dietary-block ">
                                <p class="carte__dietary-num"><span>3</span> рацион</p>
                                <div class="carte__dietary-wr">
                                    <img src="https://daysi.ru/wp-content/uploads/2026/08/11s11-2-8-300x225.jpg" alt="Рационы на рыбе, крупе и овощах для собак весом 23-25 кг." class="carte__dietary-img">
                                    <div class="carte__dietary-info">
                                        <p class="carte__dietary-name">Рационы на рыбе, крупе и овощах для собак весом 23-25 кг.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="carte__dietary-block ">
                                <p class="carte__dietary-num"><span>4</span> рацион</p>
                                <div class="carte__dietary-wr">
                                    <img src="https://daysi.ru/wp-content/uploads/2026/08/11s11-2-8-300x225.jpg" alt="Рационы на рыбе, крупе и овощах для собак весом 23-25 кг." class="carte__dietary-img">
                                    <div class="carte__dietary-info">
                                        <p class="carte__dietary-name">Рационы на рыбе, крупе и овощах для собак весом 23-25 кг.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="carte__dietary-block ">
                                <p class="carte__dietary-num"><span>5</span> рацион</p>
                                <div class="carte__dietary-wr">
                                    <img src="https://daysi.ru/wp-content/uploads/2026/08/11s11-2-8-300x225.jpg" alt="Рационы на рыбе, крупе и овощах для собак весом 23-25 кг." class="carte__dietary-img">
                                    <div class="carte__dietary-info">
                                        <p class="carte__dietary-name">Рационы на рыбе, крупе и овощах для собак весом 23-25 кг.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="carte__dietary-block ">
                                <p class="carte__dietary-num"><span>6</span> рацион</p>
                                <div class="carte__dietary-wr">
                                    <img src="https://daysi.ru/wp-content/uploads/2026/08/11s11-2-8-300x225.jpg" alt="Рационы на рыбе, крупе и овощах для собак весом 23-25 кг." class="carte__dietary-img">
                                    <div class="carte__dietary-info">
                                        <p class="carte__dietary-name">Рационы на рыбе, крупе и овощах для собак весом 23-25 кг.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="questions__blocks">
                        <div class="questions__block">
                            <div class="questions__top">
                                <p>Как кормить?</p>
                                <svg width="29" height="23" viewBox="0 0 29 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_719_9436)">
                                        <path d="M13.207 1.95898C14.2337 7.24048 15.8576 12.7843 15.9153 18.209C15.9272 19.3202 16.0498 20.4341 16.1237 21.5423" stroke="#5182A6" stroke-width="2.5" stroke-linecap="round" />
                                        <path d="M3 13.5C10.9996 13.1361 18.9979 12.8042 27 12.5" stroke="#5182A6" stroke-width="2.5" stroke-linecap="round" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_719_9436">
                                            <rect width="29" height="23" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="questions__content" style="display: none;">
                                <p>Удалить защитную пленку, разогреть в СВЧ не более 1 минуты при мощности 800 WT до температуры 37 градусов, после чего дать питомцу. По желанию все ингредиенты можно смешать. Рекомендуется кормить питомца утром и вечером после прогулки. Вода должна быть доступна питомцу в любое время.</p>
                            </div>
                        </div>
                        <div class="questions__block">
                            <div class="questions__top">
                                <p>Как хранить?</p>
                                <svg width="29" height="23" viewBox="0 0 29 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_719_9436)">
                                        <path d="M13.207 1.95898C14.2337 7.24048 15.8576 12.7843 15.9153 18.209C15.9272 19.3202 16.0498 20.4341 16.1237 21.5423" stroke="#5182A6" stroke-width="2.5" stroke-linecap="round" />
                                        <path d="M3 13.5C10.9996 13.1361 18.9979 12.8042 27 12.5" stroke="#5182A6" stroke-width="2.5" stroke-linecap="round" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_719_9436">
                                            <rect width="29" height="23" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="questions__content" style="display: none;">
                                <p>Хранить при температуре +2...+5 градусов.</p>
                            </div>
                        </div>
                        <div class="questions__block">
                            <div class="questions__top">
                                <p>Доставка</p>
                                <svg width="29" height="23" viewBox="0 0 29 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_719_9436)">
                                        <path d="M13.207 1.95898C14.2337 7.24048 15.8576 12.7843 15.9153 18.209C15.9272 19.3202 16.0498 20.4341 16.1237 21.5423" stroke="#5182A6" stroke-width="2.5" stroke-linecap="round" />
                                        <path d="M3 13.5C10.9996 13.1361 18.9979 12.8042 27 12.5" stroke="#5182A6" stroke-width="2.5" stroke-linecap="round" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_719_9436">
                                            <rect width="29" height="23" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="questions__content" style="display: none;">
                                <p>Доставка осуществляется в коробках.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?
}
?>
<?php wp_footer(); ?>


</body>

</html>




<?php
echo dicey_rewrite_legacy_html(ob_get_clean());
