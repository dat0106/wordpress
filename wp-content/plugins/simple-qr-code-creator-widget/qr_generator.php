<?php
/*
Plugin Name: Simple QR Code Creator Widget
Plugin URI: http://www.sailabs.co/products/simple-qr-code-creator-widget/
Description: A widget that allows users to create URL, Message, and Contact Information QR-codes. Purchase extended version to remove watermark and allow tracking.
Version: 1.1.3
Author: Richard Royal
Author URI: http://www.sailabs.co/products/simple-qr-code-creator-widget/
License: GPL2
*/
?>
<?php


// register javascript, ensure jQuery queued
function wpqrjs_init_method() {
	if(!is_admin()){
		wp_register_script('custom_qr',WP_PLUGIN_URL.'/simple-qr-code-creator-widget/custom.js',array('jquery'),'1.0');
		wp_enqueue_script('custom_qr');
	}
}add_action('init', 'wpqrjs_init_method');

// register stylesheet
function wpqrin_stylesheet() {
	$myStyleUrl = WP_PLUGIN_URL . '/simple-qr-code-creator-widget/style.css';
	$myStyleFile = WP_PLUGIN_DIR . '/simple-qr-code-creator-widget/style.css';
	if ( file_exists($myStyleFile) ) {
		wp_register_style('myStyleSheets', $myStyleUrl);
		wp_enqueue_style( 'myStyleSheets');
	}
}add_action('wp_print_styles', 'wpqrin_stylesheet');


/* Form for 'In Content' generator */
function getQRForm(){
	$wpqr_out = WP_PLUGIN_URL.'/simple-qr-code-creator-widget/qrcode.php';
	$inForm = '
	<div id="incontentqrgen">
	<div id="wpqr_gen">

	<form name="qrin_form" id="qrin_form" method="post" action="">
		<div id="qrselect">
			Type:
			<select id="qrtype" name="qrtype">
				<option value="buscardqr">Business Card</option>
				<option value="urlqr">URL</option>
				<option value="messageqr">Message</option>
			</select>
		</div>

		<div id="buscardqrid">
			<p>Name:<br /><input type="text" name="flname" id="flname" class="in_box" value="" size="28" /></p>
			<p>Company Name:<br /><input type="text" name="org" id="org" class="in_box" value="" size="28"  /></p>
			<p>Telephone:<br /><input type="text" name="phone" id="phone" class="in_box" value="" size="28" /></p>
			<p>Work Address:<br /><input type="text" name="addr" id="addr" class="in_box" value="" size="28" /></p>
			<p>City:<br /><input type="text" name="city" id="city" class="in_box" value="" size="28"  /></p>
			<p>State, ZIP Code:<br /><input type="text" name="state" id="state" class="in_box" value="" /></p>
			<p>Email Address<br /><input type="text" name="email" id="email" class="in_box" value="" size="28" /></p>
			<p>Website<br /><input type="text" name="website" id="website" class="in_box" value="" size="28" /></p>
			<p>Memo<br /><input type="text" name="notes" id="notes" class="in_box" value="" size="28" /></p>
		</div>

		<div id="urlqrid">
			<p>URL<br /><input type="text" id="qrurl" name="qrurl" class="in_box" value="" size="28" /></p>
		</div>

		<div id="messageqrid">
			<p>Message<br /><textarea id="qrmessage" name="qrmessage" class="in_box" value="" size="28" ></textarea></p>
		</div>
		<p style="text-align:right"><input type="submit" name="wrqrin_submit" id="wrqrin_submit" value="Generate" /></p>
		<input type="hidden" id="wpqrin_addr" name="wpqrin_addr" value="'.$wpqr_out.'" />
		<input type="hidden" id="ip_address" name="ip_address" value="'.$_SERVER['REMOTE_ADDR'].'" />
	</form>
	<img id="qrimagescr" src="" border="none" />
	</div>
	</div>';

	return $inForm;
}

// Filter Content for string: [qr-code-generator]
function qrcode_filter($content) {
	return str_replace('[qr-code-generator]',getQRForm(),$content);
}
add_filter('the_content', 'qrcode_filter');


/* Widget Class */
class QR_Generator extends WP_Widget {

	/* Constructor */
	function QR_Generator() {

		/* Widget settings. */
		$widget_ops = array( 'classname' => 'QR_Generator', 'description' => __('A widget that allows users to create URL, Message, and Contact Information QR-codes.') );

		/* Create the widget. */
		$this->WP_Widget( 'QR_Generator', __('QR Generator'), $widget_ops, $control_ops );
	}

	/** @see WP_Widget::widget - displays widget */
	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? '&nbsp;' : $instance['title']);

		echo $before_widget;

		if ( $title ) { echo $before_title . $title . $after_title; }

		$wpqr_out = WP_PLUGIN_URL.'/simple-qr-code-creator-widget/qrcode.php';

		// input form
		$inForm = '
		<div id="wpqr_gen">

		<form name="qrin_form" id="qrin_form" method="post" action="">
			<div id="qrselect">
				Type:
				<select id="qrtype" name="qrtype">
					<option value="buscardqr">Business Card</option>
					<option value="urlqr">URL</option>
					<option value="messageqr">Message</option>
				</select>
			</div>

			<div id="buscardqrid">
				<p>Name:<br /><input type="text" name="flname" id="flname" class="in_box" value="" size="28" /></p>
				<p>Company Name:<br /><input type="text" name="org" id="org" class="in_box" value="" size="28"  /></p>
				<p>Telephone:<br /><input type="text" name="phone" id="phone" class="in_box" value="" size="28" /></p>
				<p>Work Address:<br /><input type="text" name="addr" id="addr" class="in_box" value="" size="28" /></p>
				<p>City:<br /><input type="text" name="city" id="city" class="in_box" value="" size="28"  /></p>
				<p>State, ZIP Code:<br /><input type="text" name="state" id="state" class="in_box" value="" /></p>
				<p>Email Address<br /><input type="text" name="email" id="email" class="in_box" value="" size="28" /></p>
				<p>Website<br /><input type="text" name="website" id="website" class="in_box" value="" size="28" /></p>
				<p>Memo<br /><input type="text" name="notes" id="notes" class="in_box" value="" size="28" /></p>
			</div>

			<div id="urlqrid">
				<p>URL<br /><input type="text" id="qrurl" name="qrurl" class="in_box" value="" size="28" /></p>
			</div>

			<div id="messageqrid">
				<p>Message<br /><textarea id="qrmessage" name="qrmessage" class="in_box" value="" size="28" ></textarea></p>
			</div>
			<p style="text-align:right"><input type="submit" name="wrqrin_submit" id="wrqrin_submit" value="Generate" /></p>
			<input type="hidden" id="wpqrin_addr" name="wpqrin_addr" value="'.$wpqr_out.'" />
			<input type="hidden" id="ip_address" name="ip_address" value="'.$_SERVER['REMOTE_ADDR'].'" />
		</form>
		<img id="qrimagescr" src="" border="none" />
		</div>';
		echo $inForm;

		echo $after_widget;
	}	

	/** @see WP_Widget::update - Saves the widgets settings */
	function update($new_instance, $old_instance) {	

		$instance = $old_instance;
		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;

	}

	/** @see WP_Widget::form - Creates the edit form for the widget */
	function form($instance) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array('title'=>'') );
		$title 		= htmlspecialchars($instance['title']);
		# Output the options
		// Title
		echo '<p style="text-align:left;"><label for="' . $this->get_field_name('title') . '">' . __('Title:') . ' <br /><input style="width: 100%;" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></label></p>';
	}

}

// register QR Generator widget
add_action('widgets_init', create_function('', 'return register_widget("QR_Generator");'));
?>
