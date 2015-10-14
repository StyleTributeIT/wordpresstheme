<form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div>
		<label class="screen-reader-text" for="s"><?php echo _x( 'Search for:', 'label' ); ?></label>
		<input type="text" value="<?php echo (get_search_query()) ? get_search_query() : 'SEARCH'; ?>" name="s" id="s" onfocus="if (this.value == 'SEARCH') {this.value = '';}" onblur="if (this.value == '') {this.value = 'SEARCH';}" />
		<input type="submit" id="searchsubmit" value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?>" />
	</div>
</form>
