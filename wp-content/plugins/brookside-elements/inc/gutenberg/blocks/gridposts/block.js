var el = wp.element.createElement,
	registerBlockType = wp.blocks.registerBlockType,
	ServerSideRender = wp.components.ServerSideRender,
	TextControl = wp.components.TextControl,
	__ = wp.i18n.__,
	InspectorControls = wp.editor.InspectorControls,
	SelectControl = wp.components.SelectControl,
    ToggleControl = wp.components.ToggleControl,
	Order = [{ label: __('Descending', 'brookside-elements'), value: 'DESC' }, { label: __('Ascending', 'brookside-elements'), value: 'ASC' }],
	Orderby = [
		{ label: __('Date', 'brookside-elements'), value: 'date' }, 
		{ label: __('Last modified date', 'brookside-elements'), value: 'modified' },
		{ label: __('Popularity', 'brookside-elements'), value: 'comment_count' },
		{ label: __('Title', 'brookside-elements'), value: 'title' },
		{ label: __('Random', 'brookside-elements'), value: 'rand' },
		{ label: __('Preserve post ID order', 'brookside-elements'), value: 'post__in' },
	],
	PostStyles = [
		{ label: __('Simple', 'brookside-elements'), value: 'style_1' },
		{ label: __('Grid gallery', 'brookside-elements'), value: 'style_6' }, 
		{ label: __('Featured', 'brookside-elements'), value: 'style_2' },
		{ label: __('Featured even/odd', 'brookside-elements'), value: 'style_3' },
		{ label: __('Masonry', 'brookside-elements'), value: 'style_4' },
		{ label: __('Masonry 2', 'brookside-elements'), value: 'style_5' },
	],
	Columns = [
		{ label: __('Two', 'brookside-elements'), value: 'span6' },
		{ label: __('Three', 'brookside-elements'), value: 'span4' },
		{ label: __('Four', 'brookside-elements'), value: 'span3' },
		{ label: __('Five', 'brookside-elements'), value: 'one_fifth' },
		{ label: __('Six', 'brookside-elements'), value: 'span2' }
	],
	ImageSizes = [
		{ label: __('Medium', 'brookside-elements'), value: 'medium' },
		{ label: __('Large', 'brookside-elements'), value: 'large' },
		{ label: __('Post thumbnail', 'brookside-elements'), value: 'post-thumbnail' },
		{ label: __('Brookside masonry', 'brookside-elements'), value: 'brookside-masonry' },
		{ label: __('Brookside extra medium', 'brookside-elements'), value: 'brookside-extra-medium' },
		{ label: __('Full', 'brookside-elements'), value: 'full' }
	],
	TextAlign = [
		{ label: __('Left', 'brookside-elements'), value: 'textleft' },
		{ label: __('Center', 'brookside-elements'), value: 'textcenter' },
		{ label: __('Right', 'brookside-elements'), value: 'textright' }
	],
	Pagination = [
		{ label: __('Load more', 'brookside-elements'), value: 'true' },
		{ label: __('Standard', 'brookside-elements'), value: 'standard' },
		{ label: __('Disable', 'brookside-elements'), value: 'false' }
	];

registerBlockType( 'brookside/gridposts', {
    title: __('Brookside Recent Posts', 'brookside-elements'),

    icon: 'layout',

    category: 'brooksideelements',

    edit: function( props ) {
		return [
			/*
			 * The ServerSideRender element uses the REST API to automatically call
			 * php_block_render() in your PHP code whenever it needs to get an updated
			 * view of the block.
			 */
			el( ServerSideRender, {
				block: 'brookside/gridposts',
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
				el( TextControl, {
					label: __('Post count', 'brookside-elements'),
					help: __("Enter number of posts to display per page (Note: Enter '-1' to display all posts).", 'brookside-elements') ,
					value: props.attributes.num,
					onChange: ( value ) => { props.setAttributes( { num: value } ); },
				} ),
				el( TextControl, {
					label: __('Load more posts count', 'brookside-elements'),
					help: __("Enter number of posts to load (leave balnk to use the same value as per page).", 'brookside-elements') ,
					value: props.attributes.load_count,
					onChange: ( value ) => { props.setAttributes( { load_count: value } ); },
				} ),
				el( TextControl, {
					label: __('Posts offset', 'brookside-elements'),
					help: __("Enter the number of posts to offset before retrieval.", 'brookside-elements') ,
					value: props.attributes.offset,
					onChange: ( value ) => { props.setAttributes( { offset: value } ); },
				} ),
				el( SelectControl,
	                {
	                    label: __('Posts per row', 'brookside-elements'),
	                    help : __('Select posts count per row. It works for simple and masonry style.', 'brookside-elements'),
	                    value: props.attributes.columns,
	                    onChange: ( value ) => { props.setAttributes( { columns: value } ); },
	                    options: Columns,
	                }
	            ),
				el( SelectControl,
	                {
	                	multiple: true,
	                    label: __('Select categories to show', 'brookside-elements'),
	                    value: props.attributes.cat_slug,
	                    onChange: ( value ) => { props.setAttributes( { cat_slug: value } ); },
	                    options: categorySelections,
	                }
	            ),
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
	                    label: __('Post IDs Exclude', 'brookside-elements'),
	                    help: __("Enter posts IDs to exclude those records (Note: separate values by commas (,)).", 'brookside-elements') ,
	                    value: props.attributes.post__not_in,
	                    onChange: ( value ) => { props.setAttributes( { post__not_in: value } ); },
	                    options: postSelections,
	                }
	            ),
				el( SelectControl,
	                {
	                    label: __('Order by', 'brookside-elements'),
	                    help : __('Select how to sort retrieved posts.', 'brookside-elements'),
	                    value: props.attributes.orderby,
	                    onChange: ( value ) => { props.setAttributes( { orderby: value } ); },
	                    options: Orderby,
	                }
	            ),
				el( SelectControl,
	                {
	                    label: __('Sort order', 'brookside-elements'),
	                    help : __('Select ascending or descending order.', 'brookside-elements'),
	                    value: props.attributes.order,
	                    onChange: ( value ) => { props.setAttributes( { order: value } ); },
	                    options: Order,
	                }
	            ),
	            el( SelectControl,
	                {
	                    label: __('Post view style', 'brookside-elements'),
	                    help : __('Select posts style on preview.', 'brookside-elements'),
	                    value: props.attributes.post_style,
	                    onChange: ( value ) => { props.setAttributes( { post_style: value } ); },
	                    options: PostStyles,
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
	            el( TextControl, {
					label: __('Post excerpt count', 'brookside-elements'),
					help: __("Enter number of words in post excerpt. 0 to hide it.", 'brookside-elements') ,
					value: props.attributes.excerpt_count,
					onChange: ( value ) => { props.setAttributes( { excerpt_count: value } ); },
				} ),
				el( SelectControl,
	                {
	                    label: __('Align elements', 'brookside-elements'),
	                    help : __('Select position for text, meta info, categories, etc.', 'brookside-elements'),
	                    value: props.attributes.text_align,
	                    onChange: ( value ) => { props.setAttributes( { text_align: value } ); },
	                    options: TextAlign,
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
                ),
                el( ToggleControl,
                    {
                        label: __('Display time reading?','brookside-elements'),
                        help: __('Show estimate time to read the post?', 'brookside-elements'),
                        checked: props.attributes.display_read_time,
                        onChange: function (event) {
                            props.setAttributes({display_read_time: !props.attributes.display_read_time});
                        }
                    }
                ),
                el( ToggleControl,
                    {
                        label: __('Display comments count?','brookside-elements'),
                        checked: props.attributes.display_comments,
                        onChange: function (event) {
                            props.setAttributes({display_comments: !props.attributes.display_comments});
                        }
                    }
                ),
                el( ToggleControl,
                    {
                        label: __('Display date label?','brookside-elements'),
                        checked: props.attributes.display_date,
                        onChange: function (event) {
                            props.setAttributes({display_date: !props.attributes.display_date});
                        }
                    }
                ),
                el( ToggleControl,
                    {
                        label: __('Display views?','brookside-elements'),
                        checked: props.attributes.display_views,
                        onChange: function (event) {
                            props.setAttributes({display_views: !props.attributes.display_views});
                        }
                    }
                ),
                el( ToggleControl,
                    {
                        label: __('Display likes?','brookside-elements'),
                        checked: props.attributes.display_likes,
                        onChange: function (event) {
                            props.setAttributes({display_likes: !props.attributes.display_likes});
                        }
                    }
                ),
                el( SelectControl,
	                {
	                    label: __('Pagination', 'brookside-elements'),
	                    help : __('Select pagination for posts.', 'brookside-elements'),
	                    value: props.attributes.pagination,
	                    onChange: ( value ) => { props.setAttributes( { pagination: value } ); },
	                    options: Pagination,
	                }
	            ),
                el( ToggleControl,
                    {
                        label: __('Disable featured posts style?','brookside-elements'),
                        help: __('Disable style for featured posts. Do not highlight them.', 'brookside-elements'),
                        checked: props.attributes.ignore_featured,
                        onChange: function (event) {
                            props.setAttributes({ignore_featured: !props.attributes.ignore_featured});
                        }
                    }
                ),
                el( ToggleControl,
                    {
                        label: __('Ignore sticky posts?','brookside-elements'),
                        checked: props.attributes.ignore_sticky_posts,
                        onChange: function (event) {
                            props.setAttributes({ignore_sticky_posts: !props.attributes.ignore_sticky_posts});
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
