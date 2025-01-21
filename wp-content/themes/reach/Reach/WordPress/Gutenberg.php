<?php

namespace Reach\WordPress;

class Gutenberg
{
    public static function init(): void
    {
        \add_action('init', [__CLASS__, 'setColorPalette']);
        \add_action('after_setup_theme', [__CLASS__, 'gutenbergSupport']);
        \add_filter('block_categories_all', [__CLASS__, 'gutenbergBlockCategory']);
    }

    public static function gutenbergSupport(): void
    {
        // Add custom CSS support for Gutenberg.
        // Not to be confused with custom CSS support for TinyMCE (editor-style).
        \add_theme_support('editor-styles');

        // Add the CSS file path to be enqueued by WordPress.
        // The path to the asset must be relative to the theme root.
        $file = \Reach\Asset::extract('editor.css');
        if (!empty($file)) {
            \add_editor_style(\Reach\Paths::themeAssetPath($file, true));
        }

        // Add support for embeds to responsively keep their aspect ratio.
        \add_theme_support('responsive-embeds');

        // Deactivate the block directory.
        \remove_action('enqueue_block_editor_assets', 'wp_enqueue_editor_block_directory_assets');
        \remove_action('enqueue_block_editor_assets', 'gutenberg_enqueue_block_editor_assets_block_directory');

        // Deactivate block patterns.
        \remove_theme_support('core-block-patterns');
    }

    /**
     * Filters the Gutenberg block categories array to add a custom category.
     *
     * @link https://developer.wordpress.org/reference/hooks/block_categories/
     *
     * @param array[] $categories A list of registered block categories.
     * @return array[] The filtered list of registered block categories.
     */
    public static function gutenbergBlockCategory($categories): array
    {
        // Plugin’s block category title and slug.
        $blockCategory = [
            'title' => \esc_html__('Reach Blocks', 'reach'),
            'slug' => 'reach-blocks'
        ];

        $categorySlugs = \wp_list_pluck($categories, 'slug');

        // Bail early - this category slug is already registered.
        if (in_array($blockCategory['slug'], $categorySlugs, true)) {
            return $categories;
        }

        array_unshift($categories, $blockCategory);

        return $categories;
    }

    /**
     * Define Reach's color palette (from the theme.json file), to be used elsewhere.
     *
     * @return void
     */
    public static function setColorPalette(): void
    {
        $theme_json = json_decode(file_get_contents(\get_theme_file_path('theme.json')));

        if (!empty($theme_json->settings->color->palette)) {
            $color_palette_arrs = [];

            foreach ($theme_json->settings->color->palette as $color_palette_obj) {
                $color_palette_arrs[] = (array) $color_palette_obj;
            }

            define('REACH_COLOR_PALETTE', $color_palette_arrs);
        }
    }
}
