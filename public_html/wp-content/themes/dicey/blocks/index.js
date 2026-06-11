( function ( blocks, element, components, i18n, data, blockEditor ) {
	var el = element.createElement;
	var __ = i18n.__;
	var TextControl = components.TextControl;
	var TextareaControl = components.TextareaControl;
	var PanelBody = components.PanelBody;
	var Button = components.Button;
	var MediaUpload = blockEditor.MediaUpload;
	var MediaUploadCheck = blockEditor.MediaUploadCheck;

	var defaults = {
		'home-hero': {
			eyebrow: 'Приготовлено с любовью',
			title: 'Натуральное питание для собак',
			title_accent: 'без лишних забот',
			text: 'Готовые свежие рационы, рассчитанные <br> под потребности вашего питомца',
			button_label: 'Выбрать рацион',
			button_url: '/shop/',
		},
		'home-conveniences': {
			title: 'Почему это удобно для Вас',
			cards: [
				{ icon: 'imgs/icons/conveniences__icon.svg', title: 'Экономит ваше <br> время', text: 'Доставка до двери. Без закупок, готовки и мытья посуды после кормления' },
				{ icon: 'imgs/icons/conveniences__icon2.svg', title: 'Сбалансированный рацион', text: 'Учитываем породу, вес и возраст. Все необходимые питательные вещества уже в каждой порции' },
				{ icon: 'imgs/icons/conveniences__icon3.svg', title: 'Подача <br> как в ресторане', text: 'Аккуратные порции и понятный состав. Еда выглядит эстетично и имеет приятный вкус и аромат' },
				{ icon: 'imgs/icons/conveniences__icon4.svg', title: 'Заботимся <br> о природе', text: 'Используем экологичный <br> подход к изготовлению <br> упаковки' },
			],
		},
		'home-delivery': {
			title: 'Регулярные доставки рациона',
			subtitle: 'без повторных заказов',
			text_first: 'Оформите подписку на питание <strong>на 1, 3 или 6 месяцев.</strong> Мы готовим и привозим питание по графику — вам не нужно оформлять заказ каждый раз.',
			text_second: 'Подписку можно оформить при выборе рациона, указав нужный период',
			button_label: 'В магазин',
			button_url: '/shop/',
		},
		'home-works': {
			title: 'Как это работает',
			subtitle: 'Всего несколько шагов — и питание уже у вас дома',
			link_label: 'Подробнее о доставке',
			link_url: '/delivery/',
			steps: [
				{ title: 'Выбираете рацион', text: 'В онлайн-магазине или с помощью нашего консультанта — с учётом породы, веса, возраста и особенностей собаки', image: 'imgs/bg/works__block-img1.svg', color: '' },
				{ title: 'Мы готовим заказ', text: 'После оформления и оплаты заказа готовим выбранные рационы', image: 'imgs/bg/works__block-img2.svg', color: '#EFF1EB' },
				{ title: 'Доставляем к двери', text: 'Свежие рационы приезжают к вам домой в течение 2-х <br> дней после заказа', image: 'imgs/bg/works__block-img3.svg', color: '#EEF5FF' },
				{ title: 'Вам остаётся только покормить собаку', text: 'Без расчётов рационов, закупок продуктов и готовки — всё уже продумано за Вас', image: 'imgs/bg/works__block-img4.svg', color: '#FAF4FF' },
			],
		},
		'home-about-food': {
			title: 'Что получает ваша собака',
			text: 'Мы рассчитываем питание с учётом потребностей собаки и используем безопасную технологию приготовления. Вы получаете сбалансированные рационы из свежих ингредиентов — без лишних рисков и сомнений.',
			link_label: 'Подробнее',
			link_url: '#',
			items: [
				{ icon: 'imgs/icons/about-food-icon1.svg', title: 'Белки', text: 'Строительный материал для клеток, тканей и органов' },
				{ icon: 'imgs/icons/about-food-icon2.svg', title: 'Минералы', text: 'Необходимы для костей, <br> мышц и работы нервной <br> системы' },
				{ icon: 'imgs/icons/about-food-icon3.svg', title: 'Витамины', text: 'Участвуют в обмене веществ <br> и поддерживают иммунитет' },
				{ icon: 'imgs/icons/about-food-icon4.svg', title: 'Углеводы', text: 'Обеспечивают энергией на каждый день' },
				{ icon: 'imgs/icons/about-food-icon5.svg', title: 'Жирные кислоты', text: 'Поддерживают кожу, шерсть и нормальную работу организма' },
				{ icon: 'imgs/icons/about-food-icon6.svg', title: 'Клетчатка', text: 'Поддерживает пищеварение и здоровье кишечника' },
			],
		},
		'home-plan': {
			person_name: 'Босунова Наталья',
			person_role: 'Главный ветеринар-диетолог <br> компании',
			title: 'Составим индивидуальный план питания',
			subtitle: 'для вашего питомца',
			price: 'Стоимость: от 1 500 ₽ (в зависимости от выбранной консультации)',
			text: 'Для щенков, беременных/кормящих собак, для питомцев с избыточной/недостаточной массой тела, для питомцев с заболеванием (ЖКТ заболевания, болезнь почек, мочекаменная болезнь, пищевая аллергия и т.д).',
			button_label: 'начать',
		},
		'dietology': {
			hero_title: 'Правильное питание',
			hero_accent: '- основа здоровья собаки',
			hero_text: 'Подберем и приготовим рацион с учётом возраста, породы и состояния здоровья вашего питомца',
			hero_button_label: 'получить консультацию',
			hero_mobile_label: 'Выбрать рацион',
			consult_title: 'Вам нужна консультация если у Вас:',
			consult_items: [
				{ icon: 'imgs/bg/consultation__img1.svg', text: 'Щенок' },
				{ icon: 'imgs/bg/consultation__img2.svg', text: 'Беременная или лактирующая собака' },
				{ icon: 'imgs/bg/consultation__img3.svg', text: 'Питомец с лишним или недостаточным весом' },
				{ icon: 'imgs/bg/consultation__img4.svg', text: 'У собаки есть заболевания' },
				{ icon: 'imgs/bg/consultation__img5.svg', icon_mobile: 'imgs/bg/consultation__img7.svg', text: 'Собака с пищевой аллергия или непереносимостью' },
				{ icon: 'imgs/bg/consultation__img6.svg', text: 'Ваш хвостик привередлив в еде' },
			],
			plan_person_name: 'Босунова Наталья',
			plan_person_role: 'Главный ветеринар-диетолог <br> компании',
			plan_person_image: 'imgs/bg/plan__img2.png',
			plan_title: 'Составление рациона питания',
			plan_subtitle: 'ветеринарным врачом-диетологом',
			plan_text: 'Поможем разобраться в рационе и подобрать питание с учётом особенностей собаки. Рекомендации подходят для ежедневного кормления и легко применяются на практике',
			plan_link_label: 'Смотреть все сертификаты',
			plan_certificates: [
				{ image: 'imgs/bg/plan__img1.png' },
				{ image: 'imgs/bg/plan__img3.png' },
			],
			advisory_title: 'Как проходит консультация',
			advisory_steps: [
				{ title: 'Заполняете заявку и оплачиваете консультацию', text: 'Оставляете контактные данные, <br> чтобы мы могли связаться с вами', button: 'Получить консультацию' },
				{ title: 'Заполняете анкету о вашей собаке', text: 'После оплаты вы получаете на почту короткую анкету (3-5 минут). После её заполнения мы свяжемся с вами и согласуем время онлайн-консультации с диетологом', icon: 'imgs/icons/advisory__icon.svg' },
				{ title: 'Диетолог проводит консультацию', text: 'Изучаем особенности вашей собаки, отвечаем на вопросы и уточняетм все особенности питания собаки', icon: 'imgs/icons/advisory__icon2.svg' },
				{ title: 'Мы составляем рацион', text: 'Составляем подходящее меню по результатам консультации', icon: 'imgs/icons/advisory__icon3.svg' },
				{ title: 'Передаём план питания', text: 'и при необходимости оформляем доставку', icon: 'imgs/icons/advisory__icon4.svg' },
			],
			advantages_title: 'Что вы получите после <br> консультации',
			advantages: [
				{ image: 'imgs/bg/advantages__img1.png', title: 'Понятный <br> план питания' },
				{ image: 'imgs/bg/advantages__img.png', title: 'Подходящий <br> рацион' },
				{ image: 'imgs/bg/advantages__img3.svg', title: 'Рекомендации <br> по кормлению' },
				{ image: 'imgs/bg/advantages__img4.png', title: 'Уверенность <br> в выборе питания' },
			],
			price_title: 'Стоимость консультаций',
			prices: [
				{ title: 'Консультация ветеринарного врача диетолога/гастроэнтеролога', text: 'При заказе рациона стоимость консультации возвращается при оплате, без заказа рациона стоимость 1500 руб.', items: [ 'Ответы на вопросы', 'Разбор анализов и дополнительных исследований', 'Рекомендации по лечению' ], button: 'Заказать консультацию и подобрать рацион' },
				{ title: 'Подбор рациона для здорового питомца', text: 'При заказе рациона стоимость консультации возвращается при оплате, без заказа рациона стоимость 3000 руб.', items: [ 'Составление индивидуального рациона питания', 'Ответы на вопросы по рациону', 'Рекомендации по лечению' ], button: 'Заказать консультацию и подобрать рацион' },
				{ title: 'Подбор рациона для питомца с заболеванием', text: 'При заказе рациона стоимость консультации возвращается при оплате, без заказа рациона стоимость 3500 руб.', items: [ 'Индивидуальное составление рациона питания при заболевании', 'Ответы на вопросы по рациону', 'Рекомендации по кормлению' ], button: 'Заказать консультацию и подобрать рацион' },
				{ title: 'Ведение', text: 'При заказе рациона стоимость консультации возвращается при оплате, без заказа рациона стоимость 2500 руб.', items: [ 'Необходимо для питомцев с заболеваниями, чтобы контролировать состояние питомца и по необходимости корректировать лечение', 'Ответы на вопросы по рациону', 'Рекомендации по кормлению' ], button: 'Заказать консультацию и подобрать рацион' },
			],
			faq_title: 'часто задаваемые вопросы',
			faq_items: [
				{ question: 'Что входит в консультацию?', answer: '' },
				{ question: 'Кто проводит консультацию?', answer: '' },
				{ question: 'Консультация проходит онлайн или офлайн?', answer: '' },
				{ question: 'Можно задать любые вопросы по питанию?', answer: '' },
				{ question: 'Вы подбираете рацион под мою собаку?', answer: '' },
				{ question: 'Можно ли перейти с сухого корма?', answer: '' },
				{ question: 'Это питание на каждый день?', answer: '' },
				{ question: 'Можно кормить данными рационами если у моей собаки пищевая аллергия или чувствительное пищеварение?', answer: '' },
				{ question: 'Подойдет ли рацион моему питомцу?', answer: '' },
			],
		},
		'about': {
			hero_title: 'Заботимся <br class="xs-show"> о питании <br> <span>вашей собаки</span>',
			hero_image: 'imgs/bg/about-banner___img.png',
			nutrition_title: 'Почему мы это делаем ?',
			nutrition_text: 'Подобрать правильное питание для собаки — не так просто. <br> Не хватает времени, сложно разобраться в составе и нет уверенности, что рацион подходит. <br> Мы создали подход, где всё уже продумано — остаётся только кормить собаку',
			nutrition_items: [
				{ icon: 'imgs/icons/nutrition-item1.svg', icon_class: 'nutrition-icon', icon_second: 'imgs/icons/nutrition-item4.svg', icon_second_class: 'nutrition-icon2', text: 'Опираемся на исследования <br> по питанию собак' },
				{ icon: 'imgs/icons/nutrition-item2.svg', icon_class: 'nutrition-icon3', text: 'Учитываем вес, возраст и особенности' },
				{ icon: 'imgs/icons/nutrition-item3.svg', icon_class: 'nutrition-icon4', text: 'Рационы проходят <br> термическую обработку' },
				{ text: 'Подбираем рацион по составу <br> и калорийности для каждой породы <br> собаки индивидуально' },
			],
			acquaintances_title: 'Давай знакомиться?',
			acquaintances_lead: 'Кожаные называют мою породу Акита-ину, а мне больше нравится когда меня зовут по моей кличке — Дайси',
			acquaintances_paragraphs: [
				'Вообще я парень простой: люблю гулять, играть и, конечно, поесть. Особенно то, что ест мой хозяин. У него всегда самое вкусное, но делится он редко — говорит, мне вредно. Ну да, конечно.',
				'Я намекал. Сначала взглядом. Потом просто сидел рядом. Потом очень долго смотрел. И это сработало. Мой хозяин задумался и сделал сервис правильного питания. И назвал его в мою честь — Дайси.',
				'Теперь вкусно питаться смогу не только я, но и другие хвостатые с нашего двора… и даже всего города. Так что да — это я всё придумал. Ну, почти.',
			],
			acquaintances_image: 'imgs/bg/acquaintances__img.png',
			team_title: 'Кто работает над рационами',
			team_items: [
				{ image: 'imgs/bg/job__img1.png', name: 'Лукьянов Валентин', text: 'Мой хозяин. Главный по идеям, коробкам и доставке' },
				{ image: 'imgs/bg/job__img2.png', name: 'Босунова Наталья', text: 'Ветеринарный врач-диетолог. Следит, чтобы мне было вкусно, а не «просто можно»' },
			],
			choice_title: 'Почему выбирают наши рационы',
			choice_items: [
				{ icon: 'imgs/icons/conveniences2-icon1.svg', title: 'Натуральные <br> ингредиенты', text: 'Полностью натуральные <br> продукты высокого качества' },
				{ icon: 'imgs/icons/conveniences2-icon2.svg', title: 'Сбалансированный состав', text: 'Мы используем добавки, благодаря чему собака получит все необходимые витамины и минералы' },
				{ icon: 'imgs/icons/conveniences2-icon3.svg', title: 'Приятный вкус даже для приверед', text: 'Рационы имеет приятный вкус и аромат, привлекающий даже привередливых животных' },
				{ icon: 'imgs/icons/conveniences2-icon4.svg', title: 'Безопасная обработка продуктов', text: 'Тщательная обработка продуктов гарантирует безопасность и минимизирует риск инфекций' },
			],
			nature_image: 'imgs/bg/nature__img.png',
			nature_title: 'Заботимся о природе',
			nature_paragraphs: [
				'Мы не только готовим питание, но и думаем о том, как снизить влияние на окружающую среду.',
				'Мы используем качественные продукты и выстраиваем процессы так, чтобы минимизировать отходы на всех этапах — от приготовления до доставки. Упаковка изготавливается из экологичных материалов, а логистика выстроена с учётом снижения лишних перемещений.',
			],
			partnership_title: 'Открыты к партнёрству',
			partnership_subtitle: 'и совместным проектам',
			partnership_text: 'Готовы рассмотреть разные форматы сотрудничества — от работы с питомниками и ветеринарными специалистами до партнёрств с блогерами и сервисами для владельцев собак',
			partnership_button_label: 'Узнать подробнее',
			partnership_image: 'imgs/bg/partnership-img.png',
		},
		'shipping': {
			title: 'Бесплатная доставка',
			tabs: [
				{ id: 'moscow', title: 'Москва', label: 'Введите адрес', placeholder: 'Улица, дом, корп', items: [ 'Бесплатная доставка по Москве в пределах оранжевой зоны', 'График доставки: ежедневно', 'Интервал доставки: с 6-00 до 11-00 утром' ] },
				{ id: 'spb', title: 'Санкт-Петербург', label: 'Введите адрес', placeholder: 'Улица, дом, корп', items: [ 'Бесплатная доставка по Санкт-Петербургу в пределах оранжевой зоны', 'График доставки: ежедневно', 'Интервал доставки: с 6-00 до 11-00 утром' ] },
			],
		},
		'sale': {
			title: 'скидка — 30% на первый заказ',
			subtitle: 'начните кормить своего <br> питомца по-новому',
			text: '<span>Для новых клиентов</span> <br> Скидка -30% на первый заказ по промокоду <strong>СТАРТ</strong>',
			button_label: 'Выбрать рацион',
			button_url: '/shop/',
		},
		'why': {
			title: 'Остались вопросы <br> по питанию?',
			text: 'Оставьте контакты — поможем <br> подобрать рацион и всё объясним',
			button_label: 'связаться',
		},
		'home-questions': {
			title: 'часто задаваемые вопросы',
			tabs: [
				{ title: 'Питание и состав', items: [] },
				{ title: 'Доставка и хранение', items: [] },
				{ title: 'Для владельцев', items: [] },
				{ title: 'Заказ и оплата', items: [] },
			],
		},
	};

	var defaultAnswer = 'Да, рацион подбирается индивидуально с учётом породы, возраста, веса, уровня активности и особенностей здоровья вашей собаки. Мы учитываем пищевые предпочтения, чувствительное пищеварение, аллергии и другие важные нюансы, чтобы питание было комфортным и полезным именно для вашего питомца.';
	var defaultQuestions = [
		'Что входит в рацион?',
		'Подойдёт ли это моей собаке?',
		'Можно ли при аллергии или чувствительном пищеварении?',
		'Это полностью заменяет сухой корм?',
		'Как перейти с сухого корма на натуральное питание?',
	];

	defaults.dietology.faq_items = defaults.dietology.faq_items.map( function ( item ) {
		item.answer = item.answer || defaultAnswer;
		return item;
	} );

	defaults['home-questions'].tabs = defaults['home-questions'].tabs.map( function ( tab ) {
		tab.items = defaultQuestions.map( function ( question ) {
			return { question: question, answer: defaultAnswer };
		} );
		return tab;
	} );

	function clone( value ) {
		return JSON.parse( JSON.stringify( value ) );
	}

	function val( attrs, block, key ) {
		return attrs[ key ] !== undefined && attrs[ key ] !== null && attrs[ key ] !== '' ? attrs[ key ] : defaults[ block ][ key ];
	}

	function arr( attrs, block, key ) {
		return attrs[ key ] && attrs[ key ].length ? clone( attrs[ key ] ) : clone( defaults[ block ][ key ] );
	}

	function isFirstDiceyBlock( props ) {
		var fallback = props && 'dicey/home-hero' === props.name;

		if ( ! props || ! props.clientId || ! data || ! data.select ) {
			return fallback;
		}

		var blockEditor = data.select( 'core/block-editor' );
		var pageBlocks = blockEditor && blockEditor.getBlocks ? blockEditor.getBlocks() : [];

		for ( var index = 0; index < pageBlocks.length; index++ ) {
			if ( pageBlocks[ index ].name && 0 === pageBlocks[ index ].name.indexOf( 'dicey/' ) ) {
				return pageBlocks[ index ].clientId === props.clientId;
			}
		}

		return fallback;
	}

	function box( title, children, showNote, initialOpen ) {
		return el(
			'div',
			{
				className: 'dicey-editor-fields',
				style: {
					border: '1px solid #ccd0d4',
					background: '#fff',
					marginBottom: '12px',
					borderRadius: '4px',
					overflow: 'hidden',
				},
			},
			el(
				PanelBody,
				{
					title: title,
					initialOpen: !! initialOpen,
					className: 'dicey-editor-section',
				},
				el(
					'div',
					{ style: { padding: '4px 0 8px' } },
					showNote ? previewNote() : null,
					children
				)
			)
		);
	}

	function previewNote() {
		return el(
			'p',
			{ style: { margin: '0 0 12px', color: '#646970' } },
			__( 'Сохраните/обновите страницу, чтобы увидеть изменения на сайте.', 'dicey' )
		);
	}

	function plainText( value ) {
		return String( value || '' ).replace( /<[^>]*>/g, ' ' ).replace( /\s+/g, ' ' ).trim();
	}

	function panelTitle( prefix, index, value ) {
		var text = plainText( value );
		return prefix + ' ' + ( index + 1 ) + ( text ? ': ' + text : '' );
	}

	function panel( title, children, initialOpen ) {
		return el(
			PanelBody,
			{
				title: title,
				initialOpen: !! initialOpen,
				className: 'dicey-editor-panel',
			},
			el( 'div', { style: { paddingTop: '8px' } }, children )
		);
	}

	function imageSrc( path ) {
		if ( ! path ) {
			return '';
		}

		if ( 0 === path.indexOf( 'http://' ) || 0 === path.indexOf( 'https://' ) ) {
			return path;
		}

		return ( window.diceyBlocks && window.diceyBlocks.assetsUrl ? window.diceyBlocks.assetsUrl : '' ) + '/' + path.replace( /^\/+/, '' );
	}

	function imageControl( label, value, onChange ) {
		var preview = imageSrc( value );

		return el( 'div', { style: { marginBottom: '16px' } }, [
			el( 'p', { style: { margin: '0 0 8px', color: '#1d2327', fontWeight: 500 } }, label ),
			preview ? el( 'img', {
				src: preview,
				alt: '',
				style: {
					display: 'block',
					width: '120px',
					height: '90px',
					objectFit: 'contain',
					marginBottom: '10px',
					background: '#f6f7f7',
					border: '1px solid #dcdcde',
					borderRadius: '4px',
				},
			} ) : null,
			el( MediaUploadCheck, null,
				el( MediaUpload, {
					onSelect: function ( media ) {
						onChange( media && media.url ? media.url : '' );
					},
					allowedTypes: [ 'image' ],
					value: value,
					render: function ( mediaProps ) {
						return el( 'div', { style: { display: 'flex', gap: '8px', flexWrap: 'wrap' } }, [
							el( Button, {
								variant: 'secondary',
								onClick: mediaProps.open,
							}, value ? 'Заменить изображение' : 'Выбрать изображение' ),
							value ? el( Button, {
								variant: 'link',
								isDestructive: true,
								onClick: function () { onChange( '' ); },
							}, 'Очистить' ) : null,
						] );
					},
				} )
			),
		] );
	}

	function setArrayItem( source, setAttributes, attrName, index, key, value ) {
		var next = clone( source );
		next[ index ][ key ] = value;
		setAttributes( ( function () {
			var attrs = {};
			attrs[ attrName ] = next;
			return attrs;
		} )() );
	}

	function setNestedArrayItem( source, setAttributes, attrName, index, nestedName, nestedIndex, value ) {
		var next = clone( source );
		next[ index ][ nestedName ][ nestedIndex ] = value;
		setAttributes( ( function () {
			var attrs = {};
			attrs[ attrName ] = next;
			return attrs;
		} )() );
	}

	function heroEdit( props ) {
		var attrs = props.attributes;
		var setAttributes = props.setAttributes;

		return box( 'Главный экран', [
			panel( 'Тексты', [
				el( TextControl, {
					label: 'Надзаголовок',
					value: val( attrs, 'home-hero', 'eyebrow' ),
					onChange: function ( value ) { setAttributes( { eyebrow: value } ); },
				} ),
				el( TextControl, {
					label: 'Заголовок',
					value: val( attrs, 'home-hero', 'title' ),
					onChange: function ( value ) { setAttributes( { title: value } ); },
				} ),
				el( TextControl, {
					label: 'Выделенная строка заголовка',
					value: val( attrs, 'home-hero', 'title_accent' ),
					onChange: function ( value ) { setAttributes( { title_accent: value } ); },
				} ),
				el( TextareaControl, {
					label: 'Описание',
					value: val( attrs, 'home-hero', 'text' ),
					onChange: function ( value ) { setAttributes( { text: value } ); },
				} ),
			], true ),
			panel( 'Кнопка', [
				el( TextControl, {
					label: 'Текст кнопки',
					value: val( attrs, 'home-hero', 'button_label' ),
					onChange: function ( value ) { setAttributes( { button_label: value } ); },
				} ),
				el( TextControl, {
					label: 'Ссылка кнопки',
					value: val( attrs, 'home-hero', 'button_url' ),
					onChange: function ( value ) { setAttributes( { button_url: value } ); },
				} ),
			], false ),
		], true, isFirstDiceyBlock( props ) );
	}

	function conveniencesEdit( props ) {
		var attrs = props.attributes;
		var setAttributes = props.setAttributes;
		var cards = arr( attrs, 'home-conveniences', 'cards' );

		function setCard( index, key, value ) {
			var next = clone( cards );
			next[ index ][ key ] = value;
			setAttributes( { cards: next } );
		}

		return box( 'Почему удобно для вас', [
			el( TextControl, {
				label: 'Заголовок',
				value: val( attrs, 'home-conveniences', 'title' ),
				onChange: function ( value ) { setAttributes( { title: value } ); },
			} ),
			cards.map( function ( card, index ) {
				return panel( panelTitle( 'Карточка', index, card.title ), [
					el( TextControl, {
						label: 'Заголовок карточки',
						value: card.title,
						onChange: function ( value ) { setCard( index, 'title', value ); },
					} ),
					el( TextareaControl, {
						label: 'Текст карточки',
						value: card.text,
						onChange: function ( value ) { setCard( index, 'text', value ); },
					} ),
				], 0 === index );
			} ),
		], true, isFirstDiceyBlock( props ) );
	}

	function deliveryEdit( props ) {
		var attrs = props.attributes;
		var setAttributes = props.setAttributes;
		return box( 'Регулярные доставки рациона', [
			panel( 'Заголовки', [
				el( TextControl, {
					label: 'Заголовок',
					value: val( attrs, 'home-delivery', 'title' ),
					onChange: function ( value ) { setAttributes( { title: value } ); },
				} ),
				el( TextControl, {
					label: 'Подзаголовок',
					value: val( attrs, 'home-delivery', 'subtitle' ),
					onChange: function ( value ) { setAttributes( { subtitle: value } ); },
				} ),
			], true ),
			panel( 'Текст', [
				el( TextareaControl, {
					label: 'Первый абзац',
					value: val( attrs, 'home-delivery', 'text_first' ),
					onChange: function ( value ) { setAttributes( { text_first: value } ); },
				} ),
				el( TextareaControl, {
					label: 'Второй абзац',
					value: val( attrs, 'home-delivery', 'text_second' ),
					onChange: function ( value ) { setAttributes( { text_second: value } ); },
				} ),
			], false ),
			panel( 'Кнопка', [
				el( TextControl, {
					label: 'Текст кнопки',
					value: val( attrs, 'home-delivery', 'button_label' ),
					onChange: function ( value ) { setAttributes( { button_label: value } ); },
				} ),
				el( TextControl, {
					label: 'Ссылка кнопки',
					value: val( attrs, 'home-delivery', 'button_url' ),
					onChange: function ( value ) { setAttributes( { button_url: value } ); },
				} ),
			], false ),
		], true, isFirstDiceyBlock( props ) );
	}

	function worksEdit( props ) {
		var attrs = props.attributes;
		var setAttributes = props.setAttributes;
		var steps = arr( attrs, 'home-works', 'steps' );

		function setStep( index, key, value ) {
			var next = clone( steps );
			next[ index ][ key ] = value;
			setAttributes( { steps: next } );
		}

		return box( 'Как это работает', [
			el( TextControl, {
				label: 'Заголовок',
				value: val( attrs, 'home-works', 'title' ),
				onChange: function ( value ) { setAttributes( { title: value } ); },
			} ),
			el( TextareaControl, {
				label: 'Подзаголовок',
				value: val( attrs, 'home-works', 'subtitle' ),
				onChange: function ( value ) { setAttributes( { subtitle: value } ); },
			} ),
			el( TextControl, {
				label: 'Текст ссылки',
				value: val( attrs, 'home-works', 'link_label' ),
				onChange: function ( value ) { setAttributes( { link_label: value } ); },
			} ),
			el( TextControl, {
				label: 'URL ссылки',
				value: val( attrs, 'home-works', 'link_url' ),
				onChange: function ( value ) { setAttributes( { link_url: value } ); },
			} ),
			steps.map( function ( step, index ) {
				return panel( panelTitle( 'Шаг', index, step.title ), [
					el( TextControl, {
						label: 'Заголовок шага',
						value: step.title,
						onChange: function ( value ) { setStep( index, 'title', value ); },
					} ),
					el( TextareaControl, {
						label: 'Текст шага',
						value: step.text,
						onChange: function ( value ) { setStep( index, 'text', value ); },
					} ),
				], 0 === index );
			} ),
		], true, isFirstDiceyBlock( props ) );
	}

	function aboutFoodEdit( props ) {
		var attrs = props.attributes;
		var setAttributes = props.setAttributes;
		var items = arr( attrs, 'home-about-food', 'items' );

		function setItemField( index, key, value ) {
			setArrayItem( items, setAttributes, 'items', index, key, value );
		}

		return box( 'Что получает ваша собака', [
			panel( 'Заголовок и ссылка', [
				el( TextControl, {
					label: 'Заголовок',
					value: val( attrs, 'home-about-food', 'title' ),
					onChange: function ( value ) { setAttributes( { title: value } ); },
				} ),
				el( TextareaControl, {
					label: 'Описание',
					value: val( attrs, 'home-about-food', 'text' ),
					onChange: function ( value ) { setAttributes( { text: value } ); },
				} ),
				el( TextControl, {
					label: 'Текст ссылки',
					value: val( attrs, 'home-about-food', 'link_label' ),
					onChange: function ( value ) { setAttributes( { link_label: value } ); },
				} ),
				el( TextControl, {
					label: 'URL ссылки',
					value: val( attrs, 'home-about-food', 'link_url' ),
					onChange: function ( value ) { setAttributes( { link_url: value } ); },
				} ),
			], true ),
			items.map( function ( item, index ) {
				return panel( panelTitle( 'Элемент', index, item.title ), [
					el( TextControl, {
						label: 'Название',
						value: item.title,
						onChange: function ( value ) { setItemField( index, 'title', value ); },
					} ),
					el( TextareaControl, {
						label: 'Описание',
						value: item.text,
						onChange: function ( value ) { setItemField( index, 'text', value ); },
					} ),
				], false );
			} ),
		], true, isFirstDiceyBlock( props ) );
	}

	function planEdit( props ) {
		var attrs = props.attributes;
		var setAttributes = props.setAttributes;

		return box( 'Составим индивидуальный план питания', [
			panel( 'Специалист', [
				el( TextControl, {
					label: 'Имя',
					value: val( attrs, 'home-plan', 'person_name' ),
					onChange: function ( value ) { setAttributes( { person_name: value } ); },
				} ),
				el( TextareaControl, {
					label: 'Должность',
					value: val( attrs, 'home-plan', 'person_role' ),
					onChange: function ( value ) { setAttributes( { person_role: value } ); },
				} ),
			], true ),
			panel( 'Тексты', [
				el( TextControl, {
					label: 'Заголовок',
					value: val( attrs, 'home-plan', 'title' ),
					onChange: function ( value ) { setAttributes( { title: value } ); },
				} ),
				el( TextControl, {
					label: 'Подзаголовок',
					value: val( attrs, 'home-plan', 'subtitle' ),
					onChange: function ( value ) { setAttributes( { subtitle: value } ); },
				} ),
				el( TextareaControl, {
					label: 'Стоимость',
					value: val( attrs, 'home-plan', 'price' ),
					onChange: function ( value ) { setAttributes( { price: value } ); },
				} ),
				el( TextareaControl, {
					label: 'Описание',
					value: val( attrs, 'home-plan', 'text' ),
					onChange: function ( value ) { setAttributes( { text: value } ); },
				} ),
				el( TextControl, {
					label: 'Текст кнопки',
					value: val( attrs, 'home-plan', 'button_label' ),
					onChange: function ( value ) { setAttributes( { button_label: value } ); },
				} ),
			], false ),
		], true, isFirstDiceyBlock( props ) );
	}

	function dietologyEdit( props ) {
		var attrs = props.attributes;
		var setAttributes = props.setAttributes;
		var consultItems = arr( attrs, 'dietology', 'consult_items' );
		var planCertificates = arr( attrs, 'dietology', 'plan_certificates' );
		var advisorySteps = arr( attrs, 'dietology', 'advisory_steps' );
		var advantages = arr( attrs, 'dietology', 'advantages' );
		var prices = arr( attrs, 'dietology', 'prices' );
		var faqItems = arr( attrs, 'dietology', 'faq_items' );

		function setConsultItem( index, value ) {
			setArrayItem( consultItems, setAttributes, 'consult_items', index, 'text', value );
		}

		function setConsultImage( index, key, value ) {
			setArrayItem( consultItems, setAttributes, 'consult_items', index, key, value );
		}

		function setPlanCertificate( index, value ) {
			setArrayItem( planCertificates, setAttributes, 'plan_certificates', index, 'image', value );
		}

		function setAdvisoryStep( index, key, value ) {
			setArrayItem( advisorySteps, setAttributes, 'advisory_steps', index, key, value );
		}

		function setAdvantage( index, key, value ) {
			setArrayItem( advantages, setAttributes, 'advantages', index, key, value );
		}

		function setPrice( index, key, value ) {
			setArrayItem( prices, setAttributes, 'prices', index, key, value );
		}

		function setPriceItem( index, itemIndex, value ) {
			setNestedArrayItem( prices, setAttributes, 'prices', index, 'items', itemIndex, value );
		}

		function setFaq( index, key, value ) {
			setArrayItem( faqItems, setAttributes, 'faq_items', index, key, value );
		}

		return el( element.Fragment, null, [
			box( 'Главный экран', [
				el( TextControl, {
					label: 'Заголовок',
					value: val( attrs, 'dietology', 'hero_title' ),
					onChange: function ( value ) { setAttributes( { hero_title: value } ); },
				} ),
				el( TextControl, {
					label: 'Выделенная часть заголовка',
					value: val( attrs, 'dietology', 'hero_accent' ),
					onChange: function ( value ) { setAttributes( { hero_accent: value } ); },
				} ),
				el( TextareaControl, {
					label: 'Описание',
					value: val( attrs, 'dietology', 'hero_text' ),
					onChange: function ( value ) { setAttributes( { hero_text: value } ); },
				} ),
				el( TextControl, {
					label: 'Текст кнопки',
					value: val( attrs, 'dietology', 'hero_button_label' ),
					onChange: function ( value ) { setAttributes( { hero_button_label: value } ); },
				} ),
				el( TextControl, {
					label: 'Текст кнопки на мобильной версии',
					value: val( attrs, 'dietology', 'hero_mobile_label' ),
					onChange: function ( value ) { setAttributes( { hero_mobile_label: value } ); },
				} ),
			], true, isFirstDiceyBlock( props ) ),
			box( 'Вам нужна консультация если у Вас', [
				el( TextControl, {
					label: 'Заголовок секции',
					value: val( attrs, 'dietology', 'consult_title' ),
					onChange: function ( value ) { setAttributes( { consult_title: value } ); },
				} ),
				consultItems.map( function ( item, index ) {
					return panel( panelTitle( 'Карточка', index, item.text ), [
						imageControl( 'Изображение карточки', item.icon, function ( value ) { setConsultImage( index, 'icon', value ); } ),
						item.icon_mobile ? imageControl( 'Изображение на мобильной версии', item.icon_mobile, function ( value ) { setConsultImage( index, 'icon_mobile', value ); } ) : null,
						el( TextareaControl, {
							label: 'Текст карточки',
							value: item.text,
							onChange: function ( value ) { setConsultItem( index, value ); },
						} ),
					], false );
				} ),
			], false ),
			box( 'Составление рациона питания', [
				imageControl( 'Фото Натальи', val( attrs, 'dietology', 'plan_person_image' ), function ( value ) { setAttributes( { plan_person_image: value } ); } ),
				el( TextControl, {
					label: 'Имя специалиста',
					value: val( attrs, 'dietology', 'plan_person_name' ),
					onChange: function ( value ) { setAttributes( { plan_person_name: value } ); },
				} ),
				el( TextareaControl, {
					label: 'Должность специалиста',
					value: val( attrs, 'dietology', 'plan_person_role' ),
					onChange: function ( value ) { setAttributes( { plan_person_role: value } ); },
				} ),
				el( TextControl, {
					label: 'Заголовок',
					value: val( attrs, 'dietology', 'plan_title' ),
					onChange: function ( value ) { setAttributes( { plan_title: value } ); },
				} ),
				el( TextControl, {
					label: 'Подзаголовок',
					value: val( attrs, 'dietology', 'plan_subtitle' ),
					onChange: function ( value ) { setAttributes( { plan_subtitle: value } ); },
				} ),
				el( TextareaControl, {
					label: 'Описание',
					value: val( attrs, 'dietology', 'plan_text' ),
					onChange: function ( value ) { setAttributes( { plan_text: value } ); },
				} ),
				el( TextControl, {
					label: 'Текст ссылки на сертификаты',
					value: val( attrs, 'dietology', 'plan_link_label' ),
					onChange: function ( value ) { setAttributes( { plan_link_label: value } ); },
				} ),
				planCertificates.map( function ( certificate, index ) {
					return imageControl( 'Сертификат ' + ( index + 1 ), certificate.image, function ( value ) { setPlanCertificate( index, value ); } );
				} ),
			], false ),
			box( 'Как проходит консультация', [
				el( TextControl, {
					label: 'Заголовок секции',
					value: val( attrs, 'dietology', 'advisory_title' ),
					onChange: function ( value ) { setAttributes( { advisory_title: value } ); },
				} ),
				advisorySteps.map( function ( step, index ) {
					return panel( panelTitle( 'Шаг', index, step.title ), [
						el( TextControl, {
							label: 'Заголовок шага',
							value: step.title,
							onChange: function ( value ) { setAdvisoryStep( index, 'title', value ); },
						} ),
						el( TextareaControl, {
							label: 'Текст шага',
							value: step.text,
							onChange: function ( value ) { setAdvisoryStep( index, 'text', value ); },
						} ),
						el( TextControl, {
							label: 'Текст кнопки',
							value: step.button || '',
							onChange: function ( value ) { setAdvisoryStep( index, 'button', value ); },
						} ),
					], false );
				} ),
			], false ),
			box( 'Что вы получите после консультации', [
				el( TextareaControl, {
					label: 'Заголовок секции',
					value: val( attrs, 'dietology', 'advantages_title' ),
					onChange: function ( value ) { setAttributes( { advantages_title: value } ); },
				} ),
				advantages.map( function ( item, index ) {
					return panel( panelTitle( 'Пункт', index, item.title ), [
						imageControl( 'Изображение пункта', item.image, function ( value ) { setAdvantage( index, 'image', value ); } ),
						el( TextareaControl, {
							label: 'Текст пункта',
							value: item.title,
							onChange: function ( value ) { setAdvantage( index, 'title', value ); },
						} ),
					], false );
				} ),
			], false ),
			box( 'Стоимость консультаций', [
				el( TextControl, {
					label: 'Заголовок секции',
					value: val( attrs, 'dietology', 'price_title' ),
					onChange: function ( value ) { setAttributes( { price_title: value } ); },
				} ),
				prices.map( function ( price, index ) {
					return panel( panelTitle( 'Карточка', index, price.title ), [
						el( TextControl, {
							label: 'Название консультации',
							value: price.title,
							onChange: function ( value ) { setPrice( index, 'title', value ); },
						} ),
						el( TextareaControl, {
							label: 'Описание',
							value: price.text,
							onChange: function ( value ) { setPrice( index, 'text', value ); },
						} ),
						price.items.map( function ( item, itemIndex ) {
							return el( TextareaControl, {
								label: 'Пункт ' + ( itemIndex + 1 ),
								value: item,
								onChange: function ( value ) { setPriceItem( index, itemIndex, value ); },
							} );
						} ),
						el( TextControl, {
							label: 'Текст кнопки',
							value: price.button,
							onChange: function ( value ) { setPrice( index, 'button', value ); },
						} ),
					], false );
				} ),
			], false ),
			box( 'Часто задаваемые вопросы', [
				el( TextControl, {
					label: 'Заголовок секции',
					value: val( attrs, 'dietology', 'faq_title' ),
					onChange: function ( value ) { setAttributes( { faq_title: value } ); },
				} ),
				faqItems.map( function ( item, index ) {
					return panel( panelTitle( 'Вопрос', index, item.question ), [
						el( TextControl, {
							label: 'Вопрос',
							value: item.question,
							onChange: function ( value ) { setFaq( index, 'question', value ); },
						} ),
						el( TextareaControl, {
							label: 'Ответ',
							value: item.answer,
							onChange: function ( value ) { setFaq( index, 'answer', value ); },
						} ),
					], false );
				} ),
			], false ),
		] );
	}

	function aboutEdit( props ) {
		var attrs = props.attributes;
		var setAttributes = props.setAttributes;
		var nutritionItems = arr( attrs, 'about', 'nutrition_items' );
		var acquaintancesParagraphs = arr( attrs, 'about', 'acquaintances_paragraphs' );
		var teamItems = arr( attrs, 'about', 'team_items' );
		var choiceItems = arr( attrs, 'about', 'choice_items' );
		var natureParagraphs = arr( attrs, 'about', 'nature_paragraphs' );

		function setNutritionItem( index, key, value ) {
			setArrayItem( nutritionItems, setAttributes, 'nutrition_items', index, key, value );
		}

		function setParagraph( source, attrName, index, value ) {
			var next = clone( source );
			next[ index ] = value;
			setAttributes( ( function () {
				var nextAttrs = {};
				nextAttrs[ attrName ] = next;
				return nextAttrs;
			} )() );
		}

		function setTeamItem( index, key, value ) {
			setArrayItem( teamItems, setAttributes, 'team_items', index, key, value );
		}

		function setChoiceItem( index, key, value ) {
			setArrayItem( choiceItems, setAttributes, 'choice_items', index, key, value );
		}

		return el( element.Fragment, null, [
			box( 'Главный экран', [
				imageControl( 'Изображение', val( attrs, 'about', 'hero_image' ), function ( value ) { setAttributes( { hero_image: value } ); } ),
				el( TextareaControl, {
					label: 'Заголовок',
					value: val( attrs, 'about', 'hero_title' ),
					onChange: function ( value ) { setAttributes( { hero_title: value } ); },
				} ),
			], true, isFirstDiceyBlock( props ) ),
			box( 'Почему мы это делаем', [
				el( TextControl, {
					label: 'Заголовок секции',
					value: val( attrs, 'about', 'nutrition_title' ),
					onChange: function ( value ) { setAttributes( { nutrition_title: value } ); },
				} ),
				el( TextareaControl, {
					label: 'Описание',
					value: val( attrs, 'about', 'nutrition_text' ),
					onChange: function ( value ) { setAttributes( { nutrition_text: value } ); },
				} ),
				nutritionItems.map( function ( item, index ) {
					return panel( panelTitle( 'Пункт', index, item.text ), [
						imageControl( 'Иконка', item.icon || '', function ( value ) { setNutritionItem( index, 'icon', value ); } ),
						item.icon_second ? imageControl( 'Дополнительная иконка', item.icon_second, function ( value ) { setNutritionItem( index, 'icon_second', value ); } ) : null,
						el( TextareaControl, {
							label: 'Текст пункта',
							value: item.text,
							onChange: function ( value ) { setNutritionItem( index, 'text', value ); },
						} ),
					], false );
				} ),
			], false ),
			box( 'Давай знакомиться', [
				imageControl( 'Изображение', val( attrs, 'about', 'acquaintances_image' ), function ( value ) { setAttributes( { acquaintances_image: value } ); } ),
				el( TextControl, {
					label: 'Заголовок',
					value: val( attrs, 'about', 'acquaintances_title' ),
					onChange: function ( value ) { setAttributes( { acquaintances_title: value } ); },
				} ),
				el( TextareaControl, {
					label: 'Крупный текст',
					value: val( attrs, 'about', 'acquaintances_lead' ),
					onChange: function ( value ) { setAttributes( { acquaintances_lead: value } ); },
				} ),
				acquaintancesParagraphs.map( function ( paragraph, index ) {
					return el( TextareaControl, {
						label: 'Абзац ' + ( index + 1 ),
						value: paragraph,
						onChange: function ( value ) { setParagraph( acquaintancesParagraphs, 'acquaintances_paragraphs', index, value ); },
					} );
				} ),
			], false ),
			box( 'Кто работает над рационами', [
				el( TextControl, {
					label: 'Заголовок секции',
					value: val( attrs, 'about', 'team_title' ),
					onChange: function ( value ) { setAttributes( { team_title: value } ); },
				} ),
				teamItems.map( function ( item, index ) {
					return panel( panelTitle( 'Сотрудник', index, item.name ), [
						imageControl( 'Фото', item.image, function ( value ) { setTeamItem( index, 'image', value ); } ),
						el( TextControl, {
							label: 'Имя',
							value: item.name,
							onChange: function ( value ) { setTeamItem( index, 'name', value ); },
						} ),
						el( TextareaControl, {
							label: 'Описание',
							value: item.text,
							onChange: function ( value ) { setTeamItem( index, 'text', value ); },
						} ),
					], false );
				} ),
			], false ),
			box( 'Почему выбирают наши рационы', [
				el( TextControl, {
					label: 'Заголовок секции',
					value: val( attrs, 'about', 'choice_title' ),
					onChange: function ( value ) { setAttributes( { choice_title: value } ); },
				} ),
				choiceItems.map( function ( item, index ) {
					return panel( panelTitle( 'Карточка', index, item.title ), [
						imageControl( 'Иконка', item.icon, function ( value ) { setChoiceItem( index, 'icon', value ); } ),
						el( TextareaControl, {
							label: 'Заголовок карточки',
							value: item.title,
							onChange: function ( value ) { setChoiceItem( index, 'title', value ); },
						} ),
						el( TextareaControl, {
							label: 'Текст карточки',
							value: item.text,
							onChange: function ( value ) { setChoiceItem( index, 'text', value ); },
						} ),
					], false );
				} ),
			], false ),
			box( 'Заботимся о природе', [
				imageControl( 'Изображение', val( attrs, 'about', 'nature_image' ), function ( value ) { setAttributes( { nature_image: value } ); } ),
				el( TextControl, {
					label: 'Заголовок',
					value: val( attrs, 'about', 'nature_title' ),
					onChange: function ( value ) { setAttributes( { nature_title: value } ); },
				} ),
				natureParagraphs.map( function ( paragraph, index ) {
					return el( TextareaControl, {
						label: 'Абзац ' + ( index + 1 ),
						value: paragraph,
						onChange: function ( value ) { setParagraph( natureParagraphs, 'nature_paragraphs', index, value ); },
					} );
				} ),
			], false ),
			box( 'Открыты к партнерству', [
				imageControl( 'Изображение', val( attrs, 'about', 'partnership_image' ), function ( value ) { setAttributes( { partnership_image: value } ); } ),
				el( TextControl, {
					label: 'Заголовок',
					value: val( attrs, 'about', 'partnership_title' ),
					onChange: function ( value ) { setAttributes( { partnership_title: value } ); },
				} ),
				el( TextControl, {
					label: 'Подзаголовок',
					value: val( attrs, 'about', 'partnership_subtitle' ),
					onChange: function ( value ) { setAttributes( { partnership_subtitle: value } ); },
				} ),
				el( TextareaControl, {
					label: 'Описание',
					value: val( attrs, 'about', 'partnership_text' ),
					onChange: function ( value ) { setAttributes( { partnership_text: value } ); },
				} ),
				el( TextControl, {
					label: 'Текст кнопки',
					value: val( attrs, 'about', 'partnership_button_label' ),
					onChange: function ( value ) { setAttributes( { partnership_button_label: value } ); },
				} ),
			], false ),
		] );
	}

	function shippingEdit( props ) {
		var attrs = props.attributes;
		var setAttributes = props.setAttributes;
		var tabs = arr( attrs, 'shipping', 'tabs' );

		function setTabField( index, key, value ) {
			setArrayItem( tabs, setAttributes, 'tabs', index, key, value );
		}

		return box( 'Бесплатная доставка', [
			el( TextControl, {
				label: 'Заголовок',
				value: val( attrs, 'shipping', 'title' ),
				onChange: function ( value ) { setAttributes( { title: value } ); },
			} ),
			tabs.map( function ( tab, tabIndex ) {
				return panel( panelTitle( 'Город', tabIndex, tab.title ), [
					el( TextControl, {
						label: 'Название вкладки',
						value: tab.title,
						onChange: function ( value ) { setTabField( tabIndex, 'title', value ); },
					} ),
					el( TextControl, {
						label: 'Подпись поля адреса',
						value: tab.label,
						onChange: function ( value ) { setTabField( tabIndex, 'label', value ); },
					} ),
					el( TextControl, {
						label: 'Подсказка в поле адреса',
						value: tab.placeholder,
						onChange: function ( value ) { setTabField( tabIndex, 'placeholder', value ); },
					} ),
					tab.items.map( function ( item, itemIndex ) {
						return el( TextareaControl, {
							label: 'Пункт ' + ( itemIndex + 1 ),
							value: item,
							onChange: function ( value ) { setNestedArrayItem( tabs, setAttributes, 'tabs', tabIndex, 'items', itemIndex, value ); },
						} );
					} ),
				], 0 === tabIndex );
			} ),
		], true, isFirstDiceyBlock( props ) );
	}

	function saleEdit( props ) {
		var attrs = props.attributes;
		var setAttributes = props.setAttributes;

		return box( 'Скидка - 30% на первый заказ', [
			panel( 'Тексты', [
				el( TextControl, {
					label: 'Заголовок',
					value: val( attrs, 'sale', 'title' ),
					onChange: function ( value ) { setAttributes( { title: value } ); },
				} ),
				el( TextareaControl, {
					label: 'Подзаголовок',
					value: val( attrs, 'sale', 'subtitle' ),
					onChange: function ( value ) { setAttributes( { subtitle: value } ); },
				} ),
				el( TextareaControl, {
					label: 'Текст акции',
					value: val( attrs, 'sale', 'text' ),
					onChange: function ( value ) { setAttributes( { text: value } ); },
				} ),
			], true ),
			panel( 'Кнопка', [
				el( TextControl, {
					label: 'Текст кнопки',
					value: val( attrs, 'sale', 'button_label' ),
					onChange: function ( value ) { setAttributes( { button_label: value } ); },
				} ),
				el( TextControl, {
					label: 'Ссылка кнопки',
					value: val( attrs, 'sale', 'button_url' ),
					onChange: function ( value ) { setAttributes( { button_url: value } ); },
				} ),
			], false ),
		], true, isFirstDiceyBlock( props ) );
	}

	function whyEdit( props ) {
		return box( 'Остались вопросы по питанию?', [
			el( 'p', { style: { margin: '0 0 8px', color: '#1d2327' } }, 'Глобальный блок. Текст, кнопку и изображения нужно менять один раз в разделе админки «Остались вопросы».' ),
			el( 'a', {
				href: window.diceyBlocks && window.diceyBlocks.settingsUrl ? window.diceyBlocks.settingsUrl : '#',
				target: '_blank',
				rel: 'noreferrer',
			}, 'Открыть глобальные настройки' ),
		], true, isFirstDiceyBlock( props ) );
	}

	function questionsEdit( props ) {
		var attrs = props.attributes;
		var setAttributes = props.setAttributes;
		var tabs = arr( attrs, 'home-questions', 'tabs' );

		function setTabTitle( tabIndex, value ) {
			var next = clone( tabs );
			next[ tabIndex ].title = value;
			setAttributes( { tabs: next } );
		}

		function setItem( tabIndex, itemIndex, key, value ) {
			var next = clone( tabs );
			next[ tabIndex ].items[ itemIndex ][ key ] = value;
			setAttributes( { tabs: next } );
		}

		return box( 'Часто задаваемые вопросы', [
			el( TextControl, {
				label: 'Заголовок секции',
				value: val( attrs, 'home-questions', 'title' ),
				onChange: function ( value ) { setAttributes( { title: value } ); },
			} ),
			tabs.map( function ( tab, tabIndex ) {
				return panel( panelTitle( 'Вкладка', tabIndex, tab.title ), [
					el( TextControl, {
						label: 'Вкладка ' + ( tabIndex + 1 ),
						value: tab.title,
						onChange: function ( value ) { setTabTitle( tabIndex, value ); },
					} ),
					tab.items.map( function ( item, itemIndex ) {
						return panel( panelTitle( 'Вопрос', itemIndex, item.question ), [
							el( TextControl, {
								label: 'Вопрос ' + ( itemIndex + 1 ),
								value: item.question,
								onChange: function ( value ) { setItem( tabIndex, itemIndex, 'question', value ); },
							} ),
							el( TextareaControl, {
								label: 'Ответ',
								value: item.answer,
								onChange: function ( value ) { setItem( tabIndex, itemIndex, 'answer', value ); },
							} ),
						], false );
					} ),
				], 0 === tabIndex );
			} ),
		], true, isFirstDiceyBlock( props ) );
	}

	var editable = {
		'dicey/home-hero': {
			title: __( 'Главный экран', 'dicey' ),
			icon: 'cover-image',
			attributes: {
				eyebrow: { type: 'string' },
				title: { type: 'string' },
				title_accent: { type: 'string' },
				text: { type: 'string' },
				button_label: { type: 'string' },
				button_url: { type: 'string' },
			},
			edit: heroEdit,
		},
		'dicey/home-conveniences': {
			title: __( 'Почему это удобно для Вас', 'dicey' ),
			icon: 'grid-view',
			attributes: {
				title: { type: 'string' },
				cards: { type: 'array', default: defaults['home-conveniences'].cards },
			},
			edit: conveniencesEdit,
		},
		'dicey/home-delivery': {
			title: __( 'Регулярные доставки рациона', 'dicey' ),
			icon: 'calendar-alt',
			attributes: {
				title: { type: 'string' },
				subtitle: { type: 'string' },
				text_first: { type: 'string' },
				text_second: { type: 'string' },
				button_label: { type: 'string' },
				button_url: { type: 'string' },
			},
			edit: deliveryEdit,
		},
		'dicey/home-works': {
			title: __( 'Как это работает', 'dicey' ),
			icon: 'list-view',
			attributes: {
				title: { type: 'string' },
				subtitle: { type: 'string' },
				link_label: { type: 'string' },
				link_url: { type: 'string' },
				steps: { type: 'array', default: defaults['home-works'].steps },
			},
			edit: worksEdit,
		},
		'dicey/home-about-food': {
			title: __( 'Что получает ваша собака', 'dicey' ),
			icon: 'food',
			attributes: {
				title: { type: 'string' },
				text: { type: 'string' },
				link_label: { type: 'string' },
				link_url: { type: 'string' },
				items: { type: 'array', default: defaults['home-about-food'].items },
			},
			edit: aboutFoodEdit,
		},
		'dicey/home-plan': {
			title: __( 'Составим индивидуальный план питания', 'dicey' ),
			icon: 'id',
			attributes: {
				person_name: { type: 'string' },
				person_role: { type: 'string' },
				title: { type: 'string' },
				subtitle: { type: 'string' },
				price: { type: 'string' },
				text: { type: 'string' },
				button_label: { type: 'string' },
			},
			edit: planEdit,
		},
		'dicey/dietology': {
			title: __( 'Диетология', 'dicey' ),
			icon: 'heart',
			attributes: {
				hero_title: { type: 'string' },
				hero_accent: { type: 'string' },
				hero_text: { type: 'string' },
				hero_button_label: { type: 'string' },
				hero_mobile_label: { type: 'string' },
				consult_title: { type: 'string' },
				consult_items: { type: 'array', default: defaults.dietology.consult_items },
				plan_person_name: { type: 'string' },
				plan_person_role: { type: 'string' },
				plan_person_image: { type: 'string' },
				plan_title: { type: 'string' },
				plan_subtitle: { type: 'string' },
				plan_text: { type: 'string' },
				plan_link_label: { type: 'string' },
				plan_certificates: { type: 'array', default: defaults.dietology.plan_certificates },
				advisory_title: { type: 'string' },
				advisory_steps: { type: 'array', default: defaults.dietology.advisory_steps },
				advantages_title: { type: 'string' },
				advantages: { type: 'array', default: defaults.dietology.advantages },
				price_title: { type: 'string' },
				prices: { type: 'array', default: defaults.dietology.prices },
				faq_title: { type: 'string' },
				faq_items: { type: 'array', default: defaults.dietology.faq_items },
			},
			edit: dietologyEdit,
		},
		'dicey/about': {
			title: __( 'О нас', 'dicey' ),
			icon: 'groups',
			attributes: {
				hero_title: { type: 'string' },
				hero_image: { type: 'string' },
				nutrition_title: { type: 'string' },
				nutrition_text: { type: 'string' },
				nutrition_items: { type: 'array', default: defaults.about.nutrition_items },
				acquaintances_title: { type: 'string' },
				acquaintances_lead: { type: 'string' },
				acquaintances_paragraphs: { type: 'array', default: defaults.about.acquaintances_paragraphs },
				acquaintances_image: { type: 'string' },
				team_title: { type: 'string' },
				team_items: { type: 'array', default: defaults.about.team_items },
				choice_title: { type: 'string' },
				choice_items: { type: 'array', default: defaults.about.choice_items },
				nature_image: { type: 'string' },
				nature_title: { type: 'string' },
				nature_paragraphs: { type: 'array', default: defaults.about.nature_paragraphs },
				partnership_title: { type: 'string' },
				partnership_subtitle: { type: 'string' },
				partnership_text: { type: 'string' },
				partnership_button_label: { type: 'string' },
				partnership_image: { type: 'string' },
			},
			edit: aboutEdit,
		},
		'dicey/shipping': {
			title: __( 'Бесплатная доставка', 'dicey' ),
			icon: 'location-alt',
			attributes: {
				title: { type: 'string' },
				tabs: { type: 'array', default: defaults.shipping.tabs },
			},
			edit: shippingEdit,
		},
		'dicey/sale': {
			title: __( 'Скидка - 30% на первый заказ', 'dicey' ),
			icon: 'tag',
			attributes: {
				title: { type: 'string' },
				subtitle: { type: 'string' },
				text: { type: 'string' },
				button_label: { type: 'string' },
				button_url: { type: 'string' },
			},
			edit: saleEdit,
		},
		'dicey/why': {
			title: __( 'Остались вопросы по питанию?', 'dicey' ),
			icon: 'email-alt',
			attributes: {
				title: { type: 'string' },
				text: { type: 'string' },
				button_label: { type: 'string' },
			},
			edit: whyEdit,
		},
		'dicey/home-questions': {
			title: __( 'Часто задаваемые вопросы', 'dicey' ),
			icon: 'editor-help',
			attributes: {
				title: { type: 'string' },
				tabs: { type: 'array', default: defaults['home-questions'].tabs },
			},
			edit: questionsEdit,
		},
	};

	Object.keys( editable ).forEach( function ( name ) {
		var block = editable[ name ];
		blocks.registerBlockType( name, {
			apiVersion: 2,
			title: block.title,
			icon: block.icon,
			category: 'dicey',
			attributes: block.attributes,
			supports: { html: false, align: [ 'wide', 'full' ] },
			edit: block.edit,
			save: function () {
				return null;
			},
		} );
	} );

	[
		[ 'dicey/home-legacy', __( 'Домашняя страница', 'dicey' ), 'layout' ],
		[ 'dicey/works', __( 'Шаги оформления заказа', 'dicey' ), 'list-view' ],
	].forEach( function ( block ) {
		blocks.registerBlockType( block[0], {
			apiVersion: 2,
			title: block[1],
			icon: block[2],
			category: 'dicey',
			supports: { html: false, align: [ 'wide', 'full' ] },
			edit: function ( props ) {
				return box(
					block[1],
					el(
						'p',
						{ style: { margin: 0, color: '#646970' } },
						__( 'Эта секция пока подключена как готовый блок верстки.', 'dicey' )
					)
					,
					false,
					isFirstDiceyBlock( props )
				);
			},
			save: function () {
				return null;
			},
		} );
	} );
} )( window.wp.blocks, window.wp.element, window.wp.components, window.wp.i18n, window.wp.data, window.wp.blockEditor );
