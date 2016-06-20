<?php
/*
 * ログイン画面カスタマイズ
 */

function custom_wp_login() {
	
echo <<<Eof
<style>
html,
body.login {
	/* ページの背景色 */
	background: #ecfada;
}

.login h1 a {
	/* ロゴ画像のサイズ指定 */
	width: 100%;
	height: 253px;
	background-size: 200px 253px;
}
/* 枠外の文字スタイルを変更 */
.login #backtoblog a,
.login #nav a {
	/*color: #FFF;*/
}

.login #backtoblog a:hover,
.login #nav a:hover {
	/*color: #fbbe2c;*/
}
/* ここまで */
.login .message,
.login form {
	/* 枠の背景色 */
	/*background-color: #FFF;*/
}

#login {
	padding-top: 3%;
}
</style>
Eof;
	
}
add_action ( 'login_head', 'custom_wp_login' );


