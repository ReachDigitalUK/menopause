<?php

namespace Reach\Components\FeaturedNewsItem;

function filterArgs(array $args): ?array
{
    // -------------------------------------------------------------------------
    // Default arguments.
    // -------------------------------------------------------------------------
    $args = array_merge([
        'classes' => [],
        'heading' => 'Hello World',
    ], $args);

    // -------------------------------------------------------------------------
    // Required classes.
    // -------------------------------------------------------------------------
    $args['classes'] = array_merge([
        'featured-news-item',
        'wp-block',
    ], $args['classes']);

    if (!empty($args['heading'])) {
        $args['heading'] = [
            'heading' => $args['heading'],
            'classes' => ['featured-news-item__heading'],
        ];
    }

    // -------------------------------------------------------------------------
    if (isset($args['feautured_post']) && is_object($args['feautured_post'])) {
        $featured_post = $args['feautured_post'];

        $formatted_date = date_i18n('jS F Y', strtotime($featured_post->post_date));
    
        $args['feautured_post'] = [
            'post_title' => $featured_post->post_title ?? 'Default Title',
            'post_date' => $formatted_date ?? 'No Date',
            'post_category' => get_the_category_list(', ', '', $featured_post->ID) ?? 'Uncategorized',
            'post_image' => has_post_thumbnail($featured_post->ID) ? get_the_post_thumbnail_url($featured_post->ID, 'full') : null,
            'post_link' => get_permalink($featured_post->ID),
        ];

    }


    // -------------------------------------------------------------------------
    // Return the filtered args.
    // -------------------------------------------------------------------------
    return $args;
}
