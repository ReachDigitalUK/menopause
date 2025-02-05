<?php

// ----------------------------------------------------
// Register the autoloader from Composer.
// ----------------------------------------------------

if (file_exists($autoloader = __DIR__ . '/vendor/autoload.php')) {
    require $autoloader;
}

// ----------------------------------------------------
// Load config values.
// ----------------------------------------------------
\Reach\Config::init();

// ----------------------------------------------------
// Load core Reach functionality.
// ----------------------------------------------------
\Reach\Partial::init();
\Reach\Component::init();

\Reach\WordPress\Admin::init();
\Reach\WordPress\Cleanup::init();
\Reach\WordPress\Comments::init();
\Reach\WordPress\EditHomepage::init();
\Reach\WordPress\Enqueue::init();
\Reach\WordPress\Gutenberg::init();
\Reach\WordPress\Head::init();
\Reach\WordPress\Images::init();
\Reach\WordPress\PostsPT::init();
\Reach\WordPress\Security::init();
\Reach\WordPress\TemplatePage::init();
\Reach\WordPress\ThemeSetup::init();
//\Reach\WordPress\Updates::init();
\Reach\WordPress\UploadMimes::init();

// ----------------------------------------------------
// Load custom Theme functionality.
// ----------------------------------------------------
// All custom functions for a theme should go in the
// 'Theme' folder and (ideally) follow a namespaced,
// class-based approach.
// ----------------------------------------------------
// WordPress - Optimisation & Other Functionality.
// ----------------------------------------------------
\Theme\WordPress\Emails::init();
\Theme\WordPress\Escaping::init();
\Theme\WordPress\Excerpt::init();
\Theme\WordPress\Menus::init();
\Theme\WordPress\MimeTypes::init();
\Theme\WordPress\Preloads::init();
\Theme\WordPress\Sidebars::init();

// ----------------------------------------------------
// Custom Shortcodes.
// ----------------------------------------------------
\Theme\Shortcodes\Year::init();

// ----------------------------------------------------
// Custom Post Types.
// ----------------------------------------------------
// \Theme\PostTypes\Event::init();
\Theme\PostTypes\Page::init();
\Theme\PostTypes\Post::init();
\Theme\PostTypes\CaseStudy::init();
\Theme\PostTypes\FreeResources::init();

// ----------------------------------------------------
// Custom Taxonomies.
// ----------------------------------------------------
// \Theme\Taxonomies\Location::init();
\Theme\Taxonomies\Category::init();

// ----------------------------------------------------
// Custom Plugin functionality.
// ----------------------------------------------------
\Theme\Plugins\ACF::init();
\Theme\Plugins\YoastSEO::init();


//Backgound Color

function custom_background_color($classes) {
    $color = get_field('background-color');
    if ($color) {

    switch($color){
        case 'white':
            $classes[] = 'white-background-color';
        case 'green':
            $classes[] = 'green-background-color';
            break;
        case 'blue':
            $classes[] = 'blue-background-color';
            break;
        default:
            $classes[] = 'default-background-color';
            break;
    }
    }else{
        $classes[] = 'default-background-color';
    }
    return $classes;
}
add_filter('body_class', 'custom_background_color');




/* annoyingly I can't add this to the functions.php in my block */

add_action('wp_ajax_get_quotes', 'handle_get_quotes');
add_action('wp_ajax_nopriv_get_quotes', 'handle_get_quotes');

function handle_get_quotes() {

    global $wpdb;
    $table_name = $wpdb->prefix .'grp_google_review';
    $query = "SELECT * FROM {$table_name} ORDER BY time DESC";
    $reviews = $wpdb->get_results($query);
    
    if ($reviews) {
        foreach ($reviews as $key => $review) {
            $args['items'][$key] = [
                'review' => $review,
                'id' => $review->id, 
                'rating' => $review->rating, 
                'text' => $review->text,
            ];

        }
    }
    $quotes = $args['items'];
    wp_send_json_success($quotes);
}

add_action('wp_ajax_fetch_posts', 'handle_get_posts');
add_action('wp_ajax_nopriv_fetch_posts', 'handle_get_posts');

function handle_get_posts(){

    $post_type = isset($_POST['post_type']) ? sanitize_text_field($_POST['post_type']) : 'post';

    $args = array(
        'post_type' => $post_type,
        'posts_per_page' => -1,
        'post_status' => 'publish',
    );
    $posts = get_posts($args);
    if ($posts) {
        foreach ($posts as $key => $post) {

            //date format is 22 June 2021
            $date = date('j F Y', strtotime($post->post_date));

            $args['items'][$key] = [
                'post' => $post,
                'date' => $date,
                'category' => get_the_category($post->ID),
                'id' => $post->ID, 
                'title' => $post->post_title, 
                'content' => $post->post_content,
                'excerpt' => $post->post_excerpt,
                'link' => get_permalink($post->ID),
                'image' => get_the_post_thumbnail_url($post->ID, 'full'),
            ];

        }
    }
    $posts = $args['items'];
    wp_send_json_success($posts);
}

/* Disable Category Pages */

function disable_category_pages() {
    if (is_category()) {
        wp_redirect(home_url()); // Redirect to homepage
        exit;
    }
}
add_action('template_redirect', 'disable_category_pages');