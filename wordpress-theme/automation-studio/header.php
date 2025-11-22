<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
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
                        // 'fallback_cb' => false // Allow fallback to show pages if no menu set
                    ) ); 
                    ?>
                </nav>
            </div>
        </header>
