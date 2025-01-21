<?php

namespace Reach\Components\ImageGrid;

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
        'image-grid',
        'wp-block',
    ], $args['classes']);

    if (!empty($args['heading'])) {
        $args['heading'] = [
            'heading' => $args['heading'],
            'classes' => ['image-grid__heading'],
        ];
    }
    if (!empty($args['margin'])) {
        $args['attributes']['style']['--image-grid-margin'] = implode(' ', $args['margin']);
    }
    if (!empty($args['padding'])) {
        $args['attributes']['style']['--image-grid-padding'] = implode(' ', $args['padding']);
    }
    if (!empty($args['background_colour'])) {
        $args['attributes']['style']['--image-grid-background-colour'] = $args['background_colour'];
    }
    if (!empty($args['columns'])) {
        $args['attributes']['style']['--image-grid-column-size'] = $args['columns'];
    }
    if (!empty($args['text_colour'])) {
        $args['attributes']['style']['--image-grid-text-colour'] = $args['text_colour'];
    }
    if (!empty($args['column_gap'])) {
        $args['attributes']['style']['--image-grid-column-gap'] = $args['column_gap'];
    }
    if (!empty($args['image_block_height'])) {
        $args['attributes']['style']['--image-grid-block-height'] = $args['image_block_height'] . 'dvh';
    }
    if (!empty($args['heading_alignment'])) {
        $args['attributes']['style']['--image-grid-heading-alignment'] = $args['heading_alignment'];
    }

    if (!empty($args['images'])) {
        foreach ($args['images'] as $key => $image) {
            $args['images'][$key]['attributes']['class'] = ['image-grid__images__image'];
            $args['images'][$key]['attributes']['style']['--image-grid-block-background'] = "url('" . $image['image']['url'] . "')";
            $args['images'][$key]['attributes']['style']['--image-grid-block-overlay-colour'] = $image['image_overlay_colour'];
            $args['images'][$key]['attributes']['style']['--image-grid-block-overlay-opacity'] = $image['image_overlay_opacity'] . '%';
            $args['images'][$key]['attributes']['style']['--image-grid-block-content-position'] = $image['content_position'];
        }
    }

    // -------------------------------------------------------------------------
    // Return the filtered args.
    // -------------------------------------------------------------------------
    return $args;
}
