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
    
        // Get categories and select only the first one (non-link)
        $categories = get_the_category($featured_post->ID);
        $first_category = !empty($categories) ? esc_html($categories[0]->name) : 'Uncategorized';
    
        $args['feautured_post'] = [
            'post_title' => $featured_post->post_title ?? 'Default Title',
            'post_date' => $formatted_date ?? 'No Date',
            'post_category' => $first_category, // Now it's plain text, no link
            'post_image' => has_post_thumbnail($featured_post->ID) ? get_the_post_thumbnail_url($featured_post->ID, 'full') : null,
            'post_link' => get_permalink($featured_post->ID),
        ];
    }

    if (!empty($args['margin'])) {
        $args['attributes']['style']['--text-margin'] = implode(' ', $args['margin']);
    }
    if (!empty($args['padding'])) {
        $args['attributes']['style']['--text-padding'] = implode(' ', $args['padding']);
    }
    if (!empty($args['background_colour'])) {
        $args['attributes']['style']['--text-background-colour'] = $args['background_colour'];
    }
    if (!empty($args['text_colour'])) {
        $args['attributes']['style']['--text-text-colour'] = $args['text_colour'];
    }
    if (!empty($args['column_size'])) {
        $args['attributes']['style']['--text-column-size'] = $args['column_size'];
    }
    if (!empty($args['text_align'])) {
        $args['attributes']['style']['--text-text-align'] = $args['text_align'];
    }



    // -------------------------------------------------------------------------
    // Return the filtered args.
    // -------------------------------------------------------------------------
    return $args;
}
