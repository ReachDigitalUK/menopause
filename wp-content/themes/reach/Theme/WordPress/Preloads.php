<?php

namespace Theme\WordPress;

class Preloads
{
    public static function init()
    {
        \add_filter('reach/wordpress/head/preload_assets', [__CLASS__, 'addPreloads']);
    }

    /**
     * Add preloads to the <head> via the 'reach/wordpress/head/preload_assets' filter.
     *
     * @see Reach/Wordpress/Head.php
     *
     * @param array $preloads An array of preload link attribute arrays.
     * @return array The filtered preload links array, with any preloads appended.
     */
    public static function addPreloads(array $preloads): array
    {
        $preloads = array_merge($preloads, [
            // [
            //     'href' => \Reach\Asset::URL('static/WebFont-Regular.woff2'),
            //     'fetchpriority' => 'low',
            //     'type' => 'font/woff2',
            //     'as' => 'font',
            // ],
        ]);

        return $preloads;
    }
}
