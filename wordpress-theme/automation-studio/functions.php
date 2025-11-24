<?php
function automation_studio_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'automation-studio' ),
    ) );
}
add_action( 'after_setup_theme', 'automation_studio_setup' );

function automation_studio_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style( 'automation-studio-style', get_stylesheet_uri() );
    
    // Enqueue built assets
    // Note: In a real scenario, you should parse manifest.json to get the correct filenames with hashes.
    // For this demo, we assume standard names or that the user renames them.
    
    wp_enqueue_style( 'automation-studio-app-style', get_template_directory_uri() . '/assets/index.css', array(), time() );
    wp_enqueue_script( 'automation-studio-app-script', get_template_directory_uri() . '/assets/index.js', array(), time(), true );
}
add_action( 'wp_enqueue_scripts', 'automation_studio_scripts' );

// Add type="module" to the main script
function add_type_attribute($tag, $handle, $src) {
    if ('automation-studio-app-script' !== $handle) {
        return $tag;
    }
    return '<script type="module" src="' . esc_url($src) . '"></script>';
}
add_filter('script_loader_tag', 'add_type_attribute', 10, 3);

// Customizer settings for Hero section
function automation_studio_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'hero_section' , array(
        'title'      => __( 'Hero Section', 'automation-studio' ),
        'priority'   => 30,
    ) );

    $wp_customize->add_setting( 'hero_title' , array(
        'default'   => 'Автоматизація майбутнього',
        'transport' => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'hero_title', array(
        'label'      => __( 'Hero Title', 'automation-studio' ),
        'section'    => 'hero_section',
        'settings'   => 'hero_title',
    ) ) );

    $wp_customize->add_setting( 'hero_subtitle' , array(
        'default'   => 'Ми створюємо цифрові рішення, що працюють на вас.',
        'transport' => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'hero_subtitle', array(
        'label'      => __( 'Hero Subtitle', 'automation-studio' ),
        'section'    => 'hero_section',
        'settings'   => 'hero_subtitle',
    ) ) );
}
add_action( 'customize_register', 'automation_studio_customize_register' );

// Register Custom Categories for Blog
function automation_studio_register_categories() {
    // Create default categories if they don't exist
    $categories = array(
        'CRM Інтеграція' => 'Професійна інтеграція CRM систем для автоматизації продажів',
        'Чат-боти' => 'Розробка та налаштування чат-ботів для бізнесу',
        'Кейси' => 'Реальні проекти та історії успіху наших клієнтів',
        'Гайди' => 'Покрокові інструкції та корисні поради з автоматизації'
    );

    foreach ($categories as $name => $description) {
        if (!term_exists($name, 'category')) {
            wp_insert_term(
                $name,
                'category',
                array(
                    'description' => $description,
                    'slug' => sanitize_title($name)
                )
            );
        }
    }
}
add_action('init', 'automation_studio_register_categories');

// Rank Math SEO Integration
function automation_studio_rankmath_setup() {
    // Add Rank Math support for custom post types if needed
    add_theme_support('rank-math');
    
    // Enable breadcrumbs
    add_theme_support('rank-math-breadcrumbs');
}
add_action('after_setup_theme', 'automation_studio_rankmath_setup');

// Add Schema.org markup for Articles
function automation_studio_add_schema() {
    if (is_single()) {
        ?>
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Article",
            "headline": "<?php echo esc_js(get_the_title()); ?>",
            "author": {
                "@type": "Organization",
                "name": "Automation Studio"
            },
            "publisher": {
                "@type": "Organization",
                "name": "Automation Studio",
                "logo": {
                    "@type": "ImageObject",
                    "url": "<?php echo esc_url(get_template_directory_uri() . '/assets/logo.png'); ?>"
                }
            },
            "datePublished": "<?php echo get_the_date('c'); ?>",
            "dateModified": "<?php echo get_the_modified_date('c'); ?>"
        }
        </script>
        <?php
    }
}
add_action('wp_head', 'automation_studio_add_schema');
?>
