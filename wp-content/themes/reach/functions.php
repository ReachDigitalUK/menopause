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
