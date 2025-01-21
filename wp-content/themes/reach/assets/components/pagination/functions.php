<?php

namespace Reach\Components\Pagination;

function filterArgs(array $args): ?array
{
    // ---------------------------------------
    // Default arguments.
    // ---------------------------------------
    $args = array_merge([
        'classes' => [],
    ], $args);

    // ---------------------------------------
    // Required classes.
    // ---------------------------------------
    $args['classes'] = array_merge([
        'pagination',
        'alignfull',
        'wp-block',
    ], $args['classes']);

    $args['output'] = \get_the_posts_pagination([
        'prev_text' => \__('Previous page', 'reach'),
        'next_text' => \__('Next page', 'reach'),
        'before_page_number' => \Reach\Component::get('element', [
            'content' => \__('Page', 'reach'),
            'classes' => ['visually-hidden'],
        ]),
        'class' => 'pagination__inner',
    ]);

    // ---------------------------------------
    // Bail early - return null for no output.
    // ---------------------------------------
    if (empty($args['output'])) {
        return null;
    }

    // -------------------------------------------------------------------------
    // Return the filtered args.
    // -------------------------------------------------------------------------
    return $args;
}

/**
 * Filters the navigation markup template to insert 'visually-hidden' utility class.
 *
 * @link https://developer.wordpress.org/reference/hooks/navigation_markup_template/
 *
 * @param string $template The default navigation template markup.
 * @return string The filtered navigation template markup.
 */
function filterPaginationMarkupTemplate(string $template): string
{
    return str_replace('screen-reader-text', 'visually-hidden', $template);
}
