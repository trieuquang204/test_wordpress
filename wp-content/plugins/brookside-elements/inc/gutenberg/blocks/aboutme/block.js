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

registerBlockType( 'brookside/aboutme', {
    title: __('Brookside AboutMe', 'brookside-elements'),

    icon: 'admin-users',

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
				block: 'brookside/aboutme',
				attributes: props.attributes,
			} ),

			el( InspectorControls, {},
				el( TextControl, {
					label: __('Title', 'brookside-elements'),
					help: __('Please enter title', 'brookside-elements'),
					value: props.attributes.title,
					onChange: ( value ) => { props.setAttributes( { title: value } ); },
				} ),
				el( TextControl, {
					label: __('Subtitle', 'brookside-elements'),
					help: __('Please enter subtitle', 'brookside-elements'),
					value: props.attributes.subtitle,
					onChange: ( value ) => { props.setAttributes( { subtitle: value } ); },
				} ),
				el( TextControl, {
					label: __('Text', 'brookside-elements'),
					help: __('Please enter your text or leave blank', 'brookside-elements'),
					value: props.attributes.text,
					onChange: ( value ) => { props.setAttributes( { text: value } ); },
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
				el( ToggleControl,
                    {
                        label: 'Socials',
                        help: __('You can enable/disable socials', 'brookside-elements'),
                        checked: props.attributes.socials,
                        onChange: function (event) {
                            props.setAttributes({socials: !props.attributes.socials});
                        }
                    }
                ),
                el( ToggleControl,
                    {
                        label: 'Force Fullwidth',
                        help: __('You can enable/disable fullwidth', 'brookside-elements'),
                        checked: props.attributes.fullwidth,
                        onChange: function (event) {
                            props.setAttributes({fullwidth: !props.attributes.fullwidth});
                        }
                    }
                ),

			),
		];
	},

	// We're going to be rendering in PHP, so save() can just return null.
	save: function() {
		return null;
	},
} );
