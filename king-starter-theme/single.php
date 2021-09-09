<?php get_header(); ?>
<section class="main_cc container">
    <div class="row">
        <section class="main_cc_text col-md-8" role="main">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
                        <h1><?php the_title(); ?></h1>
                        <?php //include (TEMPLATEPATH . '/inc/meta.php' ); 
                        ?>
                        <div class="entry">
                            <?php the_content(); ?>
                            <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
                            <?php the_tags('Tags: ', ', ', ''); ?>
                            <?php include(TEMPLATEPATH . '/inc/post_sharer.php'); ?>
                        </div>
                        <?php edit_post_link('Edit this entry', '', '.'); ?>
                    </article>
                    <?php //comments_template(); 
                    ?>
            <?php endwhile;
            endif; ?>
        </section> <!-- .main_cc_text -->
        <aside class="main_sb col-md-4" role="complementary">
            <?php get_sidebar(); ?>
        </aside>
    </div>
</section> <!-- .main_cc -->
<?php get_footer(); ?>