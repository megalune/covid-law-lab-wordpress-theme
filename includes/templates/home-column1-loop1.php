<li class="first"> 





	<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('home-column1-thumb', array('class' => 'entry-thumb')); ?></a>
	
	<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'themejunkie' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	
	<div class="entry-meta">
		<abbr title="<?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?>"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . __(' ago', 'themejunkie'); ?></abbr> <span class="entry-sep">|</span> <span class="entry-comment"><?php comments_popup_link( __( '0 comment', 'themejunkie' ), __( '1 comment', 'themejunkie' ), __( '% comments', 'themejunkie' ) ); ?></span>
	</div><!-- end .entry-meta -->
	
	<div class="clear"></div>
	
	<div class="entry-excerpt">
		<?php tj_content_limit('145'); ?>
	</div><!--end .entry-excerpt-->
	
</li>