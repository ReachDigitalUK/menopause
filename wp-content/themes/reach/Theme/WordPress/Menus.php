<?php

namespace Theme\WordPress;

class Menus
{
    public static function init()
    {
        \add_filter('after_setup_theme', [__CLASS__, 'registerThemeMenus']);
    }

    /**
     * Register theme menus.
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    public static function registerThemeMenus(): void
    {
        \register_nav_menus([
            'header' => \_x('Header', 'Menu name', 'reach'),
            'footer-1' => \_x('Footer 1', 'Menu name', 'reach'),
            'footer-2' => \_x('Footer 2', 'Menu name', 'reach'),
        ]);
    }
}
