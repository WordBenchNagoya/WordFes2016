<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package WordFes Nagoya 2015
 */

?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<?php
if ( is_front_page() ) {
	
	$title = 'WordFes Nagoya 2016 | WordPress の森に集おう！';
	
} else {
	
	$title = get_the_title() . ' | WordFes Nagoya 2016'; 
	
}
?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:title" content="<?php echo esc_attr( $title ); ?>" /><!-- 必須 -->
<meta property="og:type" content="website" /><!-- 必須 -->
<meta property="og:description" content="名古屋の夏と言えば WordFes Nagoya 2016 今年もやります。" />
<meta property="og:url" content="<?php echo esc_url( home_url('/') ); ?>" /><!-- 必須 -->
<meta property="og:image" content="<?php echo esc_url( home_url('/og_image.png') ); ?>" /><!-- 必須 -->
<meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
<title><?php echo esc_html( $title ); ?></title>
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/vnd.microsoft.icon" />
<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/vnd.microsoft.icon" />
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body id="<?php echo esc_attr( pdc_get_page_slug() ); ?>" <?php body_class(); ?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.4";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="page">

	<header class="site-header">
		
		<?php
		if ( is_front_page() ) {
			
			get_template_part( 'parts/header', 'home' );
			
		} else {
			
			get_template_part( 'parts/header', 'page' );
			
		}
		?>

		<nav id="site-navigation">
			
			<div class="navigation-menu" class="text-center">
				
				<ul class="clearfix text-center">
					<li class="col-md-2 col-xs-12">
						<a href="<?php echo esc_url( home_url('/') ); ?>">
							<img class="swap" src="<?php echo get_template_directory_uri(); ?>/images/navigation/nav-home.png" alt="トップ">
						</a>
					</li>
					<li class="col-md-2 col-xs-12">
						<a href="<?php echo esc_url( home_url('/about') ); ?>">
							<img class="swap" src="<?php echo get_template_directory_uri(); ?>/images/navigation/nav-about.png" alt="開催概要">
						</a>
					</li>
					<li class="col-md-2 col-xs-12">
						<!-- <a href="<?php echo esc_url( home_url('/timetable') ); ?>"> -->
							<img class="swap" src="<?php echo get_template_directory_uri(); ?>/images/navigation/nav-timetable.png" alt="タイムテーブル">
						<!-- </a> -->
					</li>
					<li class="col-md-2 col-xs-12">
						<a href="<?php echo esc_url( home_url('/access') ); ?>">
							<img class="swap" src="<?php echo get_template_directory_uri(); ?>/images/navigation/nav-access.png" alt="アクセス">
						</a>
					</li>
					<li class="col-md-2 col-xs-12">
						<a href="<?php echo esc_url( home_url('/supporter') ); ?>">
							<img class="swap" src="<?php echo get_template_directory_uri(); ?>/images/navigation/nav-supporter.png" alt="サポーター">
						</a>
					</li>
					<li class="col-md-2 col-xs-12">
						<a href="<?php echo esc_url( home_url('/entry') ); ?>">
							<img class="swap" src="<?php echo get_template_directory_uri(); ?>/images/navigation/nav-entry.png" alt="参加申込">
						</a>
					</li>
				</ul>
				
			</div>
			
		</nav><!-- #site-navigation -->
		
	</header><!-- #masthead -->

	<div id="content" class="site-content">