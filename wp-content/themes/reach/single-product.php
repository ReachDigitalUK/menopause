<?php

/**
 * The template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 1.6.4
 */

defined('ABSPATH') || exit;

$product = wc_get_product($post);

get_header('shop');

echo '<div class="reach-woocommerce">';

$components = [];

$components[] = \Reach\Component::get('product-details', ['product' => $product]);

// $components[] = \Reach\Component::get('reviews');
// $components[] = \Reach\Component::get('did-you-know');

$components[] = '</div>';

echo implode($components);

do_action('woocommerce_after_main_content');

get_footer('shop');
