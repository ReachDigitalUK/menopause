<?php

/**
 * Functionality that enables a 'Template' CPT which is used for editing archive
 * (and other special templates) page content.
 */

namespace Reach\WordPress;

class TemplatePage
{
    protected const SLUG = 'reach-template'; // Prefixed to avoid conflicts.

    /**
     * Create Template Page post type and link to configured post types and taxonomies.
     */
    public static function init()
    {
        \add_action('init', [__CLASS__, 'registerPostType']);
        \add_action('admin_bar_menu', [__CLASS__, 'addPostTypeEditToolbarButton'], 80);
        \add_action('admin_bar_menu', [__CLASS__, 'addAdminBarEditToolbarButton'], 80);
        \add_action('admin_bar_menu', [__CLASS__, 'add404AddTemplateAdminBarLink'], 80);
        \add_action('admin_bar_menu', [__CLASS__, 'addTaxonomyAddTemplateAdminBarLink'], 80);
        \add_action('admin_bar_menu', [__CLASS__, 'addTermAddTemplateAdminBarLink'], 80);
        \add_action('admin_bar_menu', [__CLASS__, 'addViewToolbarButton'], 80);
        \add_action('admin_bar_menu', [__CLASS__, 'removeBlogHomeEditPageButton'], 100);
        \add_filter('reach/wordpress/admin/submenu', [__CLASS__, 'addPostTypeTemplateEditSubmenuLink']);
        \add_action('admin_post_create_template_page', [__CLASS__, 'createTemplatePage']);
        \add_action('after_delete_post', [__CLASS__, 'removeTemplateOption'], 10, 2);
        \add_filter('post_type_link', [__CLASS__, 'filterTemplatePagePermalink'], 10, 2);

        // Filter Template Page items in Edit Menu admin screen & customizer.
        \add_filter('wp_setup_nav_menu_item', [__CLASS__, 'filterAdminNavMenuItem']);
        \add_filter('customize_nav_menu_available_items', [__CLASS__, 'filterCustomizerAvailableNavMenuItems'], 10, 3);
        \add_filter('customize_nav_menu_searched_items', [__CLASS__, 'filterCustomizerNavMenuItems']);
    }

    public static function registerPostType(): void
    {
        if (!function_exists('register_extended_post_type')) {
            return;
        }

        \register_extended_post_type(self::SLUG, [
            'public' => false,
            'show_ui' => true,
            'show_in_rest' => true,
            'show_in_nav_menus' => true,
            'menu_position' => 50, // Below comments, after all other post types.
            'menu_icon' => 'dashicons-welcome-widgets-menus',
            'supports' => [
                'title',
                'editor',
                'revisions',
                'thumbnail',
                'custom-fields',
                'excerpt',
            ],
            'admin_cols' => [
                'title' => [
                    'title' => \__('Template Name', 'reach'),
                ],
                'updated' => [
                    'title'      => \__('Updated', 'reach'),
                    'post_field' => 'post_modified',
                    'date_format' => 'Y/m/d \a\t H:i a',
                ],
                'template_for' => [
                    'title' => \__('Template For', 'reach'),
                    'function' => function ($post) {
                        $object = self::getTemplatedObject($post);

                        if (empty($object)) {
                            return;
                        }

                        if ($object instanceof \WP_Term) {
                            echo sprintf(
                                // translators: 1: Taxonomy name. 2: Term archive link.
                                \_x('%s: %s', 'Template post list taxonomy archive link', 'reach'),
                                \get_taxonomy($object->taxonomy)->labels->singular_name,
                                \Reach\Component::get('link', [
                                    'url' => \get_term_link($object),
                                    'content' => $object->name,
                                ])
                            );
                        } elseif ($object instanceof \WP_Taxonomy) {
                            echo sprintf(
                                // translators: 1: Taxonomy archive link
                                \_x('All %s', 'Template post list taxonomy name', 'reach'),
                                $object->label,
                            );
                        } elseif ($object instanceof \WP_Post_Type) {
                            echo sprintf(
                                // translators: 1: Post type archive link.
                                \_x('Post Type: %s', 'Template post list post type archive link', 'reach'),
                                \Reach\Component::get('link', [
                                    'url' => \get_post_type_archive_link($object->name),
                                    'content' => $object->label,
                                ])
                            );
                        } elseif (!empty($object->type) && $object->type === '404') {
                            echo \_x('Special: 404', 'Template post list 404', 'reach');
                        }
                    }
                ]
            ],

            /**
             * Only allow users to add new template pages via custom admin bar buttons.
             *
             * @link https://developer.wordpress.org/reference/functions/register_post_type/#capabilities
             *
             * Argument explanation:
             * capability_type: Use the 'post' post type capabilities for the `reach-template` post type by default.
             * capabilities['create_posts']: Override `create_posts` "primitive capability" with custom capability name.
             *                               This means no user roles will be able to create new reach-templates
             *                               because this custom capability name should never be given to any roles.
             * map_meta_cap: Required to enable overriding of `create_posts` "primitive capability".
             */
            'capability_type' => 'post',
            'capabilities' => [
                'create_posts' => 'create_reach-template',
            ],
            'map_meta_cap' => true, // Required.
        ], [
            // Override the base names used for labels (optional).
            'singular' => \__('Template Page', 'reach'),
            'plural'   => \__('Template Pages', 'reach'),
            'slug'     => self::SLUG,
        ]);
    }

    /**
     * Filters the global $submenu to add post type edit link(s) to the WP admin bar.
     *
     * @param array $submenu An array of WP admin menu items.
     */
    public static function addPostTypeTemplateEditSubmenuLink($submenu): array
    {
        // Bail early - user doesn't have the right capabilities.
        if (!\current_user_can('edit_pages')) {
            return $submenu;
        }

        $postTypes = self::getTemplatePostTypes();

        foreach ($postTypes as $pt) {
            $template = self::getTemplatePage(
                \get_post_type_object($pt)
            );

            // Handle 'post' PT menu key edge case.
            $key = ($pt === 'post') ? 'edit.php' : "edit.php?post_type={$pt}";

            // Bail early - no page found.
            if (
                !empty($template)
                && $template instanceof \WP_Post
                && $template->post_status !== 'trash'
            ) {
                $linkArray = [
                    \__('Edit Template', 'reach'),
                    'edit_pages',
                    \get_edit_post_link($template->ID),
                ];
            } else {
                $linkArray = [
                    \__('Add Template', 'reach'),
                    'edit_pages',
                    \add_query_arg([
                        'action' => 'create_template_page',
                        'object_type' => 'wp_post_type',
                        'object_id' => $pt,
                        'nonce' => \wp_create_nonce('create_template_page'),
                    ], \admin_url('admin-post.php')),
                ];
            }

            $submenu[$key][] = $linkArray;
        }

        return $submenu;
    }

    /**
     * Filters the global $submenu to add post type edit link(s) to the WP admin bar.
     *
     * @param \WP_Admin_Bar $adminBar An array of WP admin menu items.
     */
    public static function addTaxonomyAddTemplateAdminBarLink(\WP_Admin_Bar $adminBar): void
    {
        if (!\current_user_can('edit_posts') || !\is_admin()) {
            return;
        }

        $screen = \get_current_screen();
        $taxonomies = self::getTemplateTaxonomies();

        // Bail early - not currently editing a valid taxonomy term.
        if (
            empty($screen->taxonomy) ||
            $screen->base !== 'edit-tags' ||
            !in_array($screen->taxonomy, $taxonomies, true)
        ) {
            return;
        }

        $taxonomyName = $screen->taxonomy;
        $templatePageId = \get_option("{$taxonomyName}_template_page", 0);
        $templatePage = \get_post($templatePageId);

        // Bail early - template page set already.
        if (!empty($templatePage) && $templatePage instanceof \WP_Post && $templatePage->post_status !== 'trash') {
            return;
        }

        $adminBar->add_menu([
            'id'    => 'reach-add-template',
            'title' => \__('Add Template', 'reach'),
            'href'  => \add_query_arg([
                'action' => 'create_template_page',
                'object_type' => 'wp_taxonomy',
                'object_id' => $taxonomyName,
                'nonce' => \wp_create_nonce('create_template_page'),
            ], \admin_url('admin-post.php')),
            'meta'  => [
                'title' => \__('Add Template', 'reach'),
            ],
        ]);
    }

    /**
     * Filters the global $submenu to add post type edit link(s) to the WP admin bar.
     *
     * @param \WP_Admin_Bar $adminBar An array of WP admin menu items.
     */
    public static function addTermAddTemplateAdminBarLink(\WP_Admin_Bar $adminBar): void
    {
        if (!\current_user_can('edit_posts') || !\is_admin()) {
            return;
        }

        $screen = \get_current_screen();
        $taxonomies = self::getTemplateTaxonomies();

        // Bail early - not currently editing a valid taxonomy term.
        if (empty($screen->taxonomy) || $screen->base !== 'term' || !in_array($screen->taxonomy, $taxonomies, true)) {
            return;
        }

        $term = self::getTermBeingEdited();

        // Bail early - invalid term page.
        if (empty($term)) {
            return;
        }

        $templatePageId = \get_term_meta($term->term_id, 'template_page', true);
        $templatePage = \get_post($templatePageId);

        // Bail early - template page set already.
        if (
            !empty($templatePage)
            && $templatePage instanceof \WP_Post
            && $templatePage->post_status !== 'trash'
        ) {
            return;
        }

        $adminBar->add_menu([
            'id'    => 'reach-add-template',
            'title' => \__('Add Template', 'reach'),
            'href'  => \add_query_arg([
                'action' => 'create_template_page',
                'object_type' => 'wp_term',
                'object_id' => $term->term_taxonomy_id,
                'nonce' => \wp_create_nonce('create_template_page'),
            ], \admin_url('admin-post.php')),
            'meta'  => [
                'title' => \__('Add Template', 'reach'),
            ],
        ]);
    }

    /**
     * Filters the global $submenu to add post type edit link(s) to the WP admin bar.
     *
     * @param \WP_Admin_Bar $adminBar An array of WP admin menu items.
     */
    public static function add404AddTemplateAdminBarLink(\WP_Admin_Bar $adminBar): void
    {
        if (!\current_user_can('edit_posts') || \is_admin() || !\is_404()) {
            return;
        }

        $templatePageId = \get_option('404_template_page', 0);

        // Bail early - template page set already.
        if (!empty($templatePageId)) {
            return;
        }

        $templatePage = \get_post($templatePageId);

        // Bail early - template page set already.
        if (
            $templatePage instanceof \WP_Post
            && $templatePage->post_status !== 'trash'
        ) {
            return;
        }

        $adminBar->add_menu([
            'id'    => 'reach-add-template',
            'title' => \__('Add Template', 'reach'),
            'href'  => \add_query_arg([
                'action' => 'create_template_page',
                'object_type' => '404',
                'object_id' => '0',
                'nonce' => \wp_create_nonce('create_template_page'),
            ], \admin_url('admin-post.php')),
            'meta'  => [
                'title' => \__('Add Template', 'reach'),
            ],
        ]);
    }

    /**
     * Creates a new template page for a post type, if one does not exist, using the `admin_post_{action}` hook.
     *
     * @link https://developer.wordpress.org/reference/hooks/admin_post_action/
     */
    public static function createTemplatePage(): void
    {
        // Bail early - capability check.
        if (!\current_user_can('edit_pages')) {
            return;
        }

        // Bail early - nonce check.
        $nonce = $_REQUEST['nonce'] ?? '';
        if (\wp_verify_nonce($nonce, 'create_template_page') === false) {
            \wp_die(
                \__('Invalid request.', 'reach')
            );
        }

        if (empty($_REQUEST['object_type']) || !isset($_REQUEST['object_id'])) {
            // Bail early - required args not set.
            \wp_safe_redirect(
                \admin_url('edit.php?post_type=' . self::SLUG)
            );
            exit;
        }

        $objectData = (object) [
            'id' => \sanitize_text_field((string) $_REQUEST['object_id']),
            'type' => \sanitize_text_field((string) $_REQUEST['object_type']),
        ];

        if ($objectData->type === 'wp_post_type') {
            $object = \get_post_type_object($objectData->id);
            $objectData->title = $object->labels->name;
            $objectData->slug = $object->name;
        } elseif ($objectData->type === 'wp_term') {
            $object = \get_term_by('term_taxonomy_id', $objectData->id);
            $objectData->title = $object->name;
            $objectData->slug = $object->slug;
        } elseif ($objectData->type === 'wp_taxonomy') {
            $object = \get_taxonomy($objectData->id);
            $objectData->title = $object->label;
            $objectData->slug = $object->name;
        } elseif ($objectData->type === '404') {
            $objectData->title = \_x('404 Not Found', 'Template Page 404 title', 'reach');
            $objectData->slug = '404';
        }

        // Bail early - invalid object.
        if (empty($objectData->title)) {
            \wp_safe_redirect(
                \admin_url('edit.php?post_type=' . self::SLUG)
            );
            exit;
        }

        // Create new template page for this post type.
        $templatePageId = \wp_insert_post([
            'post_title'   => $objectData->title,
            'post_content' => $objectData->type === '404' ? '' : '<!-- wp:acf/template-loop /-->',
            'post_status'  => 'publish',
            'post_type'    => self::SLUG,
            'post_name'    => isset($objectData->slug) ? $objectData->slug : null,
            'meta_input'   => [
                'reach-template-page-data' => $objectData,
            ],
        ]);

        // Bail early - post creation failed somehow.
        if (empty($templatePageId) || \is_wp_error($templatePageId)) {
            \wp_safe_redirect(
                \admin_url('edit.php?post_type=' . self::SLUG)
            );
            exit;
        }

        if ($objectData->type === 'wp_post_type' || $objectData->type === 'wp_taxonomy') {
            // Connection from post type or taxonomy to template page.
            \update_option("{$objectData->slug}_template_page", $templatePageId, false);
        } elseif ($objectData->type === 'wp_term') {
            // Connection from term to template page.
            \update_term_meta($objectData->id, 'template_page', $templatePageId);
        } elseif ($objectData->type === '404') {
            \update_option('404_template_page', $templatePageId, false);
        }

        \wp_safe_redirect(
            \get_edit_post_link($templatePageId, 'redirect')
        );
        exit;
    }

    /**
     * Add a 'View Template' button to the WP admin bar when editing a reach-template post.
     *
     * @link https://developer.wordpress.org/reference/hooks/admin_bar_menu/
     *
     * @param \WP_Admin_Bar $adminBar The WP_Admin_Bar instance, passed by reference.
     */
    public static function addViewToolbarButton(\WP_Admin_Bar $adminBar): void
    {
        if (!\current_user_can('edit_posts') || !\is_admin()) {
            return;
        }

        $screen = \get_current_screen();

        // Bail early - not currently on a screen related to reach-template.
        if (empty($screen->post_type) || $screen->post_type !== self::SLUG) {
            return;
        }

        // Bail early - not currently on a post edit screen.
        if (empty($screen->base) || $screen->base !== 'post') {
            return;
        }

        // Retrieves the object (WP_Post_Type|WP_Term) linked to this reach-template post.
        $object = self::getTemplatedObject(\get_post());

        if (empty($object)) {
            return;
        }

        if ($object instanceof \WP_Term) {
            $link = \get_term_link($object);
        } elseif ($object instanceof \WP_Post_Type) {
            $link = \get_post_type_archive_link($object->name);
        } else {
            return; // Bail early - invalid post meta.
        }

        $adminBar->add_menu([
            'id'    => 'reach-view-template',
            'title' => \__('View Template', 'reach'),
            'href'  => $link,
            'meta'  => [
                'title' => \__('View Template', 'reach'),
                'class' => 'reach-ab-item reach-view-template'
            ],
        ]);
    }

    /**
     * Add an 'Edit Template' button to the WP admin bar when editing a valid taxonomy
     * term or viewing a valid post type list on the back-end.
     *
     * @link https://developer.wordpress.org/reference/hooks/admin_bar_menu/
     *
     * @param \WP_Admin_Bar $adminBar The WP_Admin_Bar instance, passed by reference.
     */
    public static function addAdminBarEditToolbarButton(\WP_Admin_Bar $adminBar): void
    {
        if (!\current_user_can('edit_posts') || !\is_admin()) {
            return;
        }

        $screen = \get_current_screen();

        // Bail early - wrong screen.
        if (
            $screen->base !== 'term'
            && $screen->base !== 'edit'
            && $screen->base !== 'edit-tags'
        ) {
            return;
        }

        $postTypes = self::getTemplatePostTypes();
        $taxonomies = self::getTemplateTaxonomies();

        if (
            $screen->base === 'term'
            && !empty($screen->taxonomy)
            && !in_array($screen->taxonomy, $taxonomies, true)
        ) {
            return; // Bail early - currently editing an invalid taxonomy term.
        } elseif (
            $screen->base === 'edit'
            && !empty($screen->post_type)
            && !in_array($screen->post_type, $postTypes, true)
        ) {
            return; // Bail early - currently viewing an invalid post type list.
        }

        if (!empty($screen->taxonomy) && $screen->base === 'term') {
            $term = self::getTermBeingEdited();

            // Bail early - invalid term page.
            if (empty($term)) {
                return;
            }

            $templatePageId = \get_term_meta($term->term_id, 'template_page', true);
        } elseif (!empty($screen->taxonomy) && $screen->base === 'edit-tags') {
            $templatePageId = \get_option("{$screen->taxonomy}_template_page", 0);
        } elseif (!empty($screen->post_type) && $screen->base === 'edit') {
            $templatePageId = \get_option("{$screen->post_type}_template_page", 0);
        }

        if (empty($templatePageId)) {
            return;
        }

        $templatePage = \get_post($templatePageId);

        if (
            empty($templatePage)
            || !($templatePage instanceof \WP_Post)
            || $templatePage->post_status === 'trash'
        ) {
            return;
        }

        $adminBar->add_menu([
            'id'    => 'reach-edit-template',
            'title' => sprintf(
                // translators: 1: opening html tags. 2: closing html tags.
                \_x('%sEdit Template Content%s', 'Admin bar edit link', 'reach'),
                '<span class="ab-icon" aria-hidden="true"></span><span class="ab-label">',
                '</span>'
            ),
            'href'  => \get_edit_post_link($templatePage),
            'meta'  => [
                'title' => \_x('Edit Template Content', 'Admin bar edit link title', 'reach'),
                'class' => 'reach-ab-item reach-edit-template'
            ],
        ]);
    }

    /**
     * Add an 'Edit Template' button to the WP admin bar when viewing a post type
     * template on the front-end, which is linked to a reach-template post.
     *
     * @link https://developer.wordpress.org/reference/hooks/admin_bar_menu/
     *
     * @param \WP_Admin_Bar $adminBar The WP_Admin_Bar instance, passed by reference.
     */
    public static function addPostTypeEditToolbarButton(\WP_Admin_Bar $adminBar): void
    {
        if (!\current_user_can('edit_posts') || \is_admin()) {
            return;
        }

        // Bail early - not on an template page.
        if (!\is_archive() && !\is_home() && !\is_404()) {
            return;
        }

        $templatePage = self::getTemplatePage(
            \Reach\WordPress\PageObject::get()
        );

        if (
            empty($templatePage)
            || !($templatePage instanceof \WP_Post)
            || $templatePage->post_status === 'trash'
        ) {
            return;
        }

        $adminBar->add_menu([
            'id'    => 'reach-edit-template',
            'title' => sprintf(
                // translators: 1: opening html tags. 2: closing html tags.
                \_x('%sEdit Template Content%s', 'Admin bar edit link', 'reach'),
                '<span class="ab-icon" aria-hidden="true"></span><span class="ab-label">',
                '</span>'
            ),
            'href'  => \get_edit_post_link($templatePage),
            'meta'  => [
                'title' => \_x('Edit Template Content', 'Admin bar edit link title', 'reach'),
                'class' => 'reach-ab-item reach-edit-template'
            ],
        ]);
    }

    /**
     * Remove the default 'Edit Page' button from the WP admin bar when viewing the 'Post' post type
     * template on the front-end, which is linked to a 'Page' post via core settings.
     *
     * Hooked in after the button has been added (priority: >80).
     *
     * @link https://developer.wordpress.org/reference/hooks/admin_bar_menu/
     * @see /wp-includes/admin-bar.php:847
     *
     * @param \WP_Admin_Bar $adminBar The WP_Admin_Bar instance, passed by reference.
     */
    public static function removeBlogHomeEditPageButton(\WP_Admin_Bar $adminBar): void
    {
        if (!\current_user_can('edit_posts') || \is_admin()) {
            return;
        }

        // Bail early - not on the blog archive page.
        if (!\is_home()) {
            return;
        }

        $adminBar->remove_menu('edit');
    }

    /**
     * Retrieve the permalink for a Template Page's linked object instead of the Template Page's own permalink.
     *
     * Does not return a filtered permalink for a 404 page (for hopefully obvious reasons).
     *
     * @param string $permalink The template page's permalink.
     * @param \WP_Post $post The template post object.
     * @return string The template page's filtered permalink.
     */
    public static function filterTemplatePagePermalink(string $permalink, \WP_Post $post): string
    {
        $object = self::getTemplatedObject($post);

        if (empty($object)) {
            return $permalink;
        }

        if (is_a($object, 'WP_Post_Type')) {
            return \get_post_type_archive_link($object->name);
        } elseif (is_a($object, 'WP_Term')) {
            return \get_term_link($object, $object->taxonomy);
        }

        return $permalink;
    }


    /**
     * Filters the Template Page menu items in the admin Edit Menu screen to prevent unlinked Template Pages and the
     * 404 Template Page from being available to add to nav menus via the the 'Most Recent', 'View All', and 'Search'
     * menu item selection lists.
     *
     * @link https://developer.wordpress.org/reference/hooks/wp_setup_nav_menu_item/
     *
     * @param object|null $item The menu item object.
     * @return object|null The same menu item object. Null if unlinked or linked to the 404 page.
     */
    public static function filterAdminNavMenuItem(?object $item)
    {
        // Bail early - on the front-end.
        if (!\is_admin() || \is_customize_preview()) {
            return $item;
        }

        if (empty($item) || !$item instanceof \WP_Post || $item->post_type !== self::SLUG) {
            return $item;
        }

        if (!self::isValidTemplatePageMenuItem($item)) {
            return null;
        }

        return $item;
    }


    /**
     * Filter the initially available Template Page menu items in the customizer.
     *
     * @link https://developer.wordpress.org/reference/hooks/customize_nav_menu_available_items/
     * @see /wp-includes/class-wp-customize-nav-menus.php:300
     *
     * @param array $items The array of menu items.
     * @param string $type The object type.
     * @param string $object The object name.
     * @return array The filtered array of menu items.
     */
    public static function filterCustomizerAvailableNavMenuItems(array $items, string $type, string $object): array
    {
        if ($type !== 'post_type' || $object !== self::SLUG) {
            return $items;
        }

        return self::filterCustomizerNavMenuItems($items);
    }

    /**
     * Filter any menu items retrieved in the customizer to remove invalid Template Pages.
     *
     * @link https://developer.wordpress.org/reference/hooks/customize_nav_menu_searched_items/
     * @see /wp-includes/class-wp-customize-nav-menus.php:473
     *
     * @param array $items An array of menu items.
     * @return array The filtered array of menu items.
     */
    public static function filterCustomizerNavMenuItems(array $items): array
    {
        return array_values(
            array_filter($items, function ($item) {
                $itemPost = \get_post($item['object_id']);

                // Keep this item - not a Template Page post to check.
                if (!$itemPost instanceof \WP_Post || $itemPost->post_type !== self::SLUG) {
                    return true;
                }

                return self::isValidTemplatePageMenuItem($itemPost);
            })
        );
    }

    /**
     * Determines whether the given Template Page is linked to an object that should be allowed in a menu.
     *
     * For example, a post type or term archive would be fine, while a 404 page would not.
     *
     * @param mixed $page A Template Page post object.
     * @return boolean Whether the given Template Page is linked to a valid object. False if not linked to an object.
     */
    public static function isValidTemplatePageMenuItem($page): bool
    {
        $object = self::getTemplatedObject($page);

        return !empty($object) && is_object($object) && (!$object instanceof \WP_Taxonomy) && $object->name !== '404';
    }

    /**
     * Retrieves the filtered page content for a Post Type, Taxonomy, or Term, if an template page is set.
     *
     * @param object $object A WP_Post_Type, WP_Taxonomy, WP_Term, or WP_Query which might have an template page set.
     * @return string|bool The content of the template page, if found, false otherwise.
     */
    public static function getContent($object)
    {
        if (!\Reach\Helpers::isValidClass($object, ['WP_Post_Type', 'WP_Taxonomy', 'WP_Term', 'WP_Query'])) {
            return false;
        }

        $templatePage = self::getTemplatePage($object);

        if (empty($templatePage) || $templatePage->post_status !== 'publish') {
            return false;
        }

        return \apply_filters('the_content', $templatePage->post_content);
    }


    /**
     * Retrieves the Template Page for a specific object, if it exists.
     *
     * @param object $object A WP_Post_Type, WP_Taxonomy, WP_Term, or WP_Query which might have a template page set.
     * @return \WP_Post|bool The post object, or false if the $object argument isn't valid or no template is set.
     */
    public static function getTemplatePage($object)
    {
        if (!\Reach\Helpers::isValidClass($object, ['WP_Post_Type', 'WP_Taxonomy', 'WP_Term', 'WP_Query'])) {
            return false;
        }

        if ($object instanceof \WP_Term) {
            $templateId = \get_term_meta($object->term_id, 'template_page', true);

            // Fallback: term's taxonomy template used for terms without a set template page.
            if (empty($templateId)) {
                $templateId = \get_option("{$object->taxonomy}_template_page", 0);
            }
        } elseif ($object instanceof \WP_Query && $object->is_404()) {
            $templateId = \get_option('404_template_page', 0);
        } else {
            $templateId = \get_option("{$object->name}_template_page", 0);
        }

        // Filter the template ID.
        // Allows us to hook in for multi-lingual sites.
        $templateId = \apply_filters('reach/templates/template-page-id', $templateId, $object);


        if (!empty($templateId)) {
            $templatePage = \get_post($templateId);

            if (!empty($templatePage) && $templatePage->post_status !== 'trash') {
                return $templatePage;
            }
        }

        return false;
    }

    /**
     * Retrieves the object that the given Template Page is linked to, if one exists.
     *
     * @param \WP_Post $page The Template Page which may be linked to a WP object (WP_Post_Type or WP_Term), or 404 page.
     * @return ?object The object linked to the given Template Page, or null if there is nothing linked.
     */
    public static function getTemplatedObject(\WP_Post $page): ?object
    {
        $objectData = \get_post_meta($page->ID, 'reach-template-page-data', true);

        if (empty($objectData)) {
            return null;
        }

        if ($objectData->type === 'wp_post_type') {
            $object = \get_post_type_object($objectData->id);
        } elseif ($objectData->type === 'wp_term') {
            $object = \get_term_by('term_taxonomy_id', $objectData->id);
        } elseif ($objectData->type === 'wp_taxonomy') {
            $object = \get_taxonomy($objectData->id);
        } elseif ($objectData->type === '404') {
            $object = (object) $objectData;
        }

        if (!empty($object)) {
            return $object;
        }

        return null;
    }

    /**
     * Get the term currently being edited on the edit.php screen in the WordPress admin.
     *
     * @return \WP_Term|null The term object or null on failure.
     */
    public static function getTermBeingEdited()
    {
        global $taxnow;

        if (empty($taxnow) || empty($_GET['tag_ID'])) {
            return null;
        }

        $term_id = \absint($_GET['tag_ID']);
        $term    = \get_term($term_id, $taxnow);

        return $term instanceof \WP_Term ? $term : null;
    }

    /**
     * Retrieves the list of taxonomy names that can have a template assigned.
     *
     * @return array An array of taxonomy names that can have a template assigned.
     */
    public static function getTemplateTaxonomies(): array
    {
        return \apply_filters('reach/templates/taxonomies', []);
    }

    /**
     * Retrieves the list of post type names that can have a template assigned.
     *
     * @return array An array of post type names that can have a template assigned.
     */
    public static function getTemplatePostTypes(): array
    {
        return \apply_filters('reach/templates/post-types', []);
    }

    /**
     * Deletes a template page option field when the related template page post is trashed.
     *
     */
    public static function removeTemplateOption($post_id, $post): void
    {
        // Bail early - wrong post type.
        if (\get_post_type($post_id) !== self::SLUG) {
            return;
        }

        $object = self::getTemplatedObject($post);

        // Bail early - no templated object found.
        if (empty($object)) {
            return;
        }

        if ($object instanceof \WP_Post_Type || $object instanceof \WP_Taxonomy) {
            \delete_option("{$object->name}_template_page");
        } elseif ($object instanceof \WP_Term) {
            \delete_term_meta($object->term_id, 'template_page');
        } elseif ($object->type === '404') {
            \delete_option('404_template_page');
        }

        return;
    }
}
