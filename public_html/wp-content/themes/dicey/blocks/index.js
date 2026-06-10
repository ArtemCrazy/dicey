( function ( blocks, element, components, i18n ) {
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

	function box( title, children, showNote ) {
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
				'div',
				{
					style: {
						borderBottom: '1px solid #e0e0e0',
						padding: '14px 16px 12px',
						background: '#f6f7f7',
					},
				},
				el( 'h2', { style: { margin: showNote ? '0 0 6px' : 0, fontSize: '18px', lineHeight: '1.3' } }, title ),
				showNote ? previewNote() : null
			),
			el( 'div', { style: { padding: '12px 16px 16px' } }, children )
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
		], true );
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
		], true );
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
		], true );
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
		], true );
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
		], true );
	}

	var editable = {
		'dicey/home-hero': {
			title: __( 'Dicey: Hero', 'dicey' ),
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
			title: __( 'Dicey: Conveniences', 'dicey' ),
			icon: 'grid-view',
			attributes: {
				title: { type: 'string' },
				cards: { type: 'array', default: defaults['home-conveniences'].cards },
			},
			edit: conveniencesEdit,
		},
		'dicey/home-delivery': {
			title: __( 'Dicey: Subscription Delivery', 'dicey' ),
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
			title: __( 'Dicey: How It Works Section', 'dicey' ),
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
		'dicey/home-questions': {
			title: __( 'Dicey: FAQ', 'dicey' ),
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
		[ 'dicey/home-legacy', __( 'Dicey: Home Page', 'dicey' ), 'layout' ],
		[ 'dicey/home-popularity', __( 'Dicey: Popular Products', 'dicey' ), 'products' ],
		[ 'dicey/home-about-food', __( 'Dicey: Food Benefits', 'dicey' ), 'food' ],
		[ 'dicey/home-plan', __( 'Dicey: Nutrition Plan', 'dicey' ), 'id' ],
		[ 'dicey/shipping', __( 'Dicey: Shipping', 'dicey' ), 'location-alt' ],
		[ 'dicey/sale', __( 'Dicey: Sale Banner', 'dicey' ), 'tag' ],
		[ 'dicey/why', __( 'Dicey: Contact CTA', 'dicey' ), 'email-alt' ],
		[ 'dicey/works', __( 'Dicey: How It Works', 'dicey' ), 'list-view' ],
	].forEach( function ( block ) {
		blocks.registerBlockType( block[0], {
			apiVersion: 2,
			title: block[1],
			icon: block[2],
			category: 'dicey',
			supports: { html: false, align: [ 'wide', 'full' ] },
			edit: function () {
				return box(
					block[1],
					el(
						'p',
						{ style: { margin: 0, color: '#646970' } },
						__( 'Эта секция пока подключена как готовый блок верстки.', 'dicey' )
					)
					,
					false
				);
			},
			save: function () {
				return null;
			},
		} );
	} );
} )( window.wp.blocks, window.wp.element, window.wp.components, window.wp.i18n );
