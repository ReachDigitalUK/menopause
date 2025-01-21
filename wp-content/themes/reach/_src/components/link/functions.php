<?php

namespace Reach\Components\Link;

function filterArgs(array $args): ?array
{
    // ---------------------------------------
    // Default arguments.
    // ---------------------------------------
    $args = array_merge([
        'title' => '',
        'url' => '',
        'target' => '',
        'attributes' => [
            'rel' => [],
        ],
        'classes' => [],
        'assistive_text' => '',
        'content_filter' => 'wp_kses_post',
    ], $args);

    $args['content'] = $args['content'] ?? $args['title'];

    // ---------------------------------------
    // Bail early - return null for no output.
    // ---------------------------------------
    if (empty($args['content'])) {
        return null;
    }

    if (!empty($args['url'])) {
        $args['attributes']['href'] = $args['url'];
    }

    if (!empty($args['target'])) {
        $args['attributes']['target'] = $args['target'];
    }

    // Conditionally add appropriate rel attribute.
    if (!empty($args['attributes']['target']) && $args['attributes']['target'] === '_blank') {
        $args['attributes']['rel'][] = 'noopener';
    }

    if (!empty($args['assistive_text']) && empty($args['attributes']['aria-label'])) {
        $args['attributes']['aria-label'] = $args['assistive_text'];
    }

    if (empty($args['content_filter']) || !is_callable($args['content_filter'])) {
        $args['content_filter'] = fn($content) => $content;
    }

    // -------------------------------------------------------------------------
    // Return the filtered args.
    // -------------------------------------------------------------------------
    return $args;
}
