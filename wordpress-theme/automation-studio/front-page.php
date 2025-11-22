<?php get_header(); ?>

<main class="site-main">
    <section class="hero">
        <div class="container">
            <h1 class="hero__title"><?php echo get_theme_mod('hero_title', 'Автоматизація майбутнього'); ?></h1>
            <p class="hero__subtitle"><?php echo get_theme_mod('hero_subtitle', 'Ми створюємо цифрові рішення, що працюють на вас.'); ?></p>
            <button class="btn btn--primary">Замовити консультацію</button>
        </div>
    </section>

    <section id="services" class="section services">
        <div class="container">
            <h2 class="section__title">Наші послуги</h2>
            <div class="grid">
                <!-- Loop for services could go here -->
                <div class="card">
                    <h3>CRM Інтеграція</h3>
                    <p>Об'єднайте всі канали комунікації в одній системі.</p>
                </div>
                <div class="card">
                    <h3>Чат-боти</h3>
                    <p>Розумні помічники для підтримки клієнтів 24/7.</p>
                </div>
                <div class="card">
                    <h3>Web Development</h3>
                    <p>Сучасні та швидкі веб-додатки.</p>
                </div>
            </div>
        </div>
    </section>
    
    <div class="container">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                the_content();
            endwhile;
        endif;
        ?>
    </div>
</main>

<?php get_footer(); ?>
