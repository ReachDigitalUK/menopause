<?php

namespace Reach\WordPress;

/**
 * Removes the default 'post' post type if the 'reach/config/deactivate_posts_post_type' filter returns true.
 */
class PostsPT
{
    public static function init(): void
    {
        \add_action('after_setup_theme', [__CLASS__, 'maybeDeactivatePosts']);
    }

    /**
     * Determine whether to deactivate posts and conditionally add relevant hooks.
     *
     * @return void
     */
    public static function maybeDeactivatePosts()
    {
        // Bail early - posts are not deactivated via filter.
        if (!\apply_filters('reach/config/deactivate_posts_post_type', false)) {
            return;
        }

        \add_action('admin_bar_menu', [__CLASS__, 'removeDefaultPostTypeAddNew'], 80);
        \add_action('admin_menu', [__CLASS__, 'removeDefaultPostTypeMenuItem']);
        \add_action('current_screen', [__CLASS__, 'redirectPostsAdminPage']);
        \add_action('init', [__CLASS__, 'unregisterTaxonomies'], 10);
    }

    /**
     * Remove '+New Post' from admin bar.
     *
     * @param \WP_Admin_Bar $wp_admin_bar WP_Admin_Bar instance, passed by reference.
     * @return void
     */
    public static function removeDefaultPostTypeAddNew(\WP_Admin_Bar $wp_admin_bar): void
    {
        $wp_admin_bar->remove_node('new-post');
    }

    /**
     * Remove 'Posts' menu item from the admin Side Menu.
     *
     * @return void
     */
    public static function removeDefaultPostTypeMenuItem(): void
    {
        \remove_menu_page('edit.php');
    }

    /**
     * Redirect any user trying to access post related pages.
     *
     * @param \WP_Screen $screen Current WP_Screen object.
     * @return void
     */
    public static function redirectPostsAdminPage(\WP_Screen $screen): void
    {
        if ($screen->base === 'edit' && $screen->post_type === 'post') {
            \wp_redirect(\admin_url());
            exit;
        }
    }

    /**
     * Unregister all taxonomies for the default 'post' post type.
     *
     * @return void
     */
    public static function unregisterTaxonomies(): void
    {
        foreach (\get_object_taxonomies('post') as $taxonomy) {
            \unregister_taxonomy_for_object_type($taxonomy, 'post');
        }
    }
}
