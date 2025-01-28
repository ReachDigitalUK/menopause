<?php

namespace Reach\Components\Packages;

function filterArgs(array $args): ?array
{
    // -------------------------------------------------------------------------
    // Default arguments.
    // -------------------------------------------------------------------------
    $args = array_merge([
        'classes' => [],
        'heading' => 'Packages',
        'description' => 'The right package for the right reason',
        'packages' => []
    ], $args);

    // -------------------------------------------------------------------------
    // Required classes.
    // -------------------------------------------------------------------------
    $args['classes'] = array_merge([
        'packages',
        'wp-block',
    ], $args['classes']);

    if (!empty($args['heading'])) {
        $args['heading'] = [
            'heading' => $args['heading'],
            'classes' => ['packages__heading'],
        ];
    }

    if (!empty($args['packages'])) {
        $packages = [];
        foreach ($args['packages'] as $package) {
            $packages[] = [
                'product' => wc_get_product($package->ID),
                'background' => get_field('background_colour', $package->ID),
                'features' => get_field('features', $package->ID),
            ];
        }
        $args['packages'] = $packages;
    }

    // -------------------------------------------------------------------------
    // Return the filtered args.
    // -------------------------------------------------------------------------
    return $args;
}

add_filter('woocommerce_add_to_cart_redirect', function ($url, $adding_to_cart) {
    return wc_get_checkout_url();
}, 10, 2);
