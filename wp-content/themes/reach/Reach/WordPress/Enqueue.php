<?php

namespace Reach\WordPress;

class Enqueue
{
    public static function init(): void
    {
        \add_action('wp_enqueue_scripts', [__CLASS__, 'enqueueMainAssets']);
        \add_action('wp_enqueue_scripts', [__CLASS__, 'enqueueCommentAssets']);
        \add_action('admin_enqueue_scripts', [__CLASS__, 'enqueueAdminAssets']);
        \add_action('enqueue_block_editor_assets', [__CLASS__, 'enqueueEditorAssets']);

        \add_action('wp_enqueue_scripts', [__CLASS__, 'dequeueWPGlobalStyles']);
        \add_action('wp_enqueue_scripts', [__CLASS__, 'dequeueWPBlockLibraryStyles']);

        \add_action('wp_default_scripts', [__CLASS__, 'movejQueryToFooter']);
        \add_action('wp_default_scripts', [__CLASS__, 'removejQueryMigrate']);

        \add_filter('style_loader_src', [__CLASS__, 'removeAssetVersion']);
        \add_filter('script_loader_src', [__CLASS__, 'removeAssetVersion']);

        \add_filter('reach/scripts/dependencies', [__CLASS__, 'addjQueryDependency']);
        \add_filter('reach/scripts/localization', [__CLASS__, 'addAjaxLocalization']);
    }

    /**
     * Enqueue Reach block editor assets.
     */
    public static function enqueueEditorAssets(): void
    {
        // ------------------------------------------
        // Editor Scripts
        // ------------------------------------------
        \wp_enqueue_script(
            'reach-editor',
            \Reach\Asset::URL('editor.js', true),
            \apply_filters('reach/scripts/editor/dependencies', ['wp-blocks', 'wp-dom']),
            '',
            true
        );
    }

    /**
     * Enqueue Reach admin assets.
     */
    public static function enqueueAdminAssets(): void
    {
        // ------------------------------------------
        // Admin Scripts
        // ------------------------------------------
        \wp_enqueue_script(
            'reach-admin',
            \Reach\Asset::URL('admin.js', true),
            \apply_filters('reach/scripts/admin/dependencies', []),
            '',
            true
        );

        // ------------------------------------------
        // Admin Styles
        // ------------------------------------------
        \wp_enqueue_style(
            'reach-admin',
            \Reach\Asset::URL('admin.css', true),
            \apply_filters('reach/styles/admin/dependencies', []),
            false
        );
    }

    /**
     * Remove file version query argument from all enqueued styles and scripts.
     *
     * @param string $src The source URL of the enqueued asset.
     * @return string The filtered URL of the enqueued asset.
     */
    public static function removeAssetVersion(string $src): string
    {
        if (strpos($src, '?ver=')) {
            $src = \remove_query_arg('ver', $src);
        }

        return $src;
    }

    /**
     * Enqueue all main Reach assets - styles & scripts
     */
    public static function enqueueMainAssets(): void
    {
        // ------------------------------------------
        // Enqueue Reach CSS
        // ------------------------------------------
        \wp_enqueue_style(
            'reach-styles',
            \Reach\Asset::URL('main.css', true),
            \apply_filters('reach/styles/dependencies', []),
            false
        );


        // ------------------------------------------
        // Enqueue Reach Print CSS
        // ------------------------------------------
        // \wp_enqueue_style(
        //     'reach-print',
        //     \Reach\Asset::URL('print.css', true),
        //     \apply_filters('reach/print/dependencies', []),
        //     false,
        //     'print'
        // );

        // ------------------------------------------
        // Register Reach JS
        // ------------------------------------------
        \wp_register_script(
            'reach-scripts',
            \Reach\Asset::URL('main.js', true),
            \apply_filters('reach/scripts/dependencies', []),
            '',
            true
        );

        // ------------------------------------------
        // Define Reach JS localization.
        // Allows passing PHP variables to JS.
        // ------------------------------------------
        \wp_localize_script(
            'reach-scripts',
            'params',
            \apply_filters('reach/scripts/localization', [])
        );

        // ------------------------------------------
        // Enqueue Reach JS
        // ------------------------------------------
        \wp_enqueue_script('reach-scripts');
    }

    /**
     * Conditionally enqueue WP comment-reply JS.
     */
    public static function enqueueCommentAssets(): void
    {
        if (\Reach\WordPress\Comments::enqueueReplyScript()) {
            \wp_enqueue_script('comment-reply');
        }
    }

    /**
     * Conditionally dequeue WP's core global styling inline css.
     *
     * Dequeues: global-styles-inline-css
     */
    public static function dequeueWPGlobalStyles(): void
    {
        if (\apply_filters('reach/config/remove_wp_global_styles', false)) {
            \wp_dequeue_style('global-styles');
        }
    }

    /**
     * Conditionally dequeue WP's block library stylesheet.
     *
     * Dequeues: /wp-includes/css/dist/block-library/style.min.css
     */
    public static function dequeueWPBlockLibraryStyles(): void
    {
        if (\apply_filters('reach/config/remove_wp_block_library_styles', false)) {
            \wp_dequeue_style('wp-block-library');
            \wp_dequeue_style('wp-block-library-theme');
        }
    }

    /**
     * Removes the jQuery Migrate script bundled in WordPress core.
     */
    public static function removejQueryMigrate(&$scripts): void
    {
        if (\is_admin()) {
            return;
        }

        if (\apply_filters('reach/config/remove_jquery_migrate', false)) {
            $scripts->remove('jquery');
            $scripts->add('jquery', false, array('jquery-core'), '1.12.4');
        }
    }

    /**
     * Moves jQuery to the footer unless it's required in the header.
     *
     * Places jQuery <script> in the footer by default. However, if a plugin requires it in
     * the header, it will automatically be moved there.
     *
     * @link https://wordpress.stackexchange.com/questions/173601/enqueue-core-jquery-in-the-footer/240612#240612
     */
    public static function movejQueryToFooter($wp_scripts): void
    {
        if (\is_admin()) {
            return;
        }

        if (\apply_filters('reach/config/jquery_in_footer', false)) {
            $wp_scripts->add_data('jquery', 'group', 1);
            $wp_scripts->add_data('jquery-core', 'group', 1);
        }
    }

    /**
     * Adds AJAX object properties to reach-scripts via localization if required via config.
     *
     * @link https://developer.wordpress.org/reference/functions/wp_localize_script/
     *
     * @param array $localizations An array of 'localizations' for reach-scripts.
     * @return array The filtered array of localizations for reach-scripts, with AJAX values conditionally added.
     */
    public static function addAjaxLocalization($localizations): array
    {
        if (\apply_filters('reach/config/ajax_required', false)) {
            $localizations['ajax_url'] = \admin_url('admin-ajax.php');
            $localizations['home_url'] = \home_url();
        }

        return $localizations;
    }

    /**
     * Adds jQuery as a dependancy to reach-scripts if required via config.
     *
     * @param array $dependencies An array of dependencies for reach-scripts.
     * @return array The filtered array of dependencies for reach-scripts, with jQuery conditionally added.
     */
    public static function addjQueryDependency($dependencies): array
    {
        if (\apply_filters('reach/config/jquery_required', false)) {
            $dependencies[] = 'jquery';
        }

        return $dependencies;
    }
}
