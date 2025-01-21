<?php

namespace Reach;

class Config
{
    public static function init(): void
    {
        \add_action('after_setup_theme', [__CLASS__, 'addConfig']);
    }

    /**
     * Adds Reach settings from reach.json configuration file via filters.
     *
     * @return void
     */
    public static function addConfig(): void
    {
        if (!file_exists(\get_theme_file_path('reach.json'))) {
            return;
        }

        $file = file_get_contents(
            \get_theme_file_path('reach.json')
        );

        if (empty($file)) {
            return;
        }

        $config = json_decode($file, true);

        if (empty($config) || empty($config['settings']) || !is_array($config['settings'])) {
            return;
        }

        foreach ($config['settings'] as $key => $value) {
            \add_filter("reach/config/$key", function () use ($value) {
                return $value;
            }, 1);
        }
    }
}
