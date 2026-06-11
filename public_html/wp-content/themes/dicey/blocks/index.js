( function ( blocks, element, components, i18n, data ) {
	var el = element.createElement;
	var __ = i18n.__;
	var TextControl = components.TextControl;
	var TextareaControl = components.TextareaControl;
	var PanelBody = components.PanelBody;

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
		var attrs = props.attributes;
		var setAttributes = props.setAttributes;

		return box( 'Остались вопросы по питанию?', [
			el( TextareaControl, {
				label: 'Заголовок',
				value: val( attrs, 'why', 'title' ),
				onChange: function ( value ) { setAttributes( { title: value } ); },
			} ),
			el( TextareaControl, {
				label: 'Текст',
				value: val( attrs, 'why', 'text' ),
				onChange: function ( value ) { setAttributes( { text: value } ); },
			} ),
			el( TextControl, {
				label: 'Текст кнопки',
				value: val( attrs, 'why', 'button_label' ),
				onChange: function ( value ) { setAttributes( { button_label: value } ); },
			} ),
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
} )( window.wp.blocks, window.wp.element, window.wp.components, window.wp.i18n, window.wp.data );
