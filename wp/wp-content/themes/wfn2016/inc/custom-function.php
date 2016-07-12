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
	
	global $post;
	
	//$page = get_page_by_path( get_query_var('pagename') );
	$page = get_post( $post->ID );
	
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
	
	//echo '<pre style="z-index: 999; background: #fff;">'; var_dump( $page ); echo '</pre>';
	
	return $page->post_title;
	
}

/*
 *  ページＩＤを取得
 */
function pdc_get_page_slug() {
	
	$page = pdc_get_page();
	
	//echo '<!-- <pre style="z-index: 999; background: #fff;">'; var_dump( $page ); echo '</pre> -->';

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


//--------------------------------------------------------
// 投稿一覧で表示する項目をカスタマイズ
//--------------------------------------------------------
function manage_posts_columns($columns) {
	unset($columns['tags']);
	unset($columns['comments']);
	
	global $post;
	
	if ( 'supporter' == $post->post_type ) { // ポストタイプを指定
	
		$date_escape = $columns['date']; // 日付を避難
		$author_escape = $columns['author']; // 投稿者を退避
		$type_escape   = $columns['supporter_type'];
		$option_escape = $columns['supporter_option'];
		
		unset($columns['date']); // 消す
		unset($columns['author']); // 消す
		unset($columns['supporter_type']);
		unset($columns['supporter_option']);
		
		$columns['display'] = '表示';
		
		$columns['author']  = $author_escape; // ここで投稿者を戻す
		$columns['date']    = $date_escape; // ここで日付を戻す
		
	}
	
	return $columns;
}
add_filter( 'manage_posts_columns', 'manage_posts_columns' );


//--------------------------------------------------------
// 投稿一覧で追加項目の内容を表示する
//--------------------------------------------------------
function inside_district_column( $column_name ) {
	global $post;
	
	if ( 'supporter' == $post->post_type && 'display' == $column_name ) {

		$anonym = get_post_meta( $post->ID, 'pdc-supporter-anonym', true );
		
		//var_dump($myMetaValue);
		
		if ( true == $anonym ) {
			
			echo '匿名希望';
			
		} else {
			
			echo '';
			
		}
		
	}
	
}
add_action( 'manage_posts_custom_column', 'inside_district_column' );







