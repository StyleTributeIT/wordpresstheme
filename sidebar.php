<div class="block post-info clearfix">
	<div class="info-item">
		<span class="post-date"><?php echo get_post_time( "d M `y", true, $post->ID, true ); ?></span>
		<?php if (in_array('category', get_object_taxonomies(get_post_type()))) : ?>
			<span class="post-category">| <?php echo get_the_category_list( ', ' ); ?></span>
		<?php endif; ?>
	</div>
	<div class="info-item">
		<span class="post-author">Written by : <?php echo types_render_field("author"); ?></span>
	</div>
	<div class="info-item">
		<span class="post-share-title">Share this article</span>
		<span class="post-share">
			<ul class="social-links">
				<li class="facebook-like"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php urlencode(the_permalink()); ?>" target="_blank" rel="nofollow">facebook like</a></li>
				<li class="tweet"><a href="https://twitter.com/home?status=<?php urlencode(the_permalink()); ?> <?php urlencode(the_title()); ?>" target="_blank" rel="nofollow">tweet</a></li>
				<li class="bookmark"><a href="javascript:void(0);" onClick="styleTribute.bookmark(this);" rel="nofollow" title="<?php the_title(); ?>">bookmark</a></li>
			</ul>
		</span>
	</div>
</div>
<?php dynamic_sidebar( 'sidebar' ); ?>
