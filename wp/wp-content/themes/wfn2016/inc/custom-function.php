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
	
	return $result;
	
}


/*
 *  ページネームを取得
 */
function pdc_get_page_name() {
	
	global $post;
	
	return $post->post_title;
	
}

/*
 *  ページＩＤを取得
 */
function pdc_get_page_id() {
	
	global $post;
	
	return $post->post_name;
	
}

