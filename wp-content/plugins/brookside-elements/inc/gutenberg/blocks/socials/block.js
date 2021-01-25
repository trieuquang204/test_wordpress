var el = wp.element.createElement,
	registerBlockType = wp.blocks.registerBlockType,
	ServerSideRender = wp.components.ServerSideRender,
	TextControl = wp.components.TextControl,
	PanelBody = wp.components.PanelBody,
	__ = wp.i18n.__,
	InspectorControls = wp.editor.InspectorControls,
	SelectControl = wp.components.SelectControl,
    ToggleControl = wp.components.ToggleControl,
    ColorPalette = wp.editor.ColorPalette,
    ColorPicker = wp.editor.ColorPicker,
	PanelColor = wp.components.PanelColor,
	TextAlign = [
		{ label: __('Left', 'brookside-elements'), value: 'textleft' },
		{ label: __('Center', 'brookside-elements'), value: 'textcenter' },
		{ label: __('Right', 'brookside-elements'), value: 'textright' }
	];


registerBlockType( 'brookside/socials', {
    title: __('Brookside Social links', 'brookside-elements'),

    icon: 'networking',

    category: 'brooksideelements',

    edit: function( props ) {

		return [

			el( ServerSideRender, {
				block: 'brookside/socials',
				attributes: props.attributes,
			} ),

			el( InspectorControls, {},
				el( 'p', {}, __('If you need to change links. Go to Theme options -> socials in customizer', 'brookside-elements') ),
				el( 'p', {}, '' ),
				el( 'h3', {}, __( 'Select icon color', 'brookside-elements' ) ),
                el(ColorPalette, {
                    value: props.attributes.links_color,
                    onChange: ( value ) => { props.setAttributes( { links_color: value } ); }
                }),
                el( 'p', {}, '' ),
                el( 'h3', {}, __( 'Select icon background color', 'brookside-elements' ) ),
                el(ColorPalette, {
                    value: props.attributes.bg_color,
                    onChange: ( value ) => { props.setAttributes( { bg_color: value } ); }
                }),
                el( SelectControl,
	                {
	                    label: __('Align icons', 'brookside-elements'),
	                    help : __('Select position for icons etc.', 'brookside-elements'),
	                    value: props.attributes.icons_align,
	                    onChange: ( value ) => { props.setAttributes( { icons_align: value } ); },
	                    options: TextAlign,
	                }
	            ),
	            el( TextControl, {
					label: __('Socials block id', 'brookside-elements'),
					help : __('Use this field if you need to style it.', 'brookside-elements'),
					value: props.attributes.block_id,
					onChange: ( value ) => { props.setAttributes( { block_id: value } ); },
				} ),
			),
			el('style', {
	            	type:"text/css"
	            },
	            '.social-icons.simple'+props.attributes.block_id+' li a {background-color:'+props.attributes.bg_color+' !important; color:'+props.attributes.links_color+' !important;}'
	        )
			
		];
	},

	// We're going to be rendering in PHP, so save() can just return null.
	save: function() {
		return null;
	},
} );
