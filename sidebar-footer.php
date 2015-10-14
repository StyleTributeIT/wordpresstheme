<?php $admin_email = get_bloginfo('admin_email') ? get_bloginfo('admin_email') : 'support@' . $_SERVER['SERVER_NAME']; ?>
<?php if ( is_active_sidebar( 'footer' ) ) : ?>
	<?php dynamic_sidebar( 'footer' ); ?>
	<div class="block payments-info text-center col-md-6">
<?php else: ?>
	<div class="block payments-info text-center col-md-9">
<?php endif; ?>
	<div class="content">
		<?php wp_nav_menu( array( 'theme_location' => 'social', 'menu_class' => 'social-links' ) ); ?>
		<h2><?php printf(__('We accept payments via', 'st')); ?></h2>
		<p>
			<img src="<?php echo get_template_directory_uri(); ?>/images/payments/visa.png" height="27" width="39" alt="Visa" />
			<img src="<?php echo get_template_directory_uri(); ?>/images/payments/master-card.png" height="27" width="44" alt="Master Card" />
			<img src="<?php echo get_template_directory_uri(); ?>/images/payments/discover.png" height="27" width="39" alt="Discover" />
			<img src="<?php echo get_template_directory_uri(); ?>/images/payments/american-express.png" height="26" width="43" alt="American Express" />
			<img src="<?php echo get_template_directory_uri(); ?>/images/payments/paypal.png" height="27" width="71" alt="Pay Pal" />
		</p>
		<p><?php printf(__('ALL COPYRIGHTS RESERVED %s', 'st'), '&copy; StyleTribute'); ?></p>
	</div>
</div>
<div class="block block-subscribe text-center col-md-3">
	<nav id="secondary-navigation" class="site-navigation secondary-navigation" role="navigation">
		<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'nav-menu' ) ); ?>
	</nav>
	<?php
		require_once('inc/footer_subscribe_form.php');
	?>
</div>
