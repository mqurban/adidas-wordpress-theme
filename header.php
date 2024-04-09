<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package figma-wordpress-theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header>
		<!-- TOP TEXT  -->

		<div id="top-text" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="d-flex justify-content-between align-items-center">
				<div class="toast-body">
					<?php

					$general_options = get_option('general-settings');

					$top_text = $general_options['top-text'];
					$top_link = $general_options['top-link'];
					echo $top_text;
					?>
					<a href="<?php echo $top_link ?>"> WATCH NOW</a>
				</div>
				<button id="closeBtn" type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
			</div>
		</div>


		<!-- TOP BAR -->
		<div id="top-bar">


			<div id="top-bar-left">
				<img src="<?php echo get_theme_file_uri('/assets/images/logo.svg') ?>" alt="logo" />
			</div>


			<div id="top-bar-right">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'secondary',
					)
				);
				?>
			</div>


		</div>

		<!-- Navigation menu with search bar on right side -->
		<div id="nav-bar">
			<div>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
					)
				);
				?>
			</div>
			<div id="nav-bar-right">
				<form action="">
					<div class="search-container">
						<input type="text" placeholder="Search" name="search">
						<button type="submit"><i class="fas fa-search"></i></button>
					</div>
				</form>
			</div>
	</header>