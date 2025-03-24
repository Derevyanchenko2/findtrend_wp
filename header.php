<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	
	<title>Findtrend</title>

	<?php wp_head(); ?>


</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div class="mobileMenu-overlay">
		<div class="mobileMenu">
			<button class="mobileMenu-close">&times;</button>
			<div class="mobileMenu-container">
				<?php
					wp_nav_menu([
						'theme_location' => 'burger_menu',
						'container' => 'nav',
						'menu_class' => 'header-menu menu',
					]);
				?>
			</div>
		</div>
	</div>
	<header class="header">
		<div class="container">
			<div class="header-wrapper">
			<a href="<?php echo esc_url(home_url('/')); ?>" class="logo header-logo header-logo--pc">
			<?php 
			if (has_custom_logo()) :
				the_custom_logo(); 
			else : ?>
				<img src="path/to/full-desktop-logo.png" alt="Full Desktop Logo" class="logo-desktop">
			<?php endif; ?>
		</a>

				 <?php
					wp_nav_menu([
						'theme_location' => 'header_menu',
						'container' => 'nav',
						'menu_class' => 'header-menu menu',
					]);
				?>

				<div class="header-links">
					<a class="register-link header-menu__link pricing-btn" href="#">Pricing</a>
				</div>
				<div class="burger open-menu-js">
					<div class="open-menu">
						<span></span>
						<span></span>
						<span></span>
					</div>
				</div>
			</div>
		</div>
	</header>