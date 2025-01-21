<?php

namespace Reach\Components\HeaderSearch;

function filterArgs(array $args): ?array
{
    // ---------------------------------------
    // Default arguments.
    // ---------------------------------------
    $args = array_merge([
        'input_id' => \wp_unique_id('header-search-'),
        'background_color' => 'brand-2',
        'classes' => [],
        'attributes' => [],
    ], $args);

    // ---------------------------------------
    // Required classes.
    // ---------------------------------------
    $args['classes'] = array_merge([
        'header-search',
    ], $args['classes']);

    // ---------------------------------------
    // Default attributes.
    // ---------------------------------------
    $args['attributes'] = array_merge([
        'autocomplete' => 'off',
        'method' => 'get',
        'action' => \home_url('/'),
        'role' => 'search',
        'hidden' => 'hidden',
        'aria-hidden' => 'true',
    ], $args['attributes']);

    $args['submit-button'] = [
        'content' => \__('Search', 'reach'),
        'type' => 'submit',
        'classes' => [
            'header-search__submit',
            'reach-button',
        ],
        'attributes' => [
            'aria-label' => \__('Submit search', 'reach'),
        ],
    ];

    // -------------------------------------------------------------------------
    // Return the filtered args.
    // -------------------------------------------------------------------------
    return $args;
}
