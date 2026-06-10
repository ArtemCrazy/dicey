<? require_once("header.php"); ?>

<main>
    <section class="main main2">
        <div class="container">
            <div class="main-wr">
                <div class="standart-nav">
                    <a href="#">Главная</a>
                    <p>Диетология</p>
                </div>
                <h1 class="main__title">Правильное питание <span> — основа здоровья собаки</span></h1>
                <p class="main__text">Подберем и приготовим рацион с учётом возраста, породы и состояния здоровья вашего питомца</p>
                <button data-fancybox data-src="#consult-modal" class="main__link xs-hide">
                    получить консультацию
                    <svg width="26" height="25" viewBox="0 0 26 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_2002_287)">
                            <path d="M19.4796 17.2625C18.4227 16.29 17.8689 15.8525 16.9004 14.0013C16.0593 12.3825 15.1103 11.0675 12.9523 11.0675H12.8054C10.6461 11.0675 9.69835 12.3825 8.85725 14.0013C7.88875 15.8525 7.33495 16.29 6.27805 17.2625C5.23935 18.2163 4.28125 19.4163 4.28125 21.0013C4.28125 22.8588 5.66705 24.635 7.87055 24.635C9.54495 24.635 10.8658 23.8075 12.8781 23.7788C14.4837 23.7538 15.6862 24.635 17.8871 24.635C20.0906 24.635 21.6259 22.8588 21.6259 21.0013C21.6259 19.4163 20.6158 18.2675 19.4796 17.2625Z" fill="white" />
                            <path d="M6.09067 9.98999C5.14817 8.22124 3.88197 7.55999 2.85367 7.61874C1.40807 7.70374 0.351172 9.36499 0.369372 11.215C0.386272 13.1237 1.57187 15.1662 3.42957 15.8412C3.82087 15.9812 4.21347 16.015 4.62297 15.9137C6.24537 15.63 7.43877 13.6037 6.09067 9.98999Z" fill="white" />
                            <path d="M8.56046 0.375C6.83146 0.375 5.66406 2.14375 5.66406 4.5625C5.66406 7.2575 7.19806 10.0825 9.27286 10.0825C10.9486 10.0825 12.1251 8.24 12.1251 6.1C12.1251 3.77625 10.634 0.375 8.56046 0.375Z" fill="white" />
                            <path d="M17.415 0.375C15.9954 0.375 14.8943 1.79125 14.1715 3.49375C13.8387 4.33 13.6827 5.21125 13.6918 6.10125C13.7087 8.1525 14.8449 10.1075 16.583 10.1075C18.351 10.1075 20.1437 7.51 20.1437 4.54625C20.1437 2.47875 19.0881 0.375 17.415 0.375Z" fill="white" />
                            <path d="M23.1072 7.61877C21.6434 7.52627 20.2056 9.12002 19.5491 10.88C18.7626 12.9963 19.3164 15.3288 20.8517 15.85C21.1117 15.9175 21.3717 15.9775 21.6317 15.96C23.3438 15.85 25.1196 13.965 25.5278 11.7638C25.8606 10.0413 24.7868 7.73002 23.1072 7.61877Z" fill="white" />
                        </g>
                        <defs>
                            <clipPath id="clip0_2002_287">
                                <rect width="26" height="25" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                </button>
            </div>
            <img src="static/imgs/bg/main-img2.png" alt="" class="main__img">
            <a href="#" class="main__link xs-show">
                Выбрать рацион
                <svg width="26" height="25" viewBox="0 0 26 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_2002_287)">
                        <path d="M19.4796 17.2625C18.4227 16.29 17.8689 15.8525 16.9004 14.0013C16.0593 12.3825 15.1103 11.0675 12.9523 11.0675H12.8054C10.6461 11.0675 9.69835 12.3825 8.85725 14.0013C7.88875 15.8525 7.33495 16.29 6.27805 17.2625C5.23935 18.2163 4.28125 19.4163 4.28125 21.0013C4.28125 22.8588 5.66705 24.635 7.87055 24.635C9.54495 24.635 10.8658 23.8075 12.8781 23.7788C14.4837 23.7538 15.6862 24.635 17.8871 24.635C20.0906 24.635 21.6259 22.8588 21.6259 21.0013C21.6259 19.4163 20.6158 18.2675 19.4796 17.2625Z" fill="white" />
                        <path d="M6.09067 9.98999C5.14817 8.22124 3.88197 7.55999 2.85367 7.61874C1.40807 7.70374 0.351172 9.36499 0.369372 11.215C0.386272 13.1237 1.57187 15.1662 3.42957 15.8412C3.82087 15.9812 4.21347 16.015 4.62297 15.9137C6.24537 15.63 7.43877 13.6037 6.09067 9.98999Z" fill="white" />
                        <path d="M8.56046 0.375C6.83146 0.375 5.66406 2.14375 5.66406 4.5625C5.66406 7.2575 7.19806 10.0825 9.27286 10.0825C10.9486 10.0825 12.1251 8.24 12.1251 6.1C12.1251 3.77625 10.634 0.375 8.56046 0.375Z" fill="white" />
                        <path d="M17.415 0.375C15.9954 0.375 14.8943 1.79125 14.1715 3.49375C13.8387 4.33 13.6827 5.21125 13.6918 6.10125C13.7087 8.1525 14.8449 10.1075 16.583 10.1075C18.351 10.1075 20.1437 7.51 20.1437 4.54625C20.1437 2.47875 19.0881 0.375 17.415 0.375Z" fill="white" />
                        <path d="M23.1072 7.61877C21.6434 7.52627 20.2056 9.12002 19.5491 10.88C18.7626 12.9963 19.3164 15.3288 20.8517 15.85C21.1117 15.9175 21.3717 15.9775 21.6317 15.96C23.3438 15.85 25.1196 13.965 25.5278 11.7638C25.8606 10.0413 24.7868 7.73002 23.1072 7.61877Z" fill="white" />
                    </g>
                    <defs>
                        <clipPath id="clip0_2002_287">
                            <rect width="26" height="25" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
            </a>
        </div>
    </section>
    <section class="consultation">
        <div class="container">
            <h2 class="conveniences__title">Вам нужна консультация если у Вас:</h2>
            <div class="consultation__blocks">
                <div class="consultation__block">
                    <img src="static/imgs/bg/consultation__img1.svg" alt="" class="consultation__img">
                    <p class="consultation__text">Щенок</p>
                </div>
                <div class="consultation__block">
                    <img src="static/imgs/bg/consultation__img2.svg" alt="" class="consultation__img">
                    <p class="consultation__text">Беременная или лактирующая собака</p>
                </div>
                <div class="consultation__block">
                    <img src="static/imgs/bg/consultation__img3.svg" alt="" class="consultation__img">
                    <p class="consultation__text">Питомец с лишним или недостаточным весом </p>
                </div>
                <div class="consultation__block">
                    <img src="static/imgs/bg/consultation__img4.svg" alt="" class="consultation__img">
                    <p class="consultation__text">У собаки есть заболевания</p>
                </div>
                <div class="consultation__block">
                    <img src="static/imgs/bg/consultation__img5.svg" alt="" class="consultation__img xs-hide">
                    <img src="static/imgs/bg/consultation__img7.svg" alt="" class="consultation__img xs-show">
                    <p class="consultation__text">Собака с пищевой аллергия или непереносимостью</p>
                </div>
                <div class="consultation__block">
                    <img src="static/imgs/bg/consultation__img6.svg" alt="" class="consultation__img">
                    <p class="consultation__text">Ваш хвостик привередлив в еде</p>
                </div>
            </div>
        </div>
    </section>
    <section class="plan plan2">
        <div class="container">
            <div class="plan__img-wr">
                <img src="static/imgs/bg/plan__img2.png" alt="" class="plan__img-people">
                <div class="plan__img-shadow"></div>
                <div class="plan__img-info">
                    <p class="plan__img-name">Босунова Наталья</p>
                    <p class="plan__img-text">Главный ветеринар-диетолог <br> компании</p>
                </div>
            </div>
            <div class="plan__wr">
                <h2 class="plan__title">Составление рациона питания </h2>
                <p class="plan__subname">ветеринарным врачом-диетологом</p>
                <p class="plan__text">
                    Поможем разобраться в рационе и подобрать питание с учётом особенностей собаки. Рекомендации подходят для ежедневного кормления и легко применяются на практике
                </p>
                <div class="plan__imgs">
                    <a href="static/imgs/bg/plan__img1.png" data-fancybox class="plan__img">
                        <img src="static/imgs/bg/plan__img1.png" alt="">
                    </a>
                    <a href="static/imgs/bg/plan__img3.png" data-fancybox class="plan__img">
                        <img src="static/imgs/bg/plan__img3.png" alt="">
                    </a>
                </div>
                <a href="#" class="plan__imgs-link">Смотреть все сертификаты</a>
            </div>
           
        </div>
    </section>
    <section class="advisory">
        <div class="container">
            <h2 class="popularity__title">Как проходит консультация</h2>
            <div class="advisory__blocks">
                <div class="advisory__block">
                    <span class="works__block-number"></span>
                    <div class="advisory__info">
                        <p class="advisory__name">Заполняете заявку и оплачиваете консультацию</p>
                        <p class="advisory__text">Оставляете контактные данные, <br> чтобы мы могли связаться с вами</p>
                    </div>
                    <button class="advisory__btn" data-fancybox data-src="#consult-modal">Получить консультацию</button>
                </div>
                <div class="advisory__block">
                    <span class="works__block-number"></span>
                    <div class="advisory__info">
                        <p class="advisory__name">Заполняете анкету о вашей собаке</p>
                        <p class="advisory__text">После оплаты вы получаете на почту короткую анкету (3–5 минут). После её заполнения мы свяжемся с вами и согласуем время онлайн-консультации с диетологом</p>
                        <img src="static/imgs/icons/advisory__icon.svg" alt="" class="advisory__icon">
                    </div>
                </div>
                <div class="advisory__block">
                    <span class="works__block-number"></span>
                    <div class="advisory__info">
                        <p class="advisory__name">Диетолог проводит консультацию</p>
                        <p class="advisory__text">Изучаем особенности вашей собаки, отвечаем на вопросы и уточняетм все особенности питания собаки</p>
                        <img src="static/imgs/icons/advisory__icon2.svg" alt="" class="advisory__icon">
                    </div>
                </div>
               <div class="advisory__block">
                    <span class="works__block-number"></span>
                    <div class="advisory__info">
                        <p class="advisory__name">Мы составляем рацион</p>
                        <p class="advisory__text">Составляем подходящее меню по результатам консультации</p>
                        <img src="static/imgs/icons/advisory__icon3.svg" alt="" class="advisory__icon">
                    </div>
                </div>
              <div class="advisory__block">
                    <span class="works__block-number"></span>
                    <div class="advisory__info">
                        <p class="advisory__name">Передаём план питания </p>
                        <p class="advisory__text">и при необходимости оформляем доставку</p>
                        <img src="static/imgs/icons/advisory__icon4.svg" alt="" class="advisory__icon">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="advantages">
        <div class="container">
            <h2 class="popularity__title">Что вы получите после <br> консультации</h2>
            <div class="advantages__blocks">
                <div class="advantages__block">
                    <img src="static/imgs/bg/advantages__img1.png" alt="" class="advantages__img">
                    <p class="advantages__name">Понятный <br> план питания</p>
                </div>
                <div class="advantages__block">
                    <img src="static/imgs/bg/advantages__img.png" alt="" class="advantages__img">
                    <p class="advantages__name">Подходящий <br> рацион</p>
                </div>
                <div class="advantages__block">
                    <img src="static/imgs/bg/advantages__img3.svg" alt="" class="advantages__img">
                    <p class="advantages__name">Рекомендации <br> по кормлению</p>
                </div>
                <div class="advantages__block">
                    <img src="static/imgs/bg/advantages__img4.png" alt="" class="advantages__img">
                    <p class="advantages__name">Уверенность <br> в выборе питания</p>
                </div>
            </div>
        </div>
    </section>
    <section class="price">
        <div class="container">
            <h2 class="popularity__title">Стоимость консультаций</h2>
            <div class="price__blocks">
                <div class="price__block">
                    <div class="price__head">
                    <h3 class="price__title">Консультация ветеринарного врача диетолога/гастроэнтеролога</h3>
                    <p class="price__text">При заказе рациона стоимость консультации возвращается при оплате, без заказа рациона стоимость 1500 руб.</p>
                    </div>
                    <div class="price__info">
                    <div class="price__list">
                        <ul>
                            <li>Ответы на вопросы</li>
                            <li>Разбор анализов и дополнительных исследований</li>
                            <li>Рекомендации по лечению</li>
                        </ul>
                    </div>
                    <button class="price__btn" data-fancybox data-src="#consult-modal">Заказать консультацию и подобрать рацион</button>
                    </div>
                </div>
                <div class="price__block">
                    <div class="price__head">
                    <h3 class="price__title">Подбор рациона для  здорового питомца</h3>
                    <p class="price__text">При заказе рациона стоимость консультации возвращается при оплате, без заказа рациона стоимость 3000 руб.</p>
                    </div>
                    <div class="price__info">
                    <div class="price__list">
                        <ul>
                            <li>Составлениеи индивидуальное  рациона питания</li>
                            <li>Ответы на вопросы по рациону</li>
                            <li>Рекомендации по лечению</li>
                        </ul>
                    </div>
                    <button class="price__btn" data-fancybox data-src="#consult-modal">Заказать консультацию и подобрать рацион</button>
                    </div>
                </div>
                <div class="price__block">
                    <div class="price__head">
                    <h3 class="price__title">Подбор рациона для питомца с заболеванием </h3>
                    <p class="price__text">При заказе рациона стоимость консультации возвращается при оплате, без заказа рациона стоимость 3500 руб.</p>
                    </div>
                    <div class="price__info">
                    <div class="price__list">
                        <ul>
                            <li>Индивидуальное составление рациона питания при заболевании</li>
                            <li>Ответы на вопросы по рациону</li>
                            <li>Рекомендации по кормлению </li>
                        </ul>
                    </div>
                    <button class="price__btn" data-fancybox data-src="#consult-modal">Заказать консультацию и подобрать рацион</button>
                    </div>
                </div>
                <div class="price__block">
                    <div class="price__head">
                    <h3 class="price__title">Ведение</h3>
                    <p class="price__text">При заказе рациона стоимость консультации возвращается при оплате, без заказа рациона стоимость 2500 руб.</p>
                    </div>
                    <div class="price__info">
                    <div class="price__list">
                        <ul>
                            <li>Необходимо для питомцев с заболеваниями, чтобы контролировать состояние питомца  и по необходимости корректировать лечение</li>
                            <li>Ответы на вопросы по рациону</li>
                            <li>Рекомендации по кормлению </li>
                        </ul>
                    </div>
                    <button class="price__btn" data-fancybox data-src="#consult-modal">Заказать консультацию и подобрать рацион</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="questions2">
        <div class="container">
            <h2 class="popularity__title">часто задаваемые вопросы</h2>
            <div class="questions__blocks">
                <div class="questions__block">
                    <div class="questions__top">
                        <p>Что входит в консультацию?</p>
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
                        <p>
                            Да, рацион подбирается индивидуально с учётом породы, возраста, веса, уровня активности и особенностей здоровья вашей собаки. Мы учитываем пищевые предпочтения, чувствительное пищеварение, аллергии и другие важные нюансы, чтобы питание было комфортным и полезным именно для вашего питомца.
                        </p>
                    </div>
                </div>
                <div class="questions__block">
                    <div class="questions__top">
                        <p>Кто проводит консультацию?</p>
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
                        <p>
                            Да, рацион подбирается индивидуально с учётом породы, возраста, веса, уровня активности и особенностей здоровья вашей собаки. Мы учитываем пищевые предпочтения, чувствительное пищеварение, аллергии и другие важные нюансы, чтобы питание было комфортным и полезным именно для вашего питомца.
                        </p>
                    </div>
                </div>
                <div class="questions__block">
                    <div class="questions__top">
                        <p>Консультация проходит онлайн или офлайн?</p>
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
                        <p>
                            Да, рацион подбирается индивидуально с учётом породы, возраста, веса, уровня активности и особенностей здоровья вашей собаки. Мы учитываем пищевые предпочтения, чувствительное пищеварение, аллергии и другие важные нюансы, чтобы питание было комфортным и полезным именно для вашего питомца.
                        </p>
                    </div>
                </div>
                <div class="questions__block">
                    <div class="questions__top">
                        <p>Можно задать любые вопросы по питанию?</p>
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
                        <p>
                            Да, рацион подбирается индивидуально с учётом породы, возраста, веса, уровня активности и особенностей здоровья вашей собаки. Мы учитываем пищевые предпочтения, чувствительное пищеварение, аллергии и другие важные нюансы, чтобы питание было комфортным и полезным именно для вашего питомца.
                        </p>
                    </div>
                </div>
                <div class="questions__block">
                    <div class="questions__top">
                        <p>Вы подбираете рацион под мою собаку?</p>
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
                        <p>
                            Да, рацион подбирается индивидуально с учётом породы, возраста, веса, уровня активности и особенностей здоровья вашей собаки. Мы учитываем пищевые предпочтения, чувствительное пищеварение, аллергии и другие важные нюансы, чтобы питание было комфортным и полезным именно для вашего питомца.
                        </p>
                    </div>
                </div>
                <div class="questions__block">
                    <div class="questions__top">
                        <p>Можно ли перейти с сухого корма?</p>
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
                        <p>
                            Да, рацион подбирается индивидуально с учётом породы, возраста, веса, уровня активности и особенностей здоровья вашей собаки. Мы учитываем пищевые предпочтения, чувствительное пищеварение, аллергии и другие важные нюансы, чтобы питание было комфортным и полезным именно для вашего питомца.
                        </p>
                    </div>
                </div>
                <div class="questions__block">
                    <div class="questions__top">
                        <p>Это питание на каждый день?</p>
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
                        <p>
                            Да, рацион подбирается индивидуально с учётом породы, возраста, веса, уровня активности и особенностей здоровья вашей собаки. Мы учитываем пищевые предпочтения, чувствительное пищеварение, аллергии и другие важные нюансы, чтобы питание было комфортным и полезным именно для вашего питомца.
                        </p>
                    </div>
                </div>
                <div class="questions__block">
                    <div class="questions__top">
                        <p>Можно кормить данными рационами если у моей собаки пищевая аллергия или чувствительное пищеварение?</p>
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
                        <p>
                            Да, рацион подбирается индивидуально с учётом породы, возраста, веса, уровня активности и особенностей здоровья вашей собаки. Мы учитываем пищевые предпочтения, чувствительное пищеварение, аллергии и другие важные нюансы, чтобы питание было комфортным и полезным именно для вашего питомца.
                        </p>
                    </div>
                </div>
                <div class="questions__block">
                    <div class="questions__top">
                        <p>Подойдет ли рацион моему питомцу?</p>
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
                        <p>
                            Да, рацион подбирается индивидуально с учётом породы, возраста, веса, уровня активности и особенностей здоровья вашей собаки. Мы учитываем пищевые предпочтения, чувствительное пищеварение, аллергии и другие важные нюансы, чтобы питание было комфортным и полезным именно для вашего питомца.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <? require_once("blocks/why.php"); ?>
</main>

<? require_once("footer.php"); ?>