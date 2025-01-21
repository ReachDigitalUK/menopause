<?php

namespace Theme\Plugins;

class ACF
{
    public static function init(): void
    {
        \add_action('acf/init', [__CLASS__, 'optionPages']);
        \add_action('acf/init', [__CLASS__, 'setACFGoogleAPIKey']);

        \add_action('acf/init', [__CLASS__, 'fixPreviews']);
        \add_action('acf/init', [__CLASS__, 'disableShortcode']);

        // Handles disabling Gutenberg on flexible content template
        \add_filter('gutenberg_can_edit_post_type', [__CLASS__, 'disableGutenberg'], 10, 2);
        \add_filter('use_block_editor_for_post_type', [__CLASS__, 'disableGutenberg'], 10, 2);

        // Define custom wysiwyg toolbar.
        \add_filter('acf/fields/wysiwyg/toolbars', [__CLASS__, 'filterEditorToolbarTypes']);

        // Filter the choices for any ACF field named `theme_background_color` to automatically add
        // color options from the color palette/theme.json file.
        // Note: These values will only be updated in the JSON file when the field group is saved.
        \add_filter('acf/load_field/name=theme_background_color', [__CLASS__, 'loadColorFieldChoices']);
        \add_filter('acf/load_field/name=item_theme_background_color', [__CLASS__, 'loadColorFieldChoices']);

        // Filter empty link fields to return a consistent data type.
        \add_filter('acf/load_value/type=link', [__CLASS__, 'filterEmptyLinkField']);

        // Register the "strip HTML" option to ACF wysiwyg fields' settings and use it to strip tags where needed.
        \add_action('acf/render_field_presentation_settings/type=wysiwyg', [__CLASS__, 'addStripHtmlFieldSetting']);
        \add_filter('acf/format_value/type=wysiwyg', [__CLASS__, 'stripFieldValueHtmlTags'], 20, 3);

        // Remove ACF 6.1's post type and taxonomy registration admin pages.
        \add_filter('acf/settings/enable_post_types', '__return_false');
    }

    public static function optionPages(): void
    {
        $options_pages = [
            \_x('General', 'ACF options page name', 'reach'),
            \_x('Header', 'ACF options page name', 'reach'),
            \_x('Footer', 'ACF options page name', 'reach'),
            \_x('Integrations', 'ACF options page name', 'reach'),
        ];

        if (empty($options_pages)) {
            return;
        }

        //  Create a top-level page to nest options pages under.
        \acf_add_options_page();

        // Create sub-pages.
        foreach ($options_pages as $page) {
            \acf_add_options_sub_page($page);
        }
    }

    /**
     * Set ACF's Google API key from a site option, if it exists.
     */
    public static function setACFGoogleAPIKey(): void
    {
        $option = \get_field('google_api_key', 'option');

        if (empty($option)) {
            return;
        }

        \acf_update_setting('google_api_key', $option);
    }

    public static function loadColorFieldChoices(array $field): array
    {
        $field['choices']['none'] = \__('None', 'Reach');

        if (defined('REACH_COLOR_PALETTE')) {
            foreach (REACH_COLOR_PALETTE as $color) {
                $field['choices'][$color['slug']] = $color['name'];
            }
        }

        return $field;
    }

    public static function disableGutenberg(bool $can_edit, string $post_type): bool
    {
        if (!(\is_admin() && !empty($_GET['post']))) {
            return $can_edit;
        }

        if (self::disableEditor($_GET['post'])) {
            $can_edit = false;
        }

        return $can_edit;
    }

    public static function disableEditor($id = false): bool
    {
        $excluded_templates = [
            // 'page-templates/example-template.php',
        ];

        if (empty($id)) {
            return false;
        }

        $id = intval($id);
        $template = \get_page_template_slug($id);

        return in_array($template, $excluded_templates);
    }

    /**
     * Filters ACF wysiwyg toolbar types array.
     *
     * @see /advanced-custom-fields-pro/includes/fields/class-acf-field-wysiwyg.php
     * @link https://www.advancedcustomfields.com/resources/customize-the-wysiwyg-toolbars/
     *
     * @param array[] $toolbars An array of ACF TinyMCE wysiwyg toolbar types.
     * @return array[] $toolbars The filtered array of ACF TinyMCE wysiwyg toolbar types.
     */
    public static function filterEditorToolbarTypes($toolbars): array
    {
        // Remove ACF defaults.
        unset($toolbars['Basic']);
        unset($toolbars['Full']);

        // Define 'Basic' toolbar with custom selection of TinyMCE buttons.
        $toolbars['Basic Formatting'] = [
            1 => \apply_filters('reach/acf/fields/wysiwyg/toolbars/basic', [
                'bold',
                'italic',
                'link',
                'unlink',
                'removeformat',
                'undo',
                'redo'
            ]),
        ];

        // Define 'Extended' toolbar with wider selection of TinyMCE buttons,
        // Includes bulleted lists and heading/paragraph formatting.
        $toolbars['Extended Formatting'] = [
            1 => \apply_filters('reach/acf/fields/wysiwyg/toolbars/extended', [
                'formatselect',
                'bold',
                'italic',
                'bullist',
                'numlist',
                'link',
                'unlink',
                'removeformat',
                'undo',
                'redo'
            ]),
        ];

        return $toolbars;
    }

    /**
     * Fix a long-standing issue with ACF, where fields sometimes aren't shown in
     * previews (i.e. from Preview > Open in new tab).
     *
     * @link https://support.advancedcustomfields.com/forums/topic/custom-fields-on-post-preview/#post-150273
     */
    public static function fixPreviews(): void
    {
        if (\current_user_can('edit_posts') && class_exists('acf_revisions')) {
            $acf_revs_cls = \acf()->revisions;
            \remove_filter('acf/validate_post_id', [$acf_revs_cls, 'acf_validate_post_id', 10]);
        }
    }

    /**
     * Disable ACF shortcode for security reasons.
     *
     * @link https://www.advancedcustomfields.com/blog/acf-6-0-3-release-security-changes-to-the-acf-shortcode-and-ui-improvements/
     */
    public static function disableShortcode(): void
    {
        \acf_update_setting('enable_shortcode', false);
    }

    /**
     * Filter all ACF link fields to return a more consistent data type.
     *
     * By default, ACF returns an empty string for link fields that have been created but not filled in. This filter
     * ensures that link fields always return an array in order to help prevent fatal errors caused by unexpected data
     * type mismatches.
     *
     * @param mixed $value The link field value
     * @return array $value The link field value or an empty array, for consistency.
     */
    public static function filterEmptyLinkField($value): array
    {
        if (!is_array($value)) {
            return [];
        }

        return $value;
    }

    /**
     * Add a custom "strip HTML" option to an ACF field's settings.
     *
     * @link https://www.advancedcustomfields.com/resources/acf_render_field_setting/
     *
     * @param array $field The field array.
     * @return void
     */
    public static function addStripHtmlFieldSetting($field): void
    {
        \acf_render_field_setting($field, [
            'label'        => 'Strip unwanted HTML tags?', // translations unlikely to be needed.
            'instructions' => htmlentities('Removes most tags from the loaded field value, including <p> tags.
                Useful for content that will be displayed in an <h1-6> tag.'),
            'name'         => 'strip_html_tags',
            'type'         => 'true_false',
            'ui'           => 1,
        ]);
    }

    /**
     * Conditionally strip unwanted HTML tags from a field value, based on custom field setting.
     *
     * Should happen *after* being loaded by a template function (such as `get_field()`) via the
     * `acf/format_value` filter.
     *
     * @param mixed $value The field value.
     * @param integer|string $post_id The post ID where the value is saved.
     * @param array $field The field array containing all settings.
     * @return mixed The filtered field value.
     */
    public static function stripFieldValueHtmlTags(mixed $value, int|string $post_id, array $field): mixed
    {
        // Bail early - no 'strip_html_tags' setting or set to false.
        if (empty($field['strip_html_tags'])) {
            return $value;
        }

        // Strip unwanted HTML tags, leaving only the listed tags.
        // Not an exhaustive list of allowed tags, but should cover most cases.
        return strip_tags($value, [
            'a',
            'br',
            'em',
            'span',
            'strong',
        ]);
    }
}
