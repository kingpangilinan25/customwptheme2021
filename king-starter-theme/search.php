<?php get_header(); ?>
<section class="main_cc container">
    <div class="row">
        <section class="main_cc_text col-md-8" role="main">
            <?php if (have_posts()) : ?>
                <h1>Search Results</h1>
                <?php include(TEMPLATEPATH . '/inc/nav.php'); ?>
                <?php while (have_posts()) : the_post(); ?>
                    <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
                        <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                        <?php //include (TEMPLATEPATH . '/inc/meta.php' ); 
                        ?>
                        <div class="entry">
                            <?php the_excerpt(); ?>
                            <?php include(TEMPLATEPATH . '/inc/featured_post_sharer.php'); ?>
                        </div>
                    </article>
                <?php endwhile; ?>
                <?php include(TEMPLATEPATH . '/inc/nav.php'); ?>
            <?php else : ?>
                <h2>No posts found.</h2>
            <?php endif; ?>
        </section> <!-- .main_cc_text -->
        <aside class="main_sb col-md-4" role="complementary">
            <?php get_sidebar(); ?>
        </aside>
    </div>
</section> <!-- .main_cc -->
<?php get_footer(); ?>