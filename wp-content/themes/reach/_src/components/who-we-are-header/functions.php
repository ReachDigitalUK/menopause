<?php

namespace Reach\Components\WhoWeAre;

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
        'who-we-are',
        'wp-block',
    ], $args['classes']);

    if (!empty($args['heading'])) {
        $args['heading'] = [
            'heading' => $args['heading'],
            'classes' => ['who-we-are__heading'],
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
