<?php

namespace Reach\Components\ComponentName;

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
        'componentname',
        'wp-block',
    ], $args['classes']);

    if (!empty($args['heading'])) {
        $args['heading'] = [
            'heading' => $args['heading'],
            'classes' => ['componentname__heading'],
        ];
    }

    // -------------------------------------------------------------------------
    // Return the filtered args.
    // -------------------------------------------------------------------------
    return $args;
}
