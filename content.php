<?php if (is_single()): ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
	<?php if (types_render_field("header-image")): ?>
		<div class="post-image">
			<?php
				echo types_render_field("header-image", array(
					'width' => '940',
					'resize' => 'proportional',
				));
			?>
		</div>
	<?php endif; ?>
	<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
		<div class="row post-content sep col-4">
			<div id="sidebar" class="sidebar col-md-4">
				<?php get_sidebar(); ?>
			</div>
			<div class="content col-md-8">
	<?php else: ?>
		<div class="row post-content">
			<div class="content col-md-12">
	<?php endif; ?>
			<?php the_content(); ?>
		</div>
	</div>

    <?php if ( is_active_sidebar( 'related_posts' ) ) : ?>
		<?php dynamic_sidebar( 'related_posts' ); ?>
	<?php endif; ?>
    <?php show_magento_products_by_tag(types_render_field("bottom-content")); ?>
	<?php if ( function_exists( 'types_render_field' ) ): ?>
		<?php if (types_render_field("side-quote") || types_render_field("bottom-content")): ?>
			<div class="row post-content sep col-4">
				<div class="side-quote col-md-4">
					<?php if (types_render_field("side-quote")): ?>
						<blockquote>
							<p>"<?php echo types_render_field("side-quote"); ?>"</p>
						</blockquote>
					<?php endif; ?>
				</div>
				<?php if (types_render_field("bottom-content")): ?>
					<div class="bottom-content col-md-8"><?php show_content_without_magento_products(types_render_field("bottom-content")); ?></div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<?php if (types_render_field("bottom-banner")): ?>
			<div class="row post-content">
				<div class="col-md-12"><?php echo types_render_field("bottom-banner", array('size' => 'banner')); ?></div>
			</div>
		<?php endif; ?>
	<?php endif; ?>
	<?php if ( is_active_sidebar( 'page_bottom' ) ) : ?>
		<?php dynamic_sidebar( 'page_bottom' ); ?>
		<?php if (types_render_field("videos")): ?>
			<div class="row post-content related-videos">
				<div class="col-md-12">
					<h2 class="block-title youtube-ico">Learn how to authenticate brands<a href="https://www.youtube.com/channel/UCkYAW0K9sNeKKWRSYuZT72g" rel="external" class="title_ico">Youtube</a></h2>
					<div class="row"><?php echo types_render_field("videos"); ?></div>
				</div>
			</div>
		<?php endif; ?>
	<?php endif; ?>
</article>
<?php else: ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if (has_post_thumbnail()): ?>
		<div class="post-thumbnail">
			<a href="<?php echo esc_url(get_permalink()); ?>"><?php the_post_thumbnail(); ?></a>
			<?php edit_post_link( __( 'Edit', 'st' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
	<?php endif; ?>
	<?php if (in_array('category', get_object_taxonomies(get_post_type()))) : ?>
		<div class="cat-links">
			<?php echo get_the_category_list( ', ' ); ?>
		</div>
	<?php endif; ?>
	<?php the_title( '<h2 class="post-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>' ); ?>
</article>
<?php endif; ?>
