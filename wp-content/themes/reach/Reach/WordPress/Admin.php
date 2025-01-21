<?php

namespace Reach\WordPress;

class Admin
{
    public static function init(): void
    {
        \add_action('init', [__CLASS__, 'disallowFileEdit']);
        \add_action('init', [__CLASS__, 'setEnvironmentType']);
        \add_action('admin_head', [__CLASS__, 'addWPAdminSubmenuGlobalFilter'], 15);
        \add_action('wp_dashboard_setup', [__CLASS__, 'removeDraftWidget'], 1);
        \add_filter('get_user_option_admin_color', [__CLASS__, 'adminColor']);

        // Post archive page link to all posts admin screen.
        \add_action('admin_bar_menu', [__CLASS__, 'addViewAllPostsToArchivePages'], 80);
    }

    /**
     * Prevent users editing plugin and theme files.
     *
     * Easier than looping through all defined user roles and reassigning relevant capabilities.
     *
     * @return void
     */
    public static function disallowFileEdit()
    {
        define('DISALLOW_FILE_EDIT', true);
    }

    /**
     * Sets the environment type if not already set, for local development.
     */
    public static function setEnvironmentType(): void
    {
        // Bail early - environment type already defined.
        if (defined('WP_ENVIRONMENT_TYPE')) {
            return;
        }

        $env = \Reach\Paths::resolve('.env.js');

        if (file_exists($env)) {
            define('WP_ENVIRONMENT_TYPE', 'development');
        }
    }

    /**
     * Filter the 'admin_color' user option when .env.js file is present (e.g. a local or development environment).
     *
     * @link https://developer.wordpress.org/reference/hooks/get_user_option_option/
     *
     * @return string The filtered admin_color option.
     */
    public static function adminColor($value)
    {
        if (\wp_get_environment_type() === 'development') {
            return 'midnight';
        }

        return $value;
    }

    /**
     * Remove 'quick edit' widget.
     */
    public static function removeDraftWidget(): void
    {
        \remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    }

    /**
     * Filters the global $submenu to allow adding custom links to the WP admin bar.
     *
     * NOTE: Adding a filter to a WP global isn't ideal. However, as there's
     * no easy way to add custom links to the (sub)menu then this approach
     * will do for now. Some enhancements to the menu API have been suggested
     * on trac (see links below), so could be good options in the future.
     *
     * @link https://core.trac.wordpress.org/ticket/12718
     * @link https://core.trac.wordpress.org/ticket/39050
     *
     * @return void
     */
    public static function addWPAdminSubmenuGlobalFilter(): void
    {
        global $submenu;

        $submenu = \apply_filters('reach/wordpress/admin/submenu', $submenu);
    }

    /**
     * Add an 'Edit all {Post Type}' button to the WP admin bar when viewing a post type
     * archive page on the front-end, which is linked to the admin view all {post-type} screen.
     * Allows users to quickly get to the full admin list of posts from the archive page.
     *
     * @link https://developer.wordpress.org/reference/hooks/admin_bar_menu/
     *
     * @param \WP_Admin_Bar $adminBar The WP_Admin_Bar instance, passed by reference.
     * @return void
     */
    public static function addViewAllPostsToArchivePages(\WP_Admin_Bar $adminBar): void
    {
        if (!\current_user_can('edit_posts') || \is_admin()) {
            return;
        }

        $queried_object = \Reach\WordPress\PageObject::get();

        // Bail early - not on an template page.
        if (!\is_post_type_archive() && !$queried_object instanceof \WP_Post_Type) {
            return;
        }

        $adminBar->add_menu([
            'id'    => 'reach-all-posts',
            'title' => sprintf(
                // translators: 1: opening html tags. 2: post type name. 3: closing html tags.
                \_x('%sEdit all %s%s', 'Admin bar edit link', 'reach'),
                '<span class="ab-icon" aria-hidden="true"></span><span class="ab-label">',
                $queried_object->label,
                '</span>'
            ),
            'href'  => \admin_url('edit.php?post_type=' . $queried_object->name),
            'meta'  => [
                'title' => sprintf(
                    // translators: post type name.
                    \_x('View all %s admin page', 'Admin bar edit link title', 'reach'),
                    $queried_object->label,
                ),
                'class' => 'reach-ab-item reach-edit-template'
            ],
        ]);
    }
}
