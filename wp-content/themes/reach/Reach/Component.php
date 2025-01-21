<?php

namespace Reach;

class Component extends Partial
{
    /**
     * Constructor.
     *
     * @param string $name The Component's name.
     * @param array $args The arguments to pass to the Component.
     */
    public function __construct(public readonly string $name, $args = [])
    {
        parent::__construct("assets/components/$name", $args);
    }

    /**
     * Initialise class to set up hooks and filters for all Components.
     */
    public static function init(): void
    {
        \add_action('after_setup_theme', [__CLASS__, 'loadComponentFunctions']);
        \add_action('after_setup_theme', [__CLASS__, 'loadComponentHooks']);

        \add_action('acf/init', [__CLASS__, 'loadComponentBlocks']);

        \add_filter('acf/settings/load_json', [__CLASS__, 'loadBlockFieldGroupJSON']);
        \add_filter('acf/json/save_paths', [__CLASS__, 'saveBlockFieldGroupJSON'], 10, 2);

        \add_action('reach/partial/before', [__CLASS__, 'enqueueScripts'], 10, 3);
        \add_action('reach/partial/before', [__CLASS__, 'enqueueStyles'], 10, 3);

        // Enable saving non-block ACF groups into component directories.
        \add_filter('acf/field_group/additional_group_settings_tabs', [__CLASS__, 'addSaveLocationSettingsTab']);
        \add_action('acf/field_group/render_group_settings_tab/reach_acf_field_group_settings', [__CLASS__, 'renderSaveLocationDropdownFields']);
    }

    /**
     * Load all components' functions.php files.
     *
     * @return void
     */
    public static function loadComponentFunctions(): void
    {
        self::require(
            glob(\Reach\Paths::themeAssetPath('components/{**/*,*}/functions.php'), GLOB_BRACE)
        );
    }

    /**
     * Load all components' hooks.php files.
     *
     * @return void
     */
    public static function loadComponentHooks(): void
    {
        self::require(
            glob(\Reach\Paths::themeAssetPath('components/{**/*,*}/hooks.php'), GLOB_BRACE)
        );
    }

    /**
     * Load all component's block.json files to register their ACF blocks.
     *
     * @return void
     */
    public static function loadComponentBlocks(): void
    {
        $block_json_files = glob(\Reach\Paths::themeAssetPath('components/*/block.json'));

        foreach ($block_json_files as $file_path) {
            \register_block_type($file_path);
        }
    }

    /**
     * Helper function to load multiple 'required' files, e.g. functions.php, hook.php, etc.
     *
     * Uses require_once, despite the function name.
     *
     * @param array $files File paths to require.
     * @return void
     */
    private static function require(array $files): void
    {
        $files = \apply_filters('reach/component/require_files', $files);

        foreach ($files as $key => $file) {
            require_once $file;
        }
    }

    /**
     * Enqueue a component's block.js file, if one exists, when it is rendered.
     *
     * @param string $path The component path.
     * @param array $args The component arguments
     * @param Component $component The component object
     * @return void
     */
    public static function enqueueScripts(string $path, array $args, Component $component): void
    {
        self::enqueueScriptByFilename($component->name);
    }

    /**
     * Enqueue a JS file from a component's scripts directory, if it exists.
     *
     * @param string $name The component name.
     * @param string $script The script file name. Default 'block'.
     * @return void
     */
    public static function enqueueScriptByFilename(string $name, string $script = 'block'): void
    {
        $jsPath = \Reach\Asset::extract("components/$name/scripts/$script.js");

        if (empty($jsPath)) {
            return;
        }

        if (!file_exists(\Reach\Paths::themeAssetPath($jsPath))) {
            return;
        }

        \wp_enqueue_script(
            "$name-scripts",
            \Reach\Asset::URL($jsPath),
            \apply_filters("reach/partial/$name/enqueue_script_dependencies", []),
            \apply_filters("reach/partial/$name/enqueue_script_in_footer", false),
        );
    }

    /**
     * Enqueue a component's block.css file, if one exists, when it is rendered.
     *
     * @param string $path The component path.
     * @param array $args The component arguments
     * @param Component $component The component object
     * @return void
     */
    public static function enqueueStyles(string $path, array $args, Component $component): void
    {
        self::enqueueStyleByFilename($component->name);
    }

    /**
     * Enqueue a CSS file from a component's styles directory, if it exists.
     *
     * @param string $name The component name.
     * @param string $script The style file name. Default 'block'.
     * @return void
     */
    public static function enqueueStyleByFilename(string $name, string $style = 'block'): void
    {
        $cssPath = \Reach\Asset::extract("components/$name/styles/$style.css");

        if (empty($cssPath)) {
            return;
        }

        if (!file_exists(\Reach\Paths::themeAssetPath($cssPath))) {
            return;
        }

        \wp_enqueue_style(
            "$name-styles",
            \Reach\Asset::URL($cssPath),
            \apply_filters("reach/partial/$name/enqueue_style_dependencies", []),
        );
    }

    /**
     * Retrieve the current Component or the closest Component ancestor of the current Partial.
     *
     * @return Component|null The current Component in the stack or null if none set.
     */
    public static function getCurrentComponent(): ?Component
    {
        if (empty(static::$partialStack)) {
            return null;
        }

        foreach (static::$partialStack as $partial) {
            if ($partial instanceof Component) {
                return $partial;
            }
        }

        return null;
    }

    /**
     * Load ACF block field groups from components' JSON files.
     *
     * @see saveBlockFieldGroupJSON()
     * @link https://www.advancedcustomfields.com/resources/local-json/
     *
     * @param array $paths An array of potential paths to load JSON from.
     * @return array The filtered array of paths to load JSON from.
     */
    public static function loadBlockFieldGroupJSON(array $paths): array
    {
        return array_merge(
            $paths,
            glob(\Reach\Paths::themeAssetPath('components/*'))
        );
    }

    /**
     * Conditionally save ACF field group JSON files into custom directories.
     *
     * @see loadBlockFieldGroupJSON()
     * @link https://www.advancedcustomfields.com/resources/local-json/
     *
     * @param array $paths An array of possible save paths for the JSON file.
     * @param array $group The settings for the field group, post type, taxonomy, or options page.
     * @param array $paths The filtered array of possible save paths for the JSON file.
     */
    public static function saveBlockFieldGroupJSON(array $paths, array $group): array
    {
        $componentName = '';

        if (!empty($group['reach_save_location'])) {
            $componentName = $group['reach_save_location'];
        } else if (!empty($group['location'][0][0]['param']) && $group['location'][0][0]['param'] === 'block') {
            $componentName = str_replace('acf/', '', $group['location'][0][0]['value']);
        }

        $componentPath = self::getFullComponentPath($componentName);

        if (empty($componentPath)) {
            return $paths;
        }

        return [$componentPath];
    }

    /**
     * Retrieve a full path for a specific component.
     *
     * @param string $componentName The name of the component.
     * @return string|null The full path of the component. Null if nothing found.
     */
    public static function getFullComponentPath(string $componentName): ?string
    {
        if (empty($componentName)) {
            return null;
        }

        // Should only return a one-item array (unless there is a component name collision).
        $componentPaths = glob(\get_theme_file_path("_src/components*/$componentName"), GLOB_ONLYDIR);

        // Bail early - no directory found via glob.
        if (empty($componentPaths) || !is_array($componentPaths)) {
            return null;
        }

        // Bail early - invalid component path found.
        if (empty($componentPaths[0]) || !is_dir($componentPaths[0])) {
            return null;
        }

        return $componentPaths[0];
    }

    /**
     * Add a Reach Settings tab to all field groups settings.
     *
     * @param array $tabs An array of custom ACF field group tabs.
     * @return array The filtered array of custom ACF field group tabs.
     */
    public static function addSaveLocationSettingsTab(array $tabs): array
    {
        $tabs['reach_acf_field_group_settings'] = \__('Reach Settings', 'reach');
        return $tabs;
    }

    /**
     * Render save location dropdown in custom ACF Reach Settings tab.
     *
     * @param array $field_group An array of field group settings.
     * @return void
     */
    public static function renderSaveLocationDropdownFields(array $field_group): void
    {
        $componentDirPaths = glob(\get_theme_file_path("_src/components*/*"));

        // Bail early - no component directories found.
        if (empty($componentDirPaths) || !is_array($componentDirPaths)) {
            return;
        }

        // Generate dropdown options from all component directory names.
        $choicesArray = [];
        foreach ($componentDirPaths as $componentDirPath) {
            $componentName = substr($componentDirPath, strrpos($componentDirPath, '/') + 1);

            // Skip '_template' component.
            if (\str_starts_with($componentName, '_')) {
                continue;
            }

            $choicesArray[$componentName] = ucwords(str_replace(['-', 'wp'], [' ', 'WP'], $componentName));
        }

        ksort($choicesArray); // Alphabetise components.

        \acf_render_field_wrap(
            [
                'label' => \__('Save Location', 'reach'),
                'type' => 'select',
                'prefix' => 'acf_field_group',
                'name' => 'reach_save_location',
                'value' => isset($field_group['reach_save_location']) ? $field_group['reach_save_location'] : 0,
                'choices' => [
                    \__('Default save location', 'reach'),
                    \__('Component Folder', 'reach') => $choicesArray, // Component group.
                ],
                'instructions' => \__("Select a custom location to save this field group's JSON file.", 'reach'),
            ],
            'div',
            'label',
        );
    }

    /**
     * The default render callback used for ACF blocks.
     *
     * @param array $block The array of block attributes passed to ACF's render_callback.
     * @param string $content The block content.
     * @param boolean $is_preview Whether the block is being rendered for editing preview.
     * @param integer $post_id The current post being edited or viewed.
     * @return void
     */
    public static function acfRenderCallback(array $block, string $content = '', bool $is_preview = false, int $post_id = 0): void
    {
        $args = parent::generateArgsFromBlock($block, \get_fields(), $content, $is_preview, $post_id);

        echo self::get(str_replace('acf/', '', $block['name']), $args);
    }
}
