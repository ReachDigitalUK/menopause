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

    // -------------------------------------------------------------------------
    // Return the filtered args.
    // -------------------------------------------------------------------------
    return $args;
}
