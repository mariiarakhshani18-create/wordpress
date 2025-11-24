<?php get_header(); ?>

<main class="site-main">
    <section class="section section-category">
        <div class="container">
            <?php if (have_posts()) : ?>
                <header class="category-header">
                    <h1 class="section__title"><?php single_cat_title(); ?></h1>
                    <?php if (category_description()) : ?>
                        <div class="category-description card">
                            <?php echo category_description(); ?>
                        </div>
                    <?php endif; ?>
                </header>

                <div class="grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <article class="card post-card">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail">
                                    <?php the_post_thumbnail('medium'); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="post-meta"><?php echo get_the_date('d M, Y'); ?></div>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                            <a href="<?php the_permalink(); ?>" class="read-more">Читати далі &rarr;</a>
                        </article>
                    <?php endwhile; ?>
                </div>

                <?php
                // Pagination
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => __('&larr; Попередня', 'automation-studio'),
                    'next_text' => __('Наступна &rarr;', 'automation-studio'),
                ));
                ?>

            <?php else : ?>
                <div class="card">
                    <h2>Статей поки немає</h2>
                    <p>У цій категорії ще немає опублікованих статей.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
