var el = wp.element.createElement,
	registerBlockType = wp.blocks.registerBlockType,
	ServerSideRender = wp.components.ServerSideRender,
	TextControl = wp.components.TextControl,
	__ = wp.i18n.__,
	InspectorControls = wp.editor.InspectorControls,
	SelectControl = wp.components.SelectControl,
    ToggleControl = wp.components.ToggleControl,
    MediaUpload = wp.editor.MediaUpload,
    components = wp.components,
    carousel = null,
	TrueFalse = [{ label: 'Yes', value: 'true' }, { label: 'No', value: 'false' }];
	ImageHeight = [{ label: 'Landscape', value: 'size-landscape' }, { label: 'Portrait', value: 'size-portrait' }];

registerBlockType( 'brookside/category', {
    title: __('Brookside Category', 'brookside-elements'),

    icon: 'category',

    category: 'brooksideelements',

    edit: function( props ) {
    	var onSelectImage = function( media ) {
			return props.setAttributes( {
				mediaURL: media.url,
				mediaID: media.id,
			} );
		};

		return [

			el( ServerSideRender, {
				block: 'brookside/category',
				attributes: props.attributes,
			} ),

			el( InspectorControls, {},
				el( TextControl, {
					label: __('Category name', 'brookside-elements'),
					help: __('Please enter category name', 'brookside-elements'),
					value: props.attributes.title,
					onChange: ( value ) => { props.setAttributes( { title: value } ); },
				} ),
				el( MediaUpload, {
					onSelect: onSelectImage,
					type: 'image',
					value: props.attributes.mediaID,
					render: function( obj ) {
						return el( components.Button, {
							className: props.attributes.mediaID ? 'image-button' : 'button button-large',
							onClick: obj.open
							},
							! props.attributes.mediaID ? __( 'Upload Image', 'brookside-elements') : el( 'img', { src: props.attributes.mediaURL } )
						);
					}
				} ),
				el( SelectControl,
	                {
	                    label: __('Image height', 'brookside-elements'),
	                    value: props.attributes.image_height,
	                    onChange: ( value ) => { props.setAttributes( { image_height: value } ); },
	                    options: ImageHeight,
	                }
	            ),
				el( TextControl, {
					label: __('Category URL', 'brookside-elements'),
					help: __('Please enter category url', 'brookside-elements'),
					value: props.attributes.cat_url,
					onChange: ( value ) => { props.setAttributes( { cat_url: value } ); },
				} ),

			),
		];
	},

	// We're going to be rendering in PHP, so save() can just return null.
	save: function() {
		return null;
	},
} );
