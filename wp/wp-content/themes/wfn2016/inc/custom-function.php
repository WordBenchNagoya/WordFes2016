<?php

/*
 *  ラベルを変更
 */
function revcon_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'スタッフブログ';
    $submenu['edit.php'][5][0] = 'スタッフブログ一覧';
    $submenu['edit.php'][10][0] = 'スタッフブログの新規追加';
    $submenu['edit.php'][16][0] = 'タグ';
    echo '';
}
add_action( 'admin_menu', 'revcon_change_post_label' );

function revcon_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'スタッフブログ';
    $labels->singular_name = 'スタッフブログ';
    $labels->add_new = '新規追加';
    $labels->add_new_item = 'スタッフブログを追加';
    $labels->edit_item = 'スタッフブログの編集';
    $labels->new_item = 'スタッフブログ';
    $labels->view_item = 'スタッフブログの表示';
    $labels->search_items = 'スタッフブログを検索';
    $labels->not_found = 'スタッフブログが見つかりませんでした。';
    $labels->not_found_in_trash = 'ゴミ箱内にスタッフブログが見つかりませんでした。';
    $labels->all_items = '全てのスタッフブログ';
    $labels->menu_name = 'スタッフブログ';
    $labels->name_admin_bar = 'スタッフブログ';
} 
add_action( 'init', 'revcon_change_post_object' );


/*
 *  \n を <br> に変換
 */
function pdc_get_ret2br_text( $text ) {
	
	$search = array(
		'<p>',
		'</p>',
		'&nbsp;',
	);
	$result = str_replace( $search, '', $text );
	$result = str_replace( "\n", "<br>\n", $result );
	$result = str_replace( "--><br>", "-->", $result );
	$result = str_replace( "--><br />", "-->", $result );
	
	return $result;
	
}


/*
 *  ページＩＤを取得
 */
function pdc_get_page() {
	
	$page = get_page_by_path( get_query_var('pagename') );
	
	if ( ! isset( $page ) ) {
		
		$page = get_page_by_path( get_query_var('post_type') );
		
	}
	
	return $page;
	
}

/*
 *  ページネームを取得
 */
function pdc_get_page_name() {
	
	$page = pdc_get_page();
	
	return $page->post_title;
	
}

/*
 *  ページＩＤを取得
 */
function pdc_get_page_slug() {
	
	$page = pdc_get_page();
	
	return $page->post_name;
	
}


/*
 *  投稿時のタクソノミーの表示順序を変更
 */
function custom_wp_list_categories( $args, $field) {

    $args['orderby'] = 'order';

    return $args;

}
add_filter( 'acf/fields/taxonomy/wp_list_categories', 'custom_wp_list_categories', 10, 2 );


/*
 *  タイトル入力欄のテキストを変更
 */
function change_post_enter_title_here($title) {
	$screen = get_current_screen();
	if ( 'supporter' == $screen->post_type ) {
		$title = 'サポーター名（表示名）を入力してください';
	}
	return $title;
}
add_filter('enter_title_here', 'change_post_enter_title_here');


/*
 *  投稿時のタクソノミーの表示順序を変更
 */
function manage_pages_columns( $columns ) {
	
	global $post;

	$escape_date          = $columns['date'];
	$escape_author        = $columns['author'];
	
	unset($columns['author']);
	unset($columns['date']);
	unset($columns['tags']);
	unset($columns['comments']);
	
	$columns['pagetitle'] = 'ページタイトル';
	$columns['slug']      = 'スラッグ';
	
	$columns['author']    = $escape_author;
	$columns['date']      = $escape_date;
	
	return $columns;
}
add_filter( 'manage_pages_columns', 'manage_pages_columns' );


/*
 *  投稿時のタクソノミーの表示順序を変更
 */
function add_page_column( $column_name, $post_id ) {
	
	if( 'slug' == $column_name ) {
		
		$post = get_post($post_id);
		$slug = $post->post_name;
		
		echo attribute_escape($slug);
		
	} elseif( 'pagetitle' == $column_name ) {
		
		$pagetitle = get_post_meta( $post_id, 'pdc-page-title', true );
		
		echo esc_html( $pagetitle );
		
	}
	
}
add_action( 'manage_pages_custom_column', 'add_page_column', 10, 2);


/*
 *  PRE GET POSTS
 */
//--------------------------------------------------------
// PRE_GET_POSTS
//--------------------------------------------------------
function custom_pre_get_posts( $query ) {

	if ( ! is_admin() ) {
		
		if ( is_user_logged_in() ) {
			
			//echo 'Do function.';
			
			$query->set( 'post_status', array( 'pending', 'draft', 'private', 'publish' ) );
			
		}

		if ( $query->is_search() ) {
			
		} elseif ( ( $query->is_front_page() || $query->is_home() ) ) {
			
			//echo 'Front Page or Home Page';
		
		} elseif ( $query->is_category() ) {
			
			//echo 'Category';
			
		} elseif ( $query->is_archive() ) {
			
			if ( 'news' == $query->query_vars['post_type'] ) {
				
				$query->set( 'posts_per_page', 5 );
				//var_dump( get_query_var( 'nowmodel_category' ) );
				
			} elseif ( 'oldmodel' == $query->query_vars['post_type'] ) {
				
				$query->set( 'old_category', get_query_var('oldmodel_category') );
				//var_dump( get_query_var( 'oldmodel_category' ) );
				
			}
			
		} elseif ( $query->is_single() ) {
			
			
			
		}
		
	}
	
	//echo '<pre>'; var_dump( $query->query_vars['post_type'] ); echo '</pre>';
	//echo '<pre>'; var_dump( $query ); echo '</pre>';
	
	return $query;
	
}
add_action( 'pre_get_posts', 'custom_pre_get_posts' );







