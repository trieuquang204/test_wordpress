var el = wp.element.createElement,
	registerBlockType = wp.blocks.registerBlockType,
	ServerSideRender = wp.components.ServerSideRender,
	TextControl = wp.components.TextControl,
	__ = wp.i18n.__,
	InspectorControls = wp.editor.InspectorControls,
	SelectControl = wp.components.SelectControl,
    ToggleControl = wp.components.ToggleControl,
    carousel = null,
	TrueFalse = [{ label: 'Yes', value: 'true' }, { label: 'No', value: 'false' }];

registerBlockType( 'brookside/contactform', {
    title: __('Brookside Contact Form', 'brookside-elements'),

    icon: 'email',

    category: 'brooksideelements',

    edit: function( props ) {

		return [

			el( ServerSideRender, {
				block: 'brookside/contactform',
				attributes: props.attributes,
			} ),

			el( InspectorControls, {},
				el( TextControl, {
					label: __('Contact form shortocde', 'brookside-elements'),
					help: __('Please insert shortcode from "Contact form 7" plugin or similar to it.', 'brookside-elements'),
					value: props.attributes.contactform,
					onChange: ( value ) => { props.setAttributes( { contactform: value } ); },
				} ),
			),
		];
	},

	// We're going to be rendering in PHP, so save() can just return null.
	save: function() {
		return null;
	},
} );
