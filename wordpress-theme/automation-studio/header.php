<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div id="preloader">
        <div class="loader-content">
            <div class="spinner"></div>
            <div class="loading-text">Loading Studio...</div>
        </div>
    </div>

    <div id="app">
        <canvas id="webgl-canvas"></canvas>

        <header class="site-header">
            <div class="container">
                <a href="<?php echo home_url(); ?>" class="logo">AutoStudio</a>
                <nav class="main-nav">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'container' => false,
                        'fallback_cb' => false, 
                        'items_wrap' => '<ul>%3$s</ul>',
                    ) );
                    ?>
                    <?php if ( ! has_nav_menu( 'primary' ) ) : ?>
                    <ul>
                        <li><a href="#services">Послуги</a></li>
                        <li><a href="#about">Про нас</a></li>
                        <li><a href="#blog">Блог</a></li>
                        <li><a href="#contact">Контакти</a></li>
                    </ul>
                    <?php endif; ?>
                </nav>
            </div>
        </header>
