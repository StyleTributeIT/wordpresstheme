<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div id="content" class="site-content col-md-12" role="main">
			<?php if ( is_front_page() ) : ?>
				<?php if ( is_active_sidebar( 'region_front' ) ) : ?>
					<div id="region-front" class="region-front widget-area" role="complementary">
						<?php dynamic_sidebar( 'region_front' ); ?>
					</div>
				<?php endif; ?>
			<?php endif; ?>
			<div id="region-content" class="region region-content clearfix">
				<div class="row">
					<?php
						if (have_posts()):
							global $wp_query;
							while (have_posts()) : the_post();
								get_template_part('content', get_post_format());
								if (($wp_query->current_post+1)%3 == 0 && $wp_query->post_count != ($wp_query->current_post+1)):
					?>
									</div><div class="row">
					<?php
								endif;
							endwhile;
						else:
							get_template_part('content', 'none');
						endif;
					?>
				</div>
				<?php if ( ! is_front_page() ) st_paging_nav(); ?>
			</div>
			<div id="region-instagramm" class="region region-instagramm clearfix">
				<div class="row">
					<div class="block instfeed col-md-12 clearfix">
						<h2 class="block-title instagramm-ico">We're on instagram!<a href="http://instagram.com/styletribute/" rel="external" class="title_ico">Instagramm</a></h2>
						<div class="content">
							<?php echo do_shortcode('[instagram-feed]'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer();
