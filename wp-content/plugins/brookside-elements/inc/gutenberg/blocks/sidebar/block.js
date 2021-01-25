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

registerBlockType( 'brookside/sidebar', {
    title: __('Brookside Sidebar', 'brookside-elements'),

    icon: 'post-status',

    category: 'brooksideelements',

    edit: function( props ) {

		return [
			el( 'div', { 
				className: 'brookside-element-block'
				},
				el('h3',{className:'brookside-block-title'}, 
					el('span',{className:'fa fa-columns'},__('Sidebar', 'brookside-elements'))
				)
			),
			
		];
	},

	// We're going to be rendering in PHP, so save() can just return null.
	save: function() {
		return null;
	},
} );
