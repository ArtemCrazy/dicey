( function ( blocks, element, serverSideRender, i18n ) {
	var el = element.createElement;
	var __ = i18n.__;
	var ServerSideRender = serverSideRender;

	var diceyBlocks = [
		{
			name: 'dicey/home-legacy',
			title: __( 'Dicey: Home Page', 'dicey' ),
			icon: 'layout',
		},
		{
			name: 'dicey/home-hero',
			title: __( 'Dicey: Hero', 'dicey' ),
			icon: 'cover-image',
		},
		{
			name: 'dicey/home-conveniences',
			title: __( 'Dicey: Conveniences', 'dicey' ),
			icon: 'grid-view',
		},
		{
			name: 'dicey/home-popularity',
			title: __( 'Dicey: Popular Products', 'dicey' ),
			icon: 'products',
		},
		{
			name: 'dicey/home-delivery',
			title: __( 'Dicey: Subscription Delivery', 'dicey' ),
			icon: 'calendar-alt',
		},
		{
			name: 'dicey/home-about-food',
			title: __( 'Dicey: Food Benefits', 'dicey' ),
			icon: 'food',
		},
		{
			name: 'dicey/home-plan',
			title: __( 'Dicey: Nutrition Plan', 'dicey' ),
			icon: 'id',
		},
		{
			name: 'dicey/home-works',
			title: __( 'Dicey: How It Works Section', 'dicey' ),
			icon: 'list-view',
		},
		{
			name: 'dicey/home-questions',
			title: __( 'Dicey: FAQ', 'dicey' ),
			icon: 'editor-help',
		},
		{
			name: 'dicey/works',
			title: __( 'Dicey: How It Works', 'dicey' ),
			icon: 'list-view',
		},
		{
			name: 'dicey/shipping',
			title: __( 'Dicey: Shipping', 'dicey' ),
			icon: 'location-alt',
		},
		{
			name: 'dicey/sale',
			title: __( 'Dicey: Sale Banner', 'dicey' ),
			icon: 'tag',
		},
		{
			name: 'dicey/why',
			title: __( 'Dicey: Contact CTA', 'dicey' ),
			icon: 'email-alt',
		},
	];

	diceyBlocks.forEach( function ( block ) {
		blocks.registerBlockType( block.name, {
			apiVersion: 2,
			title: block.title,
			icon: block.icon,
			category: 'dicey',
			supports: {
				html: false,
				align: [ 'wide', 'full' ],
			},
			edit: function () {
				return el(
					'div',
					{ className: 'dicey-editor-preview' },
					el( ServerSideRender, { block: block.name } )
				);
			},
			save: function () {
				return null;
			},
		} );
	} );
} )( window.wp.blocks, window.wp.element, window.wp.serverSideRender, window.wp.i18n );
