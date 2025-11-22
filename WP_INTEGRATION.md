# WordPress Integration Guide

## 1. Theme Structure
Create a new folder in `wp-content/themes/automation-studio`.

**Required Files:**
- `style.css` (Theme declaration)
- `functions.php` (Enqueue scripts/styles)
- `header.php` (Header part of HTML)
- `footer.php` (Footer part of HTML)
- `front-page.php` (Home page template)
- `page.php` (Generic page template)
- `index.php` (Fallback template)

## 2. Asset Management
1. Run `npm run build` in this project.
2. Copy the `dist/assets` folder to your theme folder (e.g., `wp-content/themes/automation-studio/assets`).

## 3. Enqueueing in functions.php
Add this to your `functions.php`:

```php
<?php
function automation_studio_scripts() {
    // Get the asset filenames (you might need to update these after each build or write a helper to parse manifest.json)
    // For simplicity, rename the built files to remove hashes or use a glob pattern in PHP.
    
    wp_enqueue_style('main-style', get_template_directory_uri() . '/assets/index.css');
    
    // Load main JS as a module
    wp_enqueue_script('main-script', get_template_directory_uri() . '/assets/index.js', array(), '1.0', true);
}
add_action('wp_enqueue_scripts', 'automation_studio_scripts');

// Add type="module" to the script tag
function add_type_attribute($tag, $handle, $src) {
    if ('main-script' !== $handle) {
        return $tag;
    }
    return '<script type="module" src="' . esc_url($src) . '"></script>';
}
add_filter('script_loader_tag', 'add_type_attribute', 10, 3);
?>
```

## 4. Template Conversion

### header.php
Extract the top part of `index.html`:
```php
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div id="app">
        <canvas id="webgl-canvas"></canvas>
        <header class="site-header">
            <div class="container">
                <a href="<?php echo home_url(); ?>" class="logo">AutoStudio</a>
                <nav class="main-nav">
                    <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
                </nav>
            </div>
        </header>
```

### footer.php
Extract the bottom part:
```php
        <footer class="site-footer">
            <div class="container">
                <p>&copy; <?php echo date('Y'); ?> Automation Studio. All rights reserved.</p>
            </div>
        </footer>
    </div> <!-- #app -->
    <?php wp_footer(); ?>
</body>
</html>
```

### front-page.php
```php
<?php get_header(); ?>

<main class="site-main">
    <section class="hero">
        <div class="container">
            <h1 class="hero__title"><?php the_field('hero_title'); ?></h1>
            <p class="hero__subtitle"><?php the_field('hero_subtitle'); ?></p>
        </div>
    </section>
    
    <!-- Loop for services or other content -->
</main>

<?php get_footer(); ?>
```
