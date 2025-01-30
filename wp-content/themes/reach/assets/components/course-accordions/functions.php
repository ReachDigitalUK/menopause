<?php

namespace Reach\Components\CourseAccordions;

function filterArgs(array $args): ?array
{
    // -------------------------------------------------------------------------
    // Default arguments.
    // -------------------------------------------------------------------------
    $args = array_merge([
        'classes' => [],
        'accordion' => [],
        'heading' => 'Hello World',
        'background_gradient_start' => '',
        'background_gradient_end' => '',
        'background_gradient_angle' => 0,
        'bring_below_up' => false
    ], $args);

    if (!empty($args['background_gradient_start']) && !empty($args['background_gradient_end'])) {
        $args['attributes']['style'] = 'background: linear-gradient(' . $args['background_gradient_angle'] . 'deg, ' . $args['background_gradient_start'] . ' 0%, ' . $args['background_gradient_end'] . ' 100%);';
        $args['classes'][] = 'has-background-gradient';
    }

    if ($args['bring_below_up']) {
        $args['classes'][] = 'bring-below-up';
    }

    // -------------------------------------------------------------------------
    // Required classes.
    // -------------------------------------------------------------------------
    $args['classes'] = array_merge([
        'course-accordions',
        'wp-block',
    ], $args['classes']);

    if (!empty($args['heading'])) {
        $args['heading'] = [
            'heading' => $args['heading'],
            'classes' => ['course-accordions__heading'],
        ];
    }

    if (!empty($args['margin'])) {
        $args['attributes']['style']['--text-margin'] = implode(' ', $args['margin']);
    }
    if (!empty($args['padding'])) {
        $args['attributes']['style']['--text-padding'] = implode(' ', $args['padding']);
    }
    if (!empty($args['background_colour'])) {
        $args['attributes']['style']['--text-background-colour'] = $args['background_colour'];
    }
    if (!empty($args['text_colour'])) {
        $args['attributes']['style']['--text-text-colour'] = $args['text_colour'];
    }
    if (!empty($args['column_size'])) {
        $args['attributes']['style']['--text-column-size'] = $args['column_size'];
    }
    if (!empty($args['text_align'])) {
        $args['attributes']['style']['--text-text-align'] = $args['text_align'];
    }

    // -------------------------------------------------------------------------
    // Return the filtered args.
    // -------------------------------------------------------------------------
    return $args;
}
