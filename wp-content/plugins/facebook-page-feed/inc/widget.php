<?php
class vb_facebook_page_feed extends WP_Widget {

    /** constructor -- name this the same as the class above */
    function vb_facebook_page_feed() {
        parent::WP_Widget(false, $name = 'Facebook Page Feed');    
    }
 
    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) { 
        extract( $args );
        $title   = apply_filters('widget_title', $instance['title']);
        $pageid  = intval( $instance['pageid'] );
        $items   = intval( $instance['items'] );
        $pageurl = $instance['pageurl'];
        $show_title = empty( $instance['show_title'] ) ? 0 : 1;
        $show_desc = empty( $instance['show_desc'] ) ? 0 : 1;
        $show_date = empty( $instance['show_date'] ) ? 0 : 1;
        $show_like = empty( $instance['show_like'] ) ? 0 : 1;
        $link_post = empty( $instance['link_post'] ) ? 0 : 1;
        $link_blank =  empty( $instance['link_blank'] ) ? 0 : 1;

        include_once( ABSPATH . WPINC . '/feed.php' );

        // Get a SimplePie feed object from the specified feed source.
        $rss = fetch_feed( 'https://www.facebook.com/feeds/page.php?format=rss20&id=' . $pageid );


        if ( ! is_wp_error( $rss ) ) : // Checks that the object is created correctly

            // Figure out how many total items there are, but limit it to 5.
            $maxitems = $rss->get_item_quantity( $items );

            // Build an array of all the items, starting with element 0 (first element).
            $rss_items = $rss->get_items( 0, $maxitems );

        endif;
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
                                <?php if ( $maxitems == 0 || $pageid == 0 ) : ?>
                                    <p><?php _e( 'No items or bad page ID', 'vb_fbfeed_widget' ); ?></p>
                                <?php else : ?>
                                    <?php // Loop through each feed item and display each item as a hyperlink. ?>
                                    <ul id="fbpf_widget">
                                      <?php if( $show_like && $pageurl ): ?>
                                      <li class="share_button">
                                        <iframe src="//www.facebook.com/plugins/like.php?href=<?php echo $pageurl; ?>&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;" allowTransparency="true"></iframe>
                                      </li>
                                    <?php elseif( $show_like && empty( $pageurl ) ): ?>
                                      <p><?php _e('You need to enter page URL to enable Like button', 'vb_fbfeed_widget' ) ?></p>
                                    <?php endif; ?>
                                    <?php foreach ( $rss_items as $item ) :

                                    $item_title  = esc_html( $item->get_title() );
                                    $item_link   = $item->get_permalink();
                                    $item_desc   = $item->get_description();
                                    $item_date   = $item->get_date('H:m d/m/Y');
                                    ?>
                                        <li>
                                          <?php if( $show_title ) echo '<span class="title">' . $item_title . '</span>'; ?>
                                          <?php if( $show_date ) echo '<small>' . $item_date . '</small>'; ?>
                                          <?php if( $show_desc ) echo '<span class="description">' . $item_desc . '</span>'; ?>
                                          <?php if( $link_post ): ?>
                                            <a href="<?php echo $item_link; ?>" <?php if( $link_blank ) echo 'target="_blank"'; ?> class="link"><?php _e( 'View on Facebook', 'vb_fbfeed_widget' ); ?></a>
                                          <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
              <?php echo $after_widget; ?>
        <?php
    }
 
    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {     
        $instance = $old_instance;
        $instance['title']   = strip_tags($new_instance['title']);
        $instance['pageid']  = strip_tags($new_instance['pageid']);
        $instance['items']   = strip_tags($new_instance['items']);
        $instance['pageurl'] = strip_tags( $new_instance['pageurl'] );
        $instance['show_title'] = strip_tags( $new_instance['show_title'] );
        $instance['show_desc'] = strip_tags( $new_instance['show_desc'] );
        $instance['show_date'] = strip_tags( $new_instance['show_date'] );
        $instance['show_like'] = strip_tags( $new_instance['show_like'] );
        $instance['link_post'] = strip_tags( $new_instance['link_post'] );
        $instance['link_blank'] = strip_tags( $new_instance['link_blank'] );
        return $instance;
    }

    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {

        $defaults = array(
            'title' => 'Facebook',
            'pageid' => '',
            'items' => 1,
            'pageurl' => '',
            'show_title' => 1,
            'show_desc' => 1,
            'show_date' => 0,
            'show_like' => 0,
            'link_post' => 1,
            'link_blank' => 1
            );
        $instance = wp_parse_args( (array) $instance, $defaults );
 
        $title   = esc_attr( $instance['title'] );
        $pageid  = intval( $instance['pageid'] );
        $items   = $instance['items'];
        $pageurl = $instance['pageurl'];
        $show_title = $instance['show_title'];
        $show_desc = $instance['show_desc'];
        $show_date = $instance['show_date'];
        $show_like = $instance['show_like'];
        $link_post = $instance['link_post'];
        $link_blank = $instance['link_blank'];
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'vb_fbfeed_widget' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
         <p>
          <label for="<?php echo $this->get_field_id('pageid'); ?>"><?php _e( 'Page ID:', 'vb_fbfeed_widget' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('pageid'); ?>" name="<?php echo $this->get_field_name('pageid'); ?>" type="text" value="<?php echo $pageid; ?>" />
        </p>
         <p>
          <label for="<?php echo $this->get_field_id('pageurl'); ?>"><?php _e( 'Page URL:', 'vb_fbfeed_widget' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('pageurl'); ?>" name="<?php echo $this->get_field_name('pageurl'); ?>" type="text" value="<?php echo $pageurl; ?>" />
        </p>         <p>
          <label for="<?php echo $this->get_field_id('items'); ?>"><?php _e( 'Number of items:', 'vb_fbfeed_widget' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo $items; ?>" />
        </p>
        <p><input name="<?php echo $this->get_field_name( 'show_title' ); ?>" type="checkbox" <?php checked( $show_title, 'on' ); ?> /> Show Title</p>
        <p><input name="<?php echo $this->get_field_name( 'show_desc' ); ?>" type="checkbox" <?php checked( $show_desc, 'on' ); ?> /> Show Description</p>
        <p><input name="<?php echo $this->get_field_name( 'show_date' ); ?>" type="checkbox" <?php checked( $show_date, 'on' ); ?> /> Show Time &amp; Date</p>
        <p><input name="<?php echo $this->get_field_name( 'show_like' ); ?>" type="checkbox" <?php checked( $show_like, 'on' ); ?> /> Show Like button</p>
        <p><input name="<?php echo $this->get_field_name( 'link_post' ); ?>" type="checkbox" <?php checked( $link_post, 'on' ); ?> /> Link to post</p>
        <p><input name="<?php echo $this->get_field_name( 'link_blank' ); ?>" type="checkbox" <?php checked( $link_blank, 'on' ); ?> /> Open links in new tab</p>
        <?php 
    }
 
 
} // end class 
add_action('widgets_init', create_function('', 'return register_widget("vb_facebook_page_feed");'));
