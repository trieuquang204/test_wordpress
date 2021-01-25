var el = wp.element.createElement,
	registerBlockType = wp.blocks.registerBlockType,
	ServerSideRender = wp.components.ServerSideRender,
	TextControl = wp.components.TextControl,
	__ = wp.i18n.__,
	InspectorControls = wp.editor.InspectorControls,
	SelectControl = wp.components.SelectControl,
    ToggleControl = wp.components.ToggleControl,
    carousel = null,
    apiFetch = wp.apiFetch;
	TrueFalse = [{ label: 'Yes', value: 'true' }, { label: 'No', value: 'false' }],
	ImageSizes = [
		{ label: __('Medium', 'brookside-elements'), value: 'medium' },
		{ label: __('Large', 'brookside-elements'), value: 'large' },
		{ label: __('Post thumbnail', 'brookside-elements'), value: 'post-thumbnail' },
		{ label: __('Brookside masonry', 'brookside-elements'), value: 'brookside-masonry' },
		{ label: __('Brookside extra medium', 'brookside-elements'), value: 'brookside-extra-medium' },
		{ label: __('Full', 'brookside-elements'), value: 'full' }
	],
	SliderStyles = [
		{ label: __('Style 1', 'brookside-elements'), value: 'style_1' }, 
		{ label: __('Style 2', 'brookside-elements'), value: 'style_2' },
	];

	const postSelections = [];
	const allPosts = apiFetch({path: "/wp/v2/posts/?per_page=100"}).then(posts => {
	    jQuery.each( posts, function( key, val ) {
	        postSelections.push({label: val.title.rendered, value: val.id});
	    });
	    return postSelections;
	});

registerBlockType( 'brookside/postslider', {
    title: __('Brookside Slider Posts', 'brookside-elements'),

    icon: 'slides',

    category: 'brooksideelements',

    edit: function( props ) {

		return [
			el( 'div', { 
				className: 'brookside-element-block'
				},
				el('h3',{className:'brookside-block-title'},
					el('i',{className:'fa fa-images'}), 
					el('span',{className:''},__('Posts slider', 'brookside-elements'))
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
	            el( TextControl, {
					label: __('Slider height without(px)', 'brookside-elements'),
					value: props.attributes.slider_height,
					onChange: ( value ) => { props.setAttributes( { slider_height: value } ); },
				} ),
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
                el( ToggleControl,
                    {
                        label: __('Show categories', 'brookside-elements'),
                        checked: props.attributes.show_categories,
                        onChange: function (event) {
                            props.setAttributes({show_categories: !props.attributes.show_categories});
                        }
                    }
                ),
                el( SelectControl,
	                {
	                    label: __('Select slider style', 'brookside-elements'),
	                    value: props.attributes.slider_style,
	                    onChange: ( value ) => { props.setAttributes( { slider_style: value } ); },
	                    options: SliderStyles,
	                }
	            ),
	            el( TextControl, {
					label: __('Excerpt count', 'brookside-elements'),
					value: props.attributes.excerpt_count,
					onChange: ( value ) => { props.setAttributes( { excerpt_count: value } ); },
				} ),
			),
		];
	},

	// We're going to be rendering in PHP, so save() can just return null.
	save: function() {
		return null;
	},
} );
