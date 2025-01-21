<?php

/**
 * Handles core 'Post' post type related functionality.
 */

namespace Theme\PostTypes;

class Post
{
    protected const SLUG = 'post';

    public static function init(): void
    {
        \add_filter('reach/templates/post-types', [__CLASS__, 'filterReachTemplatesPostTypes']);
    }

    /**
     * Filter the Reach Templates Post Types array to enable Template Pages for this post type.
     *
     * @see /Reach/WordPress/TemplatePage.php
     *
     * @return array The filtered post type array.
     */
    public static function filterReachTemplatesPostTypes($postTypes)
    {
        $postTypes[] = self::SLUG;
        return $postTypes;
    }
}
