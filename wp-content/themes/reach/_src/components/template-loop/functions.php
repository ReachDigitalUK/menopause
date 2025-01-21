<?php

namespace Reach\Components\TemplateLoop;

function filterArgs(array $args): ?array
{
    // ---------------------------------------
    // Default arguments.
    // ---------------------------------------
    $args = array_merge([
        'items' => [],
        'object' => \Reach\WordPress\PageObject::get(),
        'items_component_args' => [],
        'show_taxonomy_filters' => true,
    ], $args);

    if (empty($args['items'])) {
        while (\have_posts()) {
            \the_post();
            $args['items'][]['object'] = \get_post();
        }
    }

    $args['items_component_args']['items'] = $args['items'];

    // Filterable items output component.
    $args['items_component'] = \apply_filters('reach/components/template-loop/items-component', 'post-summaries');

    // Filterable items output component arguments.
    $args['items_component_args'] = \apply_filters(
        'reach/components/template-loop/items-component/args',
        $args['items_component_args']
    );

    // -------------------------------------------------------------------------
    // Return the filtered args.
    // -------------------------------------------------------------------------
    return $args;
}
