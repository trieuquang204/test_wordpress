var el = wp.element.createElement,
	registerBlockType = wp.blocks.registerBlockType,
	ServerSideRender = wp.components.ServerSideRender,
	TextControl = wp.components.TextControl,
	__ = wp.i18n.__,
	InspectorControls = wp.editor.InspectorControls,
	SelectControl = wp.components.SelectControl,
    ToggleControl = wp.components.ToggleControl,
    carousel = null,
    apiFetch = wp.apiFetch,
	TrueFalse = [{ label: 'Yes', value: 'true' }, { label: 'No', value: 'false' }];

	const categorySelections = [];
	const allCategories = apiFetch({path: "/wp/v2/categories/?per_page=100"}).then(categories => {
	    jQuery.each( categories, function( key, val ) {
	        categorySelections.push({label: val.name, value: val.slug});
	    });
	    return categorySelections;
	});

registerBlockType( 'brookside/postscarousel', {
    title: __('Brookside Posts Carousel', 'brookside-elements'),

    icon: 'slides',

    category: 'brooksideelements',

    edit: function( props ) {

		return [
			el( 'div', { 
				className: 'brookside-element-block'
				},
				el('h3',{className:'brookside-block-title'}, 
					el('span',{className:'fa fa-images'},__('Posts carousel', 'brookside-elements'))
				)
			),

			el( InspectorControls, {},
				el( TextControl, {
					label: __('Posts count', 'brookside-elements'),
					value: props.attributes.number_posts,
					onChange: ( value ) => { props.setAttributes( { number_posts: value } ); },
				} ),
				el( SelectControl,
	                {
	                	multiple: true,
	                    label: __('Select posts to show', 'brookside-elements'),
	                    value: props.attributes.post_ids,
	                    onChange: ( value ) => { props.setAttributes( { post_ids: value } ); },
	                    options: postSelections,
	                }
	            ),
	            el( SelectControl,
	                {
	                	multiple: true,
	                    label: __('Select categories to show', 'brookside-elements'),
	                    value: props.attributes.cat_ids,
	                    onChange: ( value ) => { props.setAttributes( { cat_ids: value } ); },
	                    options: categorySelections,
	                }
	            ),
				el( ToggleControl,
	                {
	                    label: __('Slideshow', 'brookside-elements'),
	                    help: __('You can enable/disable slides autoplay','brookside-elements'),
	                    checked: props.attributes.slideshow,
	                    onChange: function (event) {
                            props.setAttributes({slideshow: !props.attributes.slideshow});
                        }
	                }
	            ),
	            el( ToggleControl,
                    {
                        label: 'Loop',
                        help: __('You can enable/disable slides loop', 'brookside-elements'),
                        checked: props.attributes.loop,
                        onChange: function (event) {
                            props.setAttributes({loop: !props.attributes.loop});
                        }
                    }
                ),
                el( ToggleControl,
                    {
                        label: __('Slider Arrows', 'brookside-elements'),
                        checked: props.attributes.nav,
                        onChange: function (event) {
                            props.setAttributes({nav: !props.attributes.nav});
                        }
                    }
                ),
                el( ToggleControl,
                    {
                        label: __('Slider bullets', 'brookside-elements'),
                        checked: props.attributes.show_dots,
                        onChange: function (event) {
                            props.setAttributes({show_dots: !props.attributes.show_dots});
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
