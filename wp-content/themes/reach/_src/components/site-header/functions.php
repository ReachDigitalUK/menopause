<?php

namespace Reach\Components\SiteHeader;

function filterArgs(array $args): ?array
{
    // ---------------------------------------
    // Default arguments.
    // ---------------------------------------
    $args = array_merge([
        'content' => [],
        'classes' => [],
    ], $args);

    // ---------------------------------------
    // Required classes.
    // ---------------------------------------
    $args['classes'] = array_merge([
        'site-header',
    ], $args['classes']);

    if ($header_call_to_action_1 = get_field('header_call_to_action_1', 'option')) {
        $args['content']['call_to_action_1'] = $header_call_to_action_1;
        $args['content']['call_to_action_1']['classes'] = [
            'reach-button',
            'site-header__call-to-action-1',
        ];
    }

    // -------------------------------------------------------------------------
    // Return the filtered args.
    // -------------------------------------------------------------------------
    return $args;
}
