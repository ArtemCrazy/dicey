<? require_once("header.php"); ?>

<main>
    <section class="decoration">
        <div class="container">
            <div class="decoration__head">
                <div class="standart-nav">
                    <a href="#">Главная</a>
                    <a href="#">Корзина</a>
                    <p>Оформление заказа</p>
                </div>
                <h1 class="decoration__title">Оформление заказа</h1>
            </div>
            <div class="decoration__wr">
                <form class="decoration__left">
                    <div class="decoration__block">
                        <p class="decoration__name">Покупатель</p>
                        <div class="decoration__inputs">
                            <input type="text" class="decoration__input" placeholder="Имя и Фамилия">
                            <input type="email" class="decoration__input" placeholder="Почта">
                            <input type="tel" class="decoration__input" placeholder="Телефон">
                        </div>
                    </div>
                    <div class="decoration__block">
                        <p class="decoration__name">Адрес доставки</p>
                        <div class="decoration__inputs">
                            <details class="select-box">
                                <summary>
                                  <span>Город</span>
                            
                                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path fill-rule="evenodd" clip-rule="evenodd" d="M12.3982 15.203C12.1785 15.4226 11.8224 15.4226 11.6027 15.203L5.86788 9.46808C5.64821 9.24841 5.64821 8.89231 5.86788 8.67263L6.13305 8.40743C6.35271 8.18776 6.70887 8.18776 6.92854 8.40743L12.0005 13.4794L17.0724 8.40743C17.2921 8.18776 17.6482 8.18776 17.8679 8.40743L18.1331 8.67263C18.3527 8.89231 18.3527 9.24841 18.1331 9.46808L12.3982 15.203Z" fill="#5182A6"></path>
                                      </svg>
                                      
                                </summary>
                            
                                <ul class="dropdown">
                                  <div class="dropdown-wr">
                                  <li>Город 1</li>
                                  <li>Город 2</li>
                                  <li>Город 3</li>
                                  <li>Город 1</li>
                                  <li>Город 2</li>
                                  <li>Город 3</li>
                                  </div>
                                </ul>
                                <input type="hidden" name="city" value="">
                              </details>
                            <input type="text" class="decoration__input" placeholder="Адрес">
                        </div>
                    </div>
                    <div class="decoration__block">
                        <p class="decoration__name">Промокод</p>
                        <div class="decoration__inputs">
                            <input type="text" class="decoration__input" placeholder="Введите промокод">
                        </div>
                    </div>
                    <div class="decoration__methods">
                        <p class="decoration__name">Способ оплаты</p>
                        <div class="decoration__methods-blocks">
                            <div class="decoration__methods-block active">
                                <div class="decoration__icon">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 13C8.45 13 7.97933 12.8043 7.588 12.413C7.19667 12.0217 7.00067 11.5507 7 11C6.99933 10.4493 7.19533 9.97867 7.588 9.588C7.98067 9.19733 8.45133 9.00133 9 9C9.54867 8.99867 10.0197 9.19467 10.413 9.588C10.8063 9.98133 11.002 10.452 11 11C10.998 11.548 10.8023 12.019 10.413 12.413C10.0237 12.807 9.55267 13.0027 9 13ZM4.375 4H13.625L14.9 1.45C15.0667 1.11667 15.054 0.791667 14.862 0.475C14.67 0.158333 14.3827 0 14 0H4C3.61667 0 3.32933 0.158333 3.138 0.475C2.94667 0.791667 2.934 1.11667 3.1 1.45L4.375 4ZM5.4 18H12.6C14.1 18 15.375 17.4793 16.425 16.438C17.475 15.3967 18 14.1173 18 12.6C18 11.9667 17.8917 11.35 17.675 10.75C17.4583 10.15 17.15 9.60833 16.75 9.125L14.15 6H3.85L1.25 9.125C0.85 9.60833 0.541667 10.15 0.325 10.75C0.108333 11.35 0 11.9667 0 12.6C0 14.1167 0.521 15.396 1.563 16.438C2.605 17.48 3.884 18.0007 5.4 18Z" fill="#EEF5FF"/>
                                    </svg>                                        
                                </div>
                                Наличными курьеру
                            </div>
                            <div class="decoration__methods-block">
                                <div class="decoration__icon">
                                    <svg width="21" height="16" viewBox="0 0 21 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.000785751 3.71054H20.2204V2.85411C20.2204 0.957786 19.2539 0 17.3293 0H2.89182C0.967607 0 0.000392922 0.957786 0.000392922 2.8545L0.000785751 3.71054ZM0.000785751 12.6421C0.000785751 14.5389 0.967214 15.4872 2.89182 15.4872H17.3293C19.2535 15.4872 20.2208 14.5389 20.2208 12.6421V5.80093H0L0.000785751 12.6421ZM3.07607 10.3954V8.69196C3.07607 8.17654 3.43514 7.80804 3.97846 7.80804H6.23425C6.77757 7.80804 7.13664 8.17654 7.13664 8.69196V10.3954C7.13664 10.9202 6.77757 11.2793 6.23425 11.2793H3.97807C3.43475 11.2793 3.07607 10.9202 3.07607 10.3954Z" fill="#EEF5FF"/>
                                        </svg>                                                                               
                                </div>
                                Банковская карта
                            </div>
                            <div class="decoration__methods-block">
                                <div class="decoration__icon">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.1034 3.2625L15.0984 2.8425V9.615L16.9209 5.22C17.2284 4.455 16.8759 3.5775 16.1034 3.2625ZM1.47845 6.0375L5.19845 15C5.30799 15.2727 5.49484 15.5074 5.73602 15.6753C5.9772 15.8432 6.2622 15.9369 6.55595 15.945C6.75095 15.945 6.95345 15.9075 7.14845 15.825L12.676 13.5375C13.2385 13.305 13.5834 12.75 13.5984 12.195C13.6059 12 13.5684 11.7825 13.5009 11.5875L9.75095 2.625C9.64529 2.35028 9.4592 2.11383 9.21701 1.94657C8.97481 1.77931 8.68778 1.68902 8.39345 1.6875C8.19845 1.6875 8.00345 1.7325 7.81595 1.8L2.29595 4.0875C1.92902 4.23776 1.63678 4.52758 1.48348 4.89325C1.33019 5.25892 1.32837 5.6705 1.47845 6.0375ZM13.591 3.1875C13.591 2.78968 13.4329 2.40814 13.1516 2.12684C12.8703 1.84554 12.4888 1.6875 12.091 1.6875H11.0035L13.591 7.9425" fill="#EEF5FF"/>
                                        </svg>
                                                                                                                      
                                </div>
                                Оплата долями
                            </div>
                        </div>
                    </div>
                    <label class="checkbox__parent">
                        <input type="checkbox" name="checkbox" required="" checked>
                        <span class="checkbox__icon">
                            <svg width="12" height="9" viewBox="0 0 12 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11 0L4 6.5L1 4L0 4.5L4 9L12 0.5L11 0Z" fill="#5182A6"/>
                                </svg>
                                
                        </span>
                        
                        <p class="consult__text">
                            Я  <a href="policy.php">даю своё согласие на обработку персональных данных</a> в соответствии <a href="policy.php">с политикой конфиденциальности, ознакомлен с договором оферты</a>
                        </p>
                    </label>
                    <button class="decoration__btn">Оплатить</button>
                </form>
                <div class="decoration__right">
                    <div class="decoration__right-head">
                        <p class="decoration__right-title">Ваш заказ</p>
                        <div class="decoration__right-col">2 рациона</div>
                    </div>
                    <div class="decoration__right-blocks">
                        <div class="decoration__right-block">
                            <div class="decoration__right-wr">
                                <img src="static/imgs/bg/decoration__right-img.png" alt="" class="decoration__right-img">
                                <div class="decoration__right-info">
                                    <p class="decoration__right-name">С курицей с крупой для собак весом 3-5 кг</p>
                                    <p class="decoration__right-date">3 дня</p>
                                </div>
                            </div>
                            <div class="decoration__result">
                                <p class="decoration__result-value">5 000 ₽</p>
                            </div>
                        </div>
                        <div class="decoration__right-block">
                            <div class="decoration__right-wr">
                                <img src="static/imgs/bg/decoration__right-img.png" alt="" class="decoration__right-img">
                                <div class="decoration__right-info">
                                    <p class="decoration__right-name">С кроликом и крупой, для собак с весом 5 кг</p>
                                    <p class="decoration__right-date">1 месяц</p>
                                </div>
                            </div>
                            <div class="decoration__result">
                                <p class="decoration__result-value">20 000 ₽</p>
                            </div>
                        </div>
                    </div>
                    <div class="decoration__bottom">
                        <div class="decoration__sale-wr">
                            <p class="decoration__sale-text">Скидка (возврат стоимости консультации):</p>
                            <p class="decoration__sale-value">-3000₽</p>
                        </div>
                        <div class="decoration__total-wr">
                            <p class="decoration__total-text">Итого:</p>
                            <p class="decoration__total-value">22 000 ₽</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<? require_once("footer.php"); ?>