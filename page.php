<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div class="container">
	<div class="row">
		<div id="content" class="site-content col-md-12" role="main">
			<div id="region-content" class="region region-content clearfix">
				<div class="row">
					<?php
						// Start the Loop.
						while ( have_posts() ) : the_post();

							// Include the page content template.
							get_template_part( 'content', 'page' );

							// If comments are open or we have at least one comment, load up the comment template.
							// if ( comments_open() || get_comments_number() ) {
							// 	comments_template();
							// }
						endwhile;
					?>
				</div>
			</div>
			<div id="region-instagramm" class="region region-instagramm clearfix">
				<div class="row">
					<div class="block instfeed col-md-12 clearfix">
						<h2 class="block-title instagramm-ico">We're on instagram!</h2>
						<div class="content">
							<?php echo do_shortcode('[instagram-feed]'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
get_footer();
