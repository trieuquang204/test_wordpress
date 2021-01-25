<?php
	$out = '';
	$out .= '<div class="meta">';
	if( function_exists('getPostLikeLink') ) $out .= '<div class="post-like">'.getPostLikeLink( get_the_ID() ).'</div>';
	if( function_exists('BrooksideGetPostViews') ) $out .= '<div class="post-view">'.BrooksideGetPostViews( get_the_ID() ).'</div>';
	$out .= '</div>';
	$out .= '<div class="post-more"><a href="'.esc_url(get_the_permalink()).'" rel="bookmark"><i class="la la-long-arrow-right"></i></a></div>';
	if(function_exists('BrooksideSharebox')){
		$out .= BrooksideSharebox( get_the_ID() );
	}
	if(function_exists('getPostLikeLink') || function_exists('BrooksideGetPostViews') || function_exists('BrooksideSharebox') ){
		echo ''.$out;
	}
?>

	