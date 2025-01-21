<?php

namespace Reach\Components\ImageSlideshow;

function filterArgs(array $args): ?array
{
    // -------------------------------------------------------------------------
    // Default arguments.
    // -------------------------------------------------------------------------
    $args = array_merge([
        'classes' => [],
        'slides' => []
    ], $args);

    // -------------------------------------------------------------------------
    // Required classes.
    // -------------------------------------------------------------------------
    $args['classes'] = array_merge([
        'image-slideshow',
        'wp-block',
    ], $args['classes']);

    if (!empty($args['transition_time'])) {
        $args['attributes']['style']['--image-slideshow--transition-time'] = $args['transition_time'] . 's';
        $args['attributes']['data-transitiontime'] = $args['transition_time'] * 1000;
    }

    if (!empty($args['slides'])) {
        foreach ($args['slides'] as $index => $slide) {
            if (!empty($slide['link'])) {
                $linkArgs = $slide['link'];
                $linkArgs['classes'] = ['gemstone-button', 'solid'];
                $args['slides'][$index]['link'] = \Reach\Component::get('link', $linkArgs);
            }
        }
    }

    if (!empty($args['block_width'])) {
        switch ($args['block_width']) {
            case 'full':
                $args['attributes']['style']['--image-slideshow--block-width'] = $args['block_width'];
                break;
        }
    }

    if (!empty($args['block_height'])) {
        $args['attributes']['style']['--image-slideshow--block-height'] = $args['block_height'] . 'dvh';
    }

    if (!empty($args['text_colour'])) {
        $args['attributes']['style']['--image-slideshow--text-colour'] = $args['text_colour'];
    }
    if (!empty($args['link_colour'])) {
        $args['attributes']['style']['--image-slideshow--link-colour'] = $args['link_colour'];
    }
    if (!empty($args['background_colour'])) {
        $args['attributes']['style']['--image-slideshow--background-colour'] = $args['background_colour'];
    }

    if (!empty($args['margin'])) {
        $args['attributes']['style']['--image-slideshow--margin'] = implode(' ', $args['margin']);
    }

    if (!empty($args['padding'])) {
        $args['attributes']['style']['--image-slideshow--padding'] = implode(' ', $args['padding']);
    }

    if (!empty($args['image_border_radius'])) {
        $args['attributes']['style']['--image-slideshow--image-border-radius'] = implode(' ', $args['image_border_radius']);
    }

    // -------------------------------------------------------------------------
    // Return the filtered args.
    // -------------------------------------------------------------------------
    return $args;
}
