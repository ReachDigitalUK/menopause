<?php

/**
 * Handles core 'Category' taxonomy related functionality.
 */

namespace Theme\Taxonomies;

class Category
{
    protected const SLUG = 'category';

    public static function init(): void
    {
        \add_filter('reach/templates/taxonomies', [__CLASS__, 'filterReachTemplatesTaxonomies']);
    }

    /**
     * Filter the Reach Templates Taxonomies array to enable Template Pages for this taxonomy.
     *
     * @see /Reach/WordPress/TemplatePage.php
     *
     * @return array The filtered taxonomy array.
     */
    public static function filterReachTemplatesTaxonomies($taxonomies): array
    {
        $taxonomies[] = self::SLUG;
        return $taxonomies;
    }
}
