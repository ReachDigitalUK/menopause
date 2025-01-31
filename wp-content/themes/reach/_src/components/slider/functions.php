<?php

namespace Reach\Components\Slider;

function filterArgs(array $args): ?array
{
    // -------------------------------------------------------------------------
    // Default arguments.
    // -------------------------------------------------------------------------
    $args = array_merge([
        'cards' => [],
        'classes' => [],
        'heading' => 'Hello World',
        'type' => 'default',
        'align' => 'alignwide',
        'break_container' => false,
        'items' => [],
        'reviews' => [],
        'background_colour' => '#FFF',
    ], $args);

    if ($args['break_container']) {
        $args['classes'][] = 'break-slider-container';
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
    // Required classes.
    // -------------------------------------------------------------------------
    $args['classes'] = array_merge([
        'slider',
        'wp-block',
    ], $args['classes']);

    if (!empty($args['top_header'])) {
        $args['top_header'] = [
            'top_header' => $args['top_header'],
            'classes' => ['slider__top-header'],
        ];
    }

    if (!empty($args['all_categories'])) {
        $args['all_cats'] = $args['all_categories'];
    }

    if (!empty($args['heading'])) {
        $args['heading'] = [
            'heading' => $args['heading'],
            'classes' => ['slider__heading'],
        ];
    }

    if (!empty($args['card_source'])) {

        if ($args['card_source'] === 'recent') {
            $queryArgs = [
                'post_type' => 'post',
                'posts_per_page' => $args['limit'] ?? 10,
                'post__not_in' => [get_the_ID()],
                'no_found_rows' => true,
                'ignore_sticky_posts' => true,
            ];

            if (!empty($args['all_categories'])) {
                $queryArgs['category__in'] = $args['all_categories'];
            }

            if (!empty($args['tag'])) {
                $queryArgs['tag__in'] = $args['tag'];
            }

            $query = new \WP_Query($queryArgs);

            if ($query->have_posts()) {
                foreach ($query->posts as $key => $object) {
                    $args['items'][$key] = [
                        'object' => $object,
                    ];
                }
            }
        } elseif($args['card_source'] === 'reviews'){

            global $wpdb;
            $table_name = $wpdb->prefix .'grp_google_review';
            $query = "SELECT * FROM {$table_name} ORDER BY time DESC";
            $reviews = $wpdb->get_results($query);
            
            if ($reviews) {
                foreach ($reviews as $key => $review) {
                    $args['items'][$key] = [
                        'review' => $review,
                        'id' => $review->id, 
                        'google_place_id' => $review->google_place_id, 
                        'rating' => $review->rating, 
                        'text' => $review->text,
                        'time' => date('d/m/Y', $review->time), 
                        'author_name' => $review->author_name, 
                        'author_url' => $review->author_url, 
                        'profile_photo_url' => $review->profile_photo_url, 
                        'language' => $review->language, 
                    ];

                }

            }



        }elseif ($args['card_source'] === 'selected') {
            if (!empty($args['selected'])) {
                foreach ($args['selected'] as $key => $object) {
                    $args['items'][$key] = [
                        'object' => $object,
                    ];
                }
            }
        } elseif ($args['card_source'] === 'category' && !empty($args['slider_category'])) {
            $metaQuery = ['relation' => 'OR'];

            foreach ($args['slider_category'] as $category) {
                $metaQuery[] = [
                    'key' => 'category',
                    'value' => is_object($category) ? $category->ID : $category['id'],
                    'compare' => 'LIKE',
                ];
            }

            $sliderArgs = [
                'posts_per_page' => -1,
                'post_type' => 'listing',
                'meta_query' => $metaQuery,
            ];

            $query = new \WP_Query($sliderArgs);

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();

                    $sliderTitle = get_the_title();
                    $id = get_the_ID();
                    $author = get_the_author_meta('ID');
                    $category_id = get_field('category', $id);
                    $category = $category_id ? get_term($category_id)->name : '';
                    $background = get_field('images', $id)[0]['image'] ?? '';
                    $link = get_the_permalink();

                    $subs = wcs_get_users_subscriptions($author);

                    $accreditationLevel = '';
                    foreach ($subs as $sub) {
                        if ($sub->get_status() === 'active') {
                            foreach ($sub->get_items() as $item) {
                                $productId = $item->get_product_id();
                                $accreditationLevel = ucfirst(get_field('accreditation_level', $productId));
                            }
                        }
                    }

                    $args['items'][] = [
                        'sub_level' => $accreditationLevel,
                        'title' => $sliderTitle,
                        'categories' => $category,
                        'background' => $background,
                        'link' => $link,
                    ];
                }
                wp_reset_postdata();
            }
        }
    }

    // Adjust `type` for icons.
    if (!empty($args['type']) && $args['type'] === 'icons') {
        $args['type'] = 'icon';
    }

    // Add button classes.
    if (!empty($args['button'])) {
        $args['button']['classes'] = ['g-button'];
    }

    // Process `items` and add additional properties.
    if (!empty($args['items'])) {
        foreach ($args['items'] as $key => $card) {
            $args['items'][$key] = array_merge([
                'slider' => true,
                'type' => $args['type'],
            ], $card);

            if (!empty($args['card_background_color']) && $args['card_background_color'] !== 'default') {
                $args['items'][$key]['background'] = $args['card_background_color'];
            }

            if (!empty($args['card_image_fit']) && $args['card_image_fit'] !== 'default') {
                $args['items'][$key]['image_fit'] = $args['card_image_fit'];
            }
        }
    }

    // Add column-specific classes.
    if (!empty($args['columns']) && $args['columns'] !== 'default') {
        $args['classes'][] = 'cards--columns-' . $args['columns'];
    }

    // Adjust classes based on `align` and `slider_on_mobile`.
    if ($args['align'] !== 'full') {
        $args['slider_on_mobile'] = false;
    }

    $args['classes'][] = 'cards--type--' . $args['type'];
    $args['classes'][] = !empty($args['slider_on_mobile']) ? 'cards--slider-on-mobile' : null;

    // -------------------------------------------------------------------------
    // Return the filtered args.
    // -------------------------------------------------------------------------



    // echo '<pre>';
    // print_r($args);
    // echo '</pre>';


 return $args;
}