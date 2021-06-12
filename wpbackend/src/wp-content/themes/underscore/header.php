<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package underscore
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> class="dark">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>

</head>

<body <?php body_class('body dark-mode'); ?>>
<?php wp_body_open(); ?>

	<nav id="masthead" class="section site-header">
		<div class="container">
			<div class="site-branding">
					<?php
					the_custom_logo(); ?>
					<p class="site-title hide"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
					$underscore_description = get_bloginfo( 'description', 'display' );
					if ( $underscore_description || is_customize_preview() ) :
						?>
						<p class="site-description hide"><?php echo $underscore_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
					<?php endif; ?>
				</div><!-- .site-branding -->
				
				<!--div id="site-navigation" class="main-navigation"-->
					<button
							aria-controls="primary-menu" aria-expanded="false"
							id="nav-toggle"
							class="nav-toogle"
						>
							<svg
							class="fill-current h-3 w-3"
							viewBox="0 0 20 20"
							xmlns="http://www.w3.org/2000/svg"
							>
							<title><?php esc_html_e( 'Menu', 'underscore' ); ?></title>
							<path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
							</svg>
						</button>
					<?php
					wp_nav_menu(
						array(
							'container_class' => 'main-navigation',
							'container_id' => 'site-navigation',
							'theme_location' => 'menu-1',
							'menu_id'        => 'nav-menu',
						)
					);
					?>
				<!--/div--><!-- #site-navigation -->
		</div>
		
	</nav><!-- #masthead -->
