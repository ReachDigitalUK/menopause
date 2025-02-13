<?php

namespace Reach\Components\JumpTo;

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
        'jump-to',
        'wp-block',
    ], $args['classes']);

    if (!empty($args['heading'])) {
        $args['heading'] = [
            'heading' => $args['heading'],
            'classes' => ['jump-to__heading'],
        ];
    }

    if (!empty($args['background_colour'])) {
        $args['attributes']['style']['--flag-background-colour'] = $args['background_colour'];
    }
    if (!empty($args['text_colour'])) {
        $args['attributes']['style']['--flag-text-colour'] = $args['text_colour'];
    }
    if (!empty($args['image_settings']['media_side'])) {
        $args['attributes']['style']['--flag-media-direction'] = $args['image_settings']['media_side'];
    }
    if (!empty($args['image_settings']['image_overlay_colour'])) {
        $args['attributes']['style']['--flag-image-overlay-colour'] = $args['image_settings']['image_overlay_colour'];
    }
    if (!empty($args['image_settings']['image_overlay_opacity'])) {
        $args['attributes']['style']['--flag-image-overlay-opacity'] = $args['image_settings']['image_overlay_opacity'] . '%';
    }
    if (!empty($args['image_settings']['align_items'])) {
        $args['attributes']['style']['--flag-image-align-items'] = $args['image_settings']['align_items'];
    }
    if (!empty($args['image_settings']['image_border_color'])) {
        $args['attributes']['style']['--flag-image-border-color'] = $args['image_settings']['image_border_color'];
    }
    if (!empty($args['image_settings']['image_border_tilt'])) {
        $args['attributes']['style']['--flag-image_border_tilt'] = $args['image_settings']['image_border_tilt'];
    }


    // -------------------------------------------------------------------------
    // Return the filtered args.
    // -------------------------------------------------------------------------
    return $args;
}
