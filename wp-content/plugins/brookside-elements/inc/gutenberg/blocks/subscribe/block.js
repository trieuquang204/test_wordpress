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


registerBlockType( 'brookside/subscribe', {
    title: __('Brookside Subscribe', 'brookside-elements'),

    icon: 'email-alt',

    category: 'brooksideelements',

    edit: function( props ) {

		return [

			el( ServerSideRender, {
				block: 'brookside/subscribe',
				attributes: props.attributes,
			} ),

			el( InspectorControls, {},
	            el( TextControl, {
					label: __('Subscribe block title', 'brookside-elements'),
					value: props.attributes.title,
					onChange: ( value ) => { props.setAttributes( { title: value } ); },
				} ),
			)
			
		];
	},

	// We're going to be rendering in PHP, so save() can just return null.
	save: function() {
		return null;
	},
} );
