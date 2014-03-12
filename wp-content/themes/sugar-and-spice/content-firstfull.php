<?php
/**
 * @package Sugar & Spice
 */
?>

<?php

// Display first post on Home Page in full, rest as excerpts
if( is_home() && !is_paged() && ($posts[0] == $post) ) :

?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('firstfull'); ?>>
        <header class="entry-header">
            <h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

            <div class="entry-meta">
                <?php sugarspice_posted_on(); ?>
            </div><!-- .entry-meta -->
        </header><!-- .entry-header -->

        <div class="entry-content">
            <?php the_content(); ?>
        </div><!-- .entry-content -->

        <footer class="entry-meta bottom">
            <?php
                /* translators: used between list items, there is a space after the comma */
                $category_list = get_the_category_list( __( ', ', 'sugarspice' ) );

                /* translators: used between list items, there is a space after the comma */
                $tag_list = get_the_tag_list( '', __( ', ', 'sugarspice' ) );

                if ( ! sugarspice_categorized_blog() ) {
                    // This blog only has 1 category so we just need to worry about tags in the meta text
                    if ( '' != $tag_list ) {
                        $meta_text = __( 'This entry was tagged %2$s.', 'sugarspice' );
                    }

                } else {
                    // But this blog has loads of categories so we should probably display them here
                    if ( '' != $tag_list ) {
                        $meta_text = __( 'This entry was posted in %1$s and tagged %2$s.', 'sugarspice' );
                    } else {
                        $meta_text = __( 'This entry was posted in %1$s.', 'sugarspice' );
                    }

                } // end check for categories on this blog

                printf(
                    $meta_text,
                    $category_list,
                    $tag_list
                );
            ?>

        </footer><!-- .entry-meta -->
    </article><!-- #post-## -->
<?php
else :
    get_template_part( 'content', 'loop' );
endif;
