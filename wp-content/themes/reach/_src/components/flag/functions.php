<?php

namespace Reach\Components\Flag;

function filterArgs(array $args): ?array
{
    // -------------------------------------------------------------------------
    // Default arguments.
    // -------------------------------------------------------------------------
    $args = array_merge([
        'classes' => [],
        'heading' => 'Hello World',
        'margin' => ['1rem', '0rem', '1rem', '0rem'],
        'padding' => ['0rem', '0rem', '0rem', '0rem'],
        'image_border_radius' => ['0rem', '0rem', '0rem', '0rem'],
    ], $args);

    // -------------------------------------------------------------------------
    // Required classes.
    // -------------------------------------------------------------------------
    $args['classes'] = array_merge([
        'flag',
        'wp-block',
    ], $args['classes']);

    if (!empty($args['heading'])) {
        $args['heading'] = [
            'heading' => $args['heading'],
            'classes' => ['flag__heading'],
        ];
    }

    if (!empty($args['button'])) {
        $args['button']['classes'] = ['reach-button'];
    }

    if (!empty($args['margin'])) {
        $args['attributes']['style']['--flag-margin'] = implode(' ', $args['margin']);
    }

    if (!empty($args['padding'])) {
        $args['attributes']['style']['--flag-padding'] = implode(' ', $args['padding']);
    }

    if (!empty($args['image_border_radius'])) {
        $args['attributes']['style']['--flag-image-border-radius'] = implode(' ', $args['image_border_radius']);
    }

    if (!empty($args['image_settings']['media_size'])) {
        $args['attributes']['style']['--flag-media-size'] = $args['image_settings']['media_size'] . '%';
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


    /* for some weird reason, a balck border appears if i try to create a border width! */

    // if (!empty($args['image_settings']['image_flag_border_width'])) {
    //     $args['attributes']['style']['--flag-image-border-width'] = $args['image_settings']['image_flag_border_width'].'px';
    // }





    if (!empty($args['row_gap'])) {
        $args['attributes']['style']['--flag-row-gap'] = $args['row_gap'];
    }

    if (!empty($args['button_class'])) {
        $args['button_class'] = implode(' ', array_map('trim', explode(',', $args['button_class'])));
    }



    // -------------------------------------------------------------------------
    // Return the filtered args.
    // -------------------------------------------------------------------------
    return $args;
}
