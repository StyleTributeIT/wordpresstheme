<!DOCTYPE html>
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
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title( '', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if gte IE 9]>
		<style type="text/css">
			.gradient {
				filter: none;
			}
		</style>
	<![endif]-->
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/contrib/js/html5.js"></script>
	<![endif]-->
	<link rel="icon" href="https://styletribute.com/media/favicon/default/favicon.jpg" type="image/x-icon" />
	<link rel="shortcut icon" href="https://styletribute.com/media/favicon/default/favicon.jpg" type="image/x-icon" />
	<?php wp_head(); ?>
	<link href="//cloud.typography.com/6525732/792846/css/fonts.css" rel="stylesheet" type="text/css">
</head>
<body <?php body_class(); ?>>
<div id="page">
	<header id="header" class="clearfix" role="banner">
		<div class="header-inner gradient white-grey clearfix">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<?php wp_nav_menu( array( 'theme_location' => 'social', 'menu_class' => 'social-links small' ) ); ?>
						<?php get_search_form(); ?>
					</div>
					<div class="text-center col-md-6">
						<div id="logo">
							<a href="/" rel="home">
								<img src="<?php echo get_template_directory_uri(); ?>/images/style_logo_min.svg" alt="<?php echo get_bloginfo('name'); ?>" width="209" height="61" />
							</a>
						</div>
					</div>
					<div class="action-menu col-md-3">
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<nav id="main-navigation" class="horizontal-nav clearfix" role="navigation">
						<a class="screen-reader-text skip-link" href="#content"><?php _e( 'Skip to content', 'st' ); ?></a>
						<?php wp_nav_menu( array( 'theme_location' => 'main', 'menu_class' => 'nav-menu' ) ); ?>
					</nav>
				</div>
			</div>
		</div>
	</header>
	<div id="main" class="clearfix">
