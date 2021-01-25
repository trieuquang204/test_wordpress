var el = wp.element.createElement,
	registerBlockType = wp.blocks.registerBlockType,
	ServerSideRender = wp.components.ServerSideRender,
	TextControl = wp.components.TextControl,
	__ = wp.i18n.__,
	InspectorControls = wp.editor.InspectorControls,
	SelectControl = wp.components.SelectControl,
    ToggleControl = wp.components.ToggleControl,
	ImageSizes = [
		{ label: __('Medium', 'brookside-elements'), value: 'medium' },
		{ label: __('Large', 'brookside-elements'), value: 'large' },
		{ label: __('Post thumbnail', 'brookside-elements'), value: 'post-thumbnail' },
		{ label: __('Brookside masonry', 'brookside-elements'), value: 'brookside-masonry' },
		{ label: __('Brookside extra medium', 'brookside-elements'), value: 'brookside-extra-medium' },
		{ label: __('Brookside Slider', 'brookside-elements'), value: 'brookside-slider' },
		{ label: __('Full', 'brookside-elements'), value: 'full' }
	];

registerBlockType( 'brookside/singlepost', {
    title: __('Brookside Single Post', 'brookside-elements'),

    icon: 'megaphone',

    category: 'brooksideelements',

    edit: function( props ) {
		return [
			/*
			 * The ServerSideRender element uses the REST API to automatically call
			 * php_block_render() in your PHP code whenever it needs to get an updated
			 * view of the block.
			 */
			el( ServerSideRender, {
				block: 'brookside/singlepost',
				attributes: props.attributes,
			} ),
			/*
			 * InspectorControls lets you add controls to the Block sidebar. In this case,
			 * we're adding a TextControl, which lets us edit the 'foo' attribute (which
			 * we defined in the PHP). The onChange property is a little bit of magic to tell
			 * the block editor to update the value of our 'foo' property, and to re-render
			 * the block.
			 */
			el( InspectorControls, {},
				el( SelectControl,
	                {
	                	multiple: false,
	                    label: __('Select post to show', 'brookside-elements'),
	                    value: props.attributes.post_id,
	                    onChange: ( value ) => { props.setAttributes( { post_id: value } ); },
	                    options: postSelections,
	                }
	            ),
	            el( SelectControl,
	                {
	                    label: __('Thumbnail size', 'brookside-elements'),
	                    help : __('Select your image size to use.', 'brookside-elements'),
	                    value: props.attributes.thumbsize,
	                    onChange: ( value ) => { props.setAttributes( { thumbsize: value } ); },
	                    options: ImageSizes,
	                }
	            ),
	            el( ToggleControl,
                    {
                        label: __('Display categories?','brookside-elements'),
                        help: __('Show categories above the title?', 'brookside-elements'),
                        checked: props.attributes.display_categories,
                        onChange: function (event) {
                            props.setAttributes({display_categories: !props.attributes.display_categories});
                        }
                    }
                )
			),
		];
	},

	// We're going to be rendering in PHP, so save() can just return null.
	save: function() {
		return null;
	},
} );
