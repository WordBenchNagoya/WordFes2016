<?php
/*
 * テンプレートフォルダを挿入
 */
function pdc_get_theme_folder() {
	
	return get_template_directory_uri();
	
}
add_shortcode( 'theme_folder', 'pdc_get_theme_folder' );


/*
 * テンプレートフォルダを挿入
 */
function pdc_get_home_url() {
	
	return home_url('/');
	
}
add_shortcode( 'home_url', 'pdc_get_home_url' );


/*
 * 記事リスト
 */
function pdc_article_list( $atts ) {
	
	extract(
		shortcode_atts(
			array(
				'post_type' => 'post',
				'style'     => 'li',
				'number'    => 5,
			),
			$atts
		)
	);
	
	if ( is_user_logged_in() ) {
		
		$status = array( 'publish', 'pending', 'draft', 'private' );
		
	} else {
		
		$status = array( 'publish' );
		
	}
	
	$post_type_name = get_post_type_object( $post_type )->labels->name;
	
	$args = array(
		'post_type'      => $post_type,
		'post_status'    => $status,
		'posts_per_page' => $number,
	);
	$lists = new WP_Query( $args );
	
	if ( $lists->have_posts() ):
	
		$result = "<ul>\n";
		
		while ( $lists->have_posts() ):
			$lists->the_post();
			
			$result .= "  <li>\n";
			$result .= "    <p class=\"date\">" . get_the_time( 'Y.m.d' ) . "</p>\n";
			$result .= "    <p class=\"title\">";
			$result .= "      <a href=\"" . get_the_permalink() . "\">" . get_the_title() . "</a>\n";
			$result .= "    </p>\n";
			$result .= "  </li>\n";
			
		endwhile;
		
		$result .= "</ul>";
		
	else:
		$result = "<ul><li>まだ、{$post_type_name}はありません。<br>しばらくお待ちください。</li></ul>\n";
	endif;
	
	return $result;
	
}
add_shortcode( 'article_list', 'pdc_article_list' );


function pdc_twitter( $atts ) {

	extract(
		shortcode_atts(
			array(
				'id' => 'wordfesnagoya',
			),
			$atts
		)
	);
	
	return "<a class=\"twitter-timeline\" data-lang=\"ja\" data-height=\"400\" data-theme=\"light\" href=\"https://twitter.com/" . esc_attr( $id ) . "\">Tweets by " . esc_attr( $id ) . "</a>";
	
}
add_shortcode( 'twitter', 'pdc_twitter' );






