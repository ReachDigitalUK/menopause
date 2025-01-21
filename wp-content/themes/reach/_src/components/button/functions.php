<?php

namespace Reach\Components\Button;

function filterArgs(array $args): ?array
{
    // ---------------------------------------
    // Default arguments.
    // ---------------------------------------
    $args = array_merge([
        'content' => '',
        'classes' => [],
        'visually-hidden-text' => false,
        'type' => 'button'
    ], $args);

    // ---------------------------------------
    // Bail early - return null for no output.
    // ---------------------------------------
    if (empty($args['content'])) {
        return null;
    }

    if (!empty($args['visually-hidden-text'])) {
        $args['content'] = \Reach\Component::get('element', [
            'content' => $args['content'],
            'classes' => [
                'visually-hidden',
            ],
        ]);
    }

    $args['attributes']['type'] = $args['type'];

    // -------------------------------------------------------------------------
    // Return the filtered args.
    // -------------------------------------------------------------------------
    return $args;
}
