var el = wp.element.createElement,
	registerBlockType = wp.blocks.registerBlockType,
	ServerSideRender = wp.components.ServerSideRender,
	TextControl = wp.components.TextControl,
	components = wp.components,
	__ = wp.i18n.__,
	InspectorControls = wp.editor.InspectorControls,
	SelectControl = wp.components.SelectControl,
    ToggleControl = wp.components.ToggleControl,
    MediaUpload = wp.editor.MediaUpload,
	MapStyles = [
		{ label: __('Blue water', 'brookside-elements'), value: 'style1' },
		{ label: __('Simple grayscale', 'brookside-elements'), value: 'style2' },
		{ label: __('Light monochrome', 'brookside-elements'), value: 'style3' },
		{ label: __('Dark theme', 'brookside-elements'), value: 'style4' }
	];

registerBlockType( 'brookside/map', {
    title: __('Brookside Google Map', 'brookside-elements'),

    icon: 'location-alt',

    category: 'brooksideelements',

    edit: function( props ) {
    	var onSelectImage = function( media ) {
			return props.setAttributes( {
				marker_url: media.url,
				marker_icon: media.id,
			} );
		};
		return [
			el( 'div', { 
				className: 'brookside-google-map-block'
				},
				el('h3',{className:'brookside-google-map-title'}, 
					el('span',{className:'fa fa-map'},__('Brookside google map', 'brookside-elements'))
				)
			),
			el( InspectorControls, {},
				el( TextControl, {
					label: __('Address', 'brookside-elements'),
					help: __("Enter your address", 'brookside-elements') ,
					value: props.attributes.address,
					onChange: ( value ) => { props.setAttributes( { address: value } ); },
				} ),
	            el( SelectControl,
	                {
	                    label: __('Map style', 'brookside-elements'),
	                    help : __('Select your map style', 'brookside-elements'),
	                    value: props.attributes.style,
	                    onChange: ( value ) => { props.setAttributes( { style: value } ); },
	                    options: MapStyles,
	                }
	            ),
	            el('p',{}, __('Map marker', 'brookside-elements') 

	            ),
	            el( MediaUpload, {
						onSelect: onSelectImage,
						type: 'image',
						value: props.attributes.marker_icon,
						render: function( obj ) {
							return el( components.Button, {
								className: props.attributes.marker_icon ? 'image-button' : 'button button-large',
								onClick: obj.open
								},
								! props.attributes.marker_icon ? __( 'Upload Image', 'brookside-elements' ) : el( 'img', { src: props.attributes.marker_url } )
							);
						}
					}
				),
				el( TextControl, {
					label: __('Map height', 'brookside-elements'),
					help: __("Enter your map height without 'px'", 'brookside-elements') ,
					value: props.attributes.map_height,
					onChange: ( value ) => { props.setAttributes( { map_height: value } ); },
				} ),
			),
		];
	},

	// We're going to be rendering in PHP, so save() can just return null.
	save: function() {
		return null;
	},
} );
