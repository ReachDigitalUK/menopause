<?php

namespace Reach\Components\Heading;

function filterArgs(array $args): ?array
{
    // ---------------------------------------
    // Default arguments.
    // ---------------------------------------
    $args = array_merge([
        'el' => 'h2',
        'heading' => '',
        'id' => null,
        'link' => null,
        'target' => null,
        'attributes' => [],
        'classes' => [],
    ], $args);

    // Wrap the heading content in a link if one is provided.
    if (!empty($args['link'])) {
        $args['heading'] = \Reach\Component::get('link', [
            'url' => $args['link'],
            'content' => $args['heading'],
            'target' => $args['target'] ?? null,
        ]);
    }

    // Set 'content' arg after all 'heading' arg processing.
    $args['content'] = $args['heading'];

    if (!empty($args['id'])) {
        $args['attributes']['id'] = $args['id'];
    }

    // -------------------------------------------------------------------------
    // Return the filtered args.
    // -------------------------------------------------------------------------
    return $args;
}
