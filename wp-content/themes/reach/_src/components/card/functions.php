<?php

namespace Reach\Components\Card;

function filterArgs(array $args): ?array
{
    // -------------------------------------------------------------------------
    // Default arguments.
    // -------------------------------------------------------------------------
    $args = array_merge([
        'attributes' => [],
        'classes' => [],
        'type' => '',
        'background' => 'white',
        'image_size' => 'medium_large',
        'show_read_more' => true,
        'heading_class' => 'is-style-typestyle-h4',
        'content' => [
            'heading' => '',
            'text'    => '',
            'read_more' => [],
        ],
    ], $args);

    // -------------------------------------------------------------------------
    // Required classes.
    // -------------------------------------------------------------------------
    $args['classes'] = array_merge([
        'g-card',
        'animate-element',
    ], $args['classes']);

    if (!empty($args['object'])) {
        /** @var object $object */
        $object = $args['object'];

        if ($args['object'] instanceof \WP_Post) {
            $args['classes'][] = "g-card--type--" . $object->post_type;

            // -------------------------------------------------------------------------
            // Set up args from WordPress posts
            // -------------------------------------------------------------------------

            $args['content'] = [
                'heading' => \get_the_title($object->ID),
                'url' => \get_the_permalink($object->ID),
                'text' => \get_the_excerpt($object->ID),
                'meta' => '',
                'labels' => \Theme\Meta\ObjectMeta::getObjectLabels($object->ID, [
                    'limit' => 1,
                    'taxonomies' => [
                        'category',
                    ],
                ]),
            ];

            if (\has_post_thumbnail($object->ID)) {
                $args['content']['image'] = [
                    'ID' => \get_post_thumbnail_id($object->ID),
                ];
            }

            if (!\has_excerpt($object->ID)) {
                if ($page_header_content = \get_field('page_header_content', $object->ID)) {
                    $args['content']['text'] = $page_header_content;
                }
            }

            if ($object->post_type === 'post') {
                $args['type'] = 'article';
                $args['show_read_more'] = false;
                $args['content']['text'] = '';
                $args['heading_class'] = 'is-style-typestyle-h4';


                $metaDate = \Theme\Meta\ObjectMeta::getObjectDate($object);
                $metaAuthor = \Theme\Meta\ObjectMeta::getObjectAuthor($object);

                $args['content']['meta'] .= $metaDate ?? null;
                $args['content']['meta'] .= $metaDate && $metaAuthor ? ' ' : null;

                if (!empty($metaAuthor)) {
                    $metaAuthor = \Reach\Component::get('link', $metaAuthor);
                    $args['content']['meta'] .= sprintf(\__('by %s', 'reach'), $metaAuthor);
                }
            }
        } elseif ($args['object'] instanceof \WP_Term) {
            // -------------------------------------------------------------------------
            // Set up args for Terms
            // -------------------------------------------------------------------------

            $args['content'] = [
                'heading' => $object->name,
                'url' => \get_term_link($object->ID),
                'text' => $object->description,
            ];

            // Set up image if there is an image field for terms
            // if ($image = get_field('term_image', $args)) {
            //     $args['image'] = wp_get_attachment_image($image['ID'], $args['image_size']);
            // }
        }

        if (!empty($args['content']['url']) && empty($args['content']['read_more']['url'])) {
            $args['content']['read_more']['url'] = $args['content']['url'];
        }

        if (empty($args['content']['read_more']['title'])) {
            $args['content']['read_more']['title'] = \__('Read more', 'reach');
        }
    } elseif (!empty($args['content'])) {
        // -------------------------------------------------------------------------
        // Custom Cards.
        // -------------------------------------------------------------------------
        $content = $args['content'];

        if (!empty($content['link'])) {
            $content['url'] = $content['link']['url'];
            $content['read_more']['url'] = $content['link']['url'];
            $content['read_more']['target'] = $content['link']['target'];

            if (empty($content['link']['title'])) {
                $args['show_read_more'] = false;
            } else {
                $content['read_more']['title'] = $content['link']['title'];
            }
        }

        $args['content'] = $content;
    }

    // -------------------------------------------------------------------------
    // Read more button classes.
    // -------------------------------------------------------------------------
    if (!empty($args['content']['read_more'])) {
        $args['content']['read_more'] = array_merge([
            'classes' => [
                'reach-button',
                'g-card__read-more',
            ],
        ], $args['content']['read_more']);
    }

    if (!empty($args['image_fit'])) {
        $args['attributes']['style']['--g-card--image--object-fit'] = $args['image_fit'];
    }

    if (!empty($args['background']) && $args['background'] !== 'none') {
        $args['classes'][] = 'has-' . $args['background'] . '-background-color';
        $args['classes'][] = 'has-background';
    }

    // -------------------------------------------------------------------------
    // Heading logic.
    // -------------------------------------------------------------------------
    $args['content']['heading'] = [
        'heading' => $args['content']['heading'],
        'classes' => ['g-card__heading'],
    ];

    // Add the URL to the heading.
    if (!empty($args['content']['url'])) {
        $args['content']['heading']['link'] = $args['content']['url'];
    }

    // Add any custom classes to the heading.
    if (!empty($args['heading_class'])) {
        $args['content']['heading']['classes'][] = $args['heading_class'];
    }


    // -------------------------------------------------------------------------
    // Set image args if one exists
    // -------------------------------------------------------------------------
    if (!empty($args['content']['image'])) {
        $args['content']['image']['size'] = $args['image_size'];
    }

    $args['classes'][] = !empty($args['content']['image']) ? 'has-image' : null;
    $args['classes'][] = !empty($args['content']['url']) ? 'has-link' : null;

    if (!empty($args['type'])) {
        $args['classes'][] = "g-card--type--" . $args['type'];
    }

    // -------------------------------------------------------------------------
    // Return the filtered args.
    // -------------------------------------------------------------------------
    return $args;
}
