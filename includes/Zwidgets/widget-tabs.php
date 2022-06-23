<?php
/**
 * Theme Junkie Tabs Widget
 */
 
class TJ_Widget_Tabs extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_tab', 'description' => __('Display an Ajax tabber with Popular Posts, Latest Posts, Recent Comments and Tags.'));
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('tab', __('ThemeJunkie - Tabs'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$popular_post_num = $instance['popular_post_num'];
		$recent_post_num = $instance['recent_post_num'];
		$recent_comment_num = $instance['recent_comment_num'];
		$avatar_size = $instance['avatar_size'];
		?>

	<div id="tabber">
			
		<ul class="tabs">
			<li><a href="#popular-posts"><?php _e('Popular', 'themejunkie'); ?></a></li>
			<li><a href="#recent-posts"><?php _e('Latest', 'themejunkie'); ?></a></li>
	        <li><a href="#recent-comments"><?php _e('Comments', 'themejunkie'); ?></a></li>
			<li><a href="#tag-cloud" class="border-right-none"><?php _e('Tags', 'themejunkie'); ?></a></li>
		</ul> <!--end .tabs-->
			
		<div class="clear"></div>
		
		<div class="inside">
		
			<div id="popular-posts">
				<ul>
					<?php rewind_posts(); ?>
					<?php tj_tabs_popular($popular_post_num); ?>
				</ul>			
		    </div> <!--end #popular-posts-->
		       
		    <div id="recent-posts"> 
		        <ul>
					<?php tj_tabs_latest($recent_post_num); ?>                      
				</ul>	
		    </div> <!--end #recent-posts-->
		    
		    <div id="recent-comments">  
				<ul>
					<?php tj_tabs_comments($recent_comment_num, $avatar_size); ?>                    
				</ul>
		    </div> <!--end #recent-comments-->
		      
			<div id="tag-cloud">
				<?php wp_tag_cloud('smallest=12&largest=20'); ?>
			</div> <!--end #tag-cloud-->
			
			<div class="clear"></div>
			
		</div> <!--end .inside -->
		
		<div class="clear"></div>
		
	</div><!--end #tabber -->

		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['popular_post_num'] = $new_instance['popular_post_num'];
		$instance['recent_post_num'] =  $new_instance['recent_post_num'];
		$instance['recent_comment_num'] =  $new_instance['recent_comment_num'];
		$instance['avatar_size'] =  $new_instance['avatar_size'];
		return $instance;
	}

	function form( $instance ) { 
		$instance = wp_parse_args( (array) $instance, array( 'popular_post_num' => '5', 'recent_post_num' => '5', 'recent_comment_num' => '5', 'avatar_size' => '42' ) );
		$popular_post_num = $instance['popular_post_num'];
		$recent_post_num = format_to_edit($instance['recent_post_num']);
		$recent_comment_num = format_to_edit($instance['recent_comment_num']);
		$avatar_size = format_to_edit($instance['avatar_size']);
	?>
		<p><label for="<?php echo $this->get_field_id('popular_post_num'); ?>"><?php _e('Number of popular posts to show::'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('popular_post_num'); ?>" name="<?php echo $this->get_field_name('popular_post_num'); ?>" type="text" value="<?php echo $popular_post_num; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('recent_post_num'); ?>"><?php _e('Number of latest posts to show:'); ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id('recent_post_num'); ?>" name="<?php echo $this->get_field_name('recent_post_num'); ?>" value="<?php echo $recent_post_num; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('recent_comment_num'); ?>"><?php _e('Number of recent comments to show:'); ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('recent_comment_num'); ?>" value="<?php echo $recent_comment_num; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('avatar_size'); ?>"><?php _e('Avatar size: e.g. 42'); ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id('avatar_size'); ?>" name="<?php echo $this->get_field_name('avatar_size'); ?>" value="<?php echo $avatar_size; ?>" /></p>
	<?php }
}

register_widget('TJ_Widget_Tabs');

?>