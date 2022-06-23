<?php
/**
 * Theme Junkie FeedBurner Widget
 */
 
class TJ_Widget_FeedBurner extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_feedburner', 'description' => __('FeedBurner Email Subscription'));
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('feedburner', __('ThemeJunkie - FeedBurner'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$feedburner_id = $instance['feedburner_id'];
		?>

	<div id="newsletter">
	
	<div class="subscribe">	
	 <h3 class="widget-title"><?php _e('E-mail Newsletter', 'themejunkie'); ?></h3>
	 <p><?php _e('Complete the form below, and we\'ll send you an e-mail every now and again with all latest news.', 'themejunkie'); ?></p>
	 
 		<form class="subscribe-form" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feedburner_id; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
			<input class="email" type="text" name="email" value="E-mail" onfocus="if (this.value == 'E-mail') {this.value = '';}" onblur="if (this.value == '') {this.value = 'E-mail';}" />

			<input type="hidden" value="<?php echo $feedburner_id; ?>" name="uri"/>
			<input type="hidden" value="<?php echo $feedburner_id; ?>" name="title"/>
			<input type="hidden" name="loc" value="en_US"/>
			<input class="submit" type="submit" name="submit" value="Submit" />
		</form>
		<span><?php _e('Delivered by', 'themejunkie'); ?> <a href="http://feedburner.google.com/" target="_blank"><?php _e('Feedburner', 'themejunkie'); ?></a></span>
		</div>			
	</div>	

		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['feedburner_id'] = $new_instance['feedburner_id'];
		return $instance;
	}

	function form( $instance ) { 
		$instance = wp_parse_args( (array) $instance, array( 'feedburner_id' => 'themejunkie' ) );
		$feedburner_id = $instance['feedburner_id'];	
	?>
		<p><label for="<?php echo $this->get_field_id('feedburner_id'); ?>"><?php _e('Enter your Feedburner ID:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('feedburner_id'); ?>" name="<?php echo $this->get_field_name('feedburner_id'); ?>" type="text" value="<?php echo $feedburner_id; ?>" /></p>
		
		<?php }
}

register_widget('TJ_Widget_FeedBurner');

