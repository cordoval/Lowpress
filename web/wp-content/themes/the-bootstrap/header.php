<?php
/** header.php
 *
 * Displays all of the <head> section and everything up till </header>
 *
 * @author		Konstantin Obenland
 * @package		The Bootstrap
 * @since		1.0 - 05.02.2012
 */

?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
	<head>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<title><?php wp_title( '&laquo;', true, 'right' ); ?></title>

		<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
		<![endif]-->

		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
    <?php
    global $kernel;
    die(get_class($kernel));
    ?>

		<div class="container">
			<div id="page" class="hfeed row">
				<header id="branding" role="banner" class="span12">
					<?php wp_nav_menu( array(
						'container'			=>	'nav',
						'container_class'	=>	'subnav clearfix',
						'theme_location'	=>	'header-menu',
						'menu_class'		=>	'nav nav-pills pull-right',
						'depth'				=>	1,
						'fallback_cb'		=>	false
					) ); ?>
					<hgroup>
						<h1 id="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
								<span><?php bloginfo( 'name' ); ?></span>
							</a>
						</h1>
						<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
					</hgroup>
					<?php if ( get_header_image() ) : ?>
					<a id="header-image" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
					</a>
					<?php endif; // if ( get_header_image() ) ?>
					<nav id="access" role="navigation">
						<h3 class="assistive-text"><?php _e( 'Main menu', 'the-bootstrap' ); ?></h3>
						<div class="skip-link"><a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to primary content', 'the-bootstrap' ); ?>"><?php _e( 'Skip to primary content', 'the-bootstrap' ); ?></a></div>
						<div class="skip-link"><a class="assistive-text" href="#secondary" title="<?php esc_attr_e( 'Skip to secondary content', 'the-bootstrap' ); ?>"><?php _e( 'Skip to secondary content', 'the-bootstrap' ); ?></a></div>
						<?php if ( has_nav_menu( 'primary' ) OR the_bootstrap_options()->navbar_site_name OR the_bootstrap_options()->navbar_searchform ) : ?>
						<div <?php the_bootstrap_navbar_class(); ?>>
							<div class="navbar-inner">
								<div class="container">
									<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
									<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</a>
									<?php if ( the_bootstrap_options()->navbar_site_name ) : ?>
									<span class="brand"><?php bloginfo( 'name' ); ?></span>
									<?php endif;?>
									<div class="nav-collapse">
										<?php wp_nav_menu( array(
											'theme_location'	=>	'primary',
											'menu_class'		=>	'nav',
											'depth'				=>	2,
											'fallback_cb'		=>	false,
										) );
										if ( the_bootstrap_options()->navbar_searchform ) : ?>
									    <form id="searchform" class="navbar-search pull-right" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
									    	<label for="s" class="assistive-text hidden"><?php _e( 'Search', 'the-bootstrap' ); ?></label>
									    	<input type="search" class="search-query" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'the-bootstrap' ); ?>" />
									    </form>
									    <?php endif; ?>
								    </div>
								</div>
							</div>
						</div>
						<?php endif; ?>
					</nav><!-- #access -->
					<?php if ( function_exists( 'yoast_breadcrumb' ) ) {
						yoast_breadcrumb( '<nav id="breadcrumb" class="breadcrumb">', '</nav>' );
					} ?>
				</header><!-- #branding --><?php


/* End of file header.php */
/* Location: ./wp-content/themes/the-bootstrap/header.php */