<?php get_header(); ?>

<main class="site-main">
    <?php while (have_posts()) : the_post(); ?>
        <article class="section section-single-post">
            <div class="container">
                <header class="post-header">
                    <div class="post-meta">
                        <?php echo get_the_date('d M, Y'); ?> • 
                        <?php the_category(', '); ?>
                    </div>
                    <h1 class="post-title"><?php the_title(); ?></h1>
                </header>

                <div class="post-content card">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-featured-image">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="post-body">
                        <?php the_content(); ?>
                    </div>

                    <?php if (has_tag()) : ?>
                        <div class="post-tags">
                            <strong>Теги:</strong> <?php the_tags('', ', ', ''); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <nav class="post-navigation">
                    <div class="nav-previous">
                        <?php previous_post_link('%link', '&larr; %title'); ?>
                    </div>
                    <div class="nav-next">
                        <?php next_post_link('%link', '%title &rarr;'); ?>
                    </div>
                </nav>
            </div>
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
