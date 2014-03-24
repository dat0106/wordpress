<?php
/*
Plugin Name: Custom Image Widget
Plugin URI: http://hackgame4u.com
Description: custome image for safe and secure widget item.
Author: LeDat
Version: 1.0
Author URI: http://google.com
*/

/**
 * Tạo class image_Widget
 */
class Custom_Image_Widget extends WP_Widget {

    /**
     * Thiết lập widget: đặt tên, base ID
     */
    function Custom_Image_Widget() {
        $tpwidget_options = array(
            'classname' => 'image_widget_class', //ID của widget
            'description' => 'Mô tả của widget'
        );
        $this->WP_Widget('custom_image_widget_id', 'Custom Image Widget', $tpwidget_options);
    }

    /**
     * Tạo form option cho widget
     */
    function form( $instance ) {

        //Biến tạo các giá trị mặc định trong form
        $default = array(
            'title' => 'Tiêu đề widget'
        );

        //Gộp các giá trị trong mảng $default vào biến $instance để nó trở thành các giá trị mặc định
        $instance = wp_parse_args( (array) $instance, $default);

        //Tạo biến riêng cho giá trị mặc định trong mảng $default
        $title = esc_attr( $instance['title'] );

        //Hiển thị form trong option của widget
        echo "<p>Nhập tiêu đề <input type='text' class='widefat' name='".$this->get_field_name('title')."' value='".$title."' /></p>";


    }

    /**
     * save widget form
     */

    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    /**
     * Show widget
     */

    function widget( $args, $instance ) {

        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );

        echo $before_widget;

        //In tiêu đề widget
        echo $before_title.$title.$after_title;



        // Nội dung trong widget

        ?><a href="http://sitecheck2.sucuri.net/results/<?php echo home_url();?>">
        <center><img src="<?php echo home_url();?>/images/safe-and-secured.png" style="width: 200px;height: 200px;"></center>
        <center><img src="<?php echo home_url();?>/images/blueseal-blueribbon-large.png" style="width: 255px;height: 200px;"></center></a>
        <?php
        // Kết thúc nội dung trong widget

        echo $after_widget;
    }

}

/*
 * Khởi tạo widget item
 */
add_action( 'widgets_init', 'create_image_widget' );
function create_image_widget() {
    register_widget('Custom_Image_Widget');
}