<?php

namespace Reach\Components\PageHeader;

function filterArgs(array $args): ?array
{
    // ---------------------------------------
    // Default arguments.
    // ---------------------------------------
    $args = array_merge([
        'classes' => [],
        'type' => '',
        'image_position' => 'background',
        'background' => '',
        'attributes' => [],
        'content' => [],
        'show_breadcrumbs' => true,
    ], $args);

    // ---------------------------------------
    // Required classes.
    // ---------------------------------------
    $args['classes'] = array_merge([
        'page-header',
        'wp-block',
        'alignfull',
    ], $args['classes']);

    // Handle editor preview
    if (!empty($args['is_preview'])) {
        $args['object'] = \get_post($args['post_id']);
    } else {
        $args['object'] = \Reach\WordPress\PageObject::get() ?? null;
    }

    // Set up page header args for each type of view (singular posts, archive pages and terms)
    if (!empty($args['object'])) {
        $object = $args['object'];

        if ($object instanceof \WP_Term) {
            if (empty($args['heading'])) {
                $args['heading'] = $object->name;
            }
        } elseif ($object instanceof \WP_Post_Type) {
            // If the content has a connected archive content page, set the object to that page
            if ($templatePage = \Reach\WordPress\TemplatePage::getTemplatePage($object)) {
                $object = $templatePage;
            } else {
                if (empty($args['heading'])) {
                    $args['heading'] = $object->label;
                }
            }
        } elseif ($object instanceof \WP_Query && $object->is_404()) {
            if (empty($args['heading'])) {
                $args['heading'] = \__('404', 'reach');
            }
        } elseif ($object instanceof \WP_Query && $object->is_search()) {
            if (empty($args['heading'])) {
                $args['heading'] = \__('Search', 'reach');
            }

            if (!empty($object->query['s'])) {
                $args['subheading'] = sprintf(
                    \__("Showing results for '%s'", 'reach'),
                    $object->query['s']
                );
            }
        } elseif ($object instanceof \WP_User) {
            if (empty($args['heading'])) {
                $args['heading'] = sprintf(
                    \__('Posts by %s', 'reach'),
                    $object->data->display_name
                );
            }
        }

        if ($object instanceof \WP_Post) {
            // -----------------------------------------------------------------
            // Handle filtering content from WordPress posts
            // -----------------------------------------------------------------

            if (empty($args['heading'])) {
                $args['heading'] = $object->post_title;
            }

            if (empty($args['image'])) {
                $args['image'] = \get_post_thumbnail_id($object);
            }

            if ($object->post_type === 'post') {
                $args['meta'] = sprintf(
                    \__('Published on %s ', 'reach'),
                    \get_the_date(\get_option('date_format'), $object->ID)
                );

                $args['labels'] = \Theme\Meta\ObjectMeta::getObjectLabels($object->ID, [
                    'limit' => 3,
                    'taxonomies' => ['category']
                ]);

                $args['background'] = false;
                $args['image_position'] = 'inset';

                $args['type'] = 'article';

                if ($author_name = \get_the_author_meta('display_name', $object->post_author)) {
                    $args['meta'] .= sprintf(
                        \__('by %s ', 'reach'),
                        $author_name
                    );
                }
            } elseif ($object->post_type === 'page') {
                if (\is_front_page()) {
                    $args['classes'][] = 'page-header--home';
                    $args['show_breadcrumbs'] = false;
                }

                if (empty($object->post_parent)) {
                    $args['show_breadcrumbs'] = false;
                }
            }

            // Handle the default post title before the post has been saved
            if ($args['heading'] === 'Auto Draft') {
                $args['heading'] = \__('Post Title', 'reach');
            }

            unset($args['object']);
        }
    }

    // -------------------------------------------------------------------------
    // Set up default placeholders in preview if none is provided
    // -------------------------------------------------------------------------
    if (!empty($args['is_preview'])) {
        if (empty($args['heading'])) {
            $args['heading'] = _x('Add title', 'Placeholder for page header title', 'reach');
        }

        if (empty($args['subheading'])) {
            $args['subheading'] = _x('Add subheading', 'Placeholder for page header subheading', 'reach');
        }
    }

    // -------------------------------------------------------------------------
    // Pull the image if one exists
    // -------------------------------------------------------------------------
    if (!empty($args['image'])) {
        if (!is_array($args['image'])) {
            $args['image'] = [
                'id' => $args['image']
            ];
        }

        if ($args['image_position'] === 'inset') {
            $args['image']['size'] = 'medium';
            $args['classes'][] = 'has-inset-image';
        } else {
            $args['image']['size'] = 'reach_super';
            $args['classes'][] = 'has-background';
            $args['classes'][] = 'has-background-image';
        }

        // Loading, set to eager
        $args['image']['loading'] = 'eager';
    }

    if (!empty($args['heading'])) {
        $args['heading'] = [
            'heading' => $args['heading'],
            'el'      => 'h1',
            'classes' => [
                'page-header__heading',
                'is-style-typestyle-h1'
            ],
        ];
    }

    if (!empty($args['primary_call_to_action'])) {
        $args['primary_call_to_action']['classes'] = 'reach-button';
    }

    if (!empty($args['background']) && $args['background'] !== 'none') {
        $args['classes'][] = 'has-' . $args['background'] . '-background-color';
        $args['classes'][] = 'has-background';
    }

    if (!empty($args['type'])) {
        $args['classes'][] = 'page-header--type--' . $args['type'];
    }

    if (!empty($args['image_overlay_opacity'])) {
        $args['attributes']['style']['--page-header--overlay-opacity'] = $args['image_overlay_opacity'] . '%';
    }

    if (!empty($args['image_overlay_colour'])) {
        $args['attributes']['style']['--page-header--overlay-colour'] = $args['image_overlay_colour'];
    }

    if (!empty($args['show_breadcrumbs'])) {
        $args['classes'][] = 'has-breadcrumbs';
    }

    if (!empty($args['margin'])) {
        $args['attributes']['style']['--page-header--margin'] = implode(' ', $args['margin']);
    }

    if (!empty($args['padding'])) {
        $args['attributes']['style']['--page-header--padding'] = implode(' ', $args['padding']);
    }

    if (!empty($args['image_border_radius'])) {
        $args['attributes']['style']['--page-header--image-border-radius'] = implode(' ', $args['image_border_radius']);
    }

    if (!empty($args['height'])) {
        $args['attributes']['style']['--page-header--height'] = $args['height'] . 'dvh';
    }

    if (!empty($args['background_colour'])) {
        $args['attributes']['style']['--page-header--background-colour'] = $args['background_colour'];
    }
    if (!empty($args['text_colour'])) {
        $args['attributes']['style']['--page-header--text-colour'] = $args['text_colour'];
    }

    // -------------------------------------------------------------------------
    // Return the filtered args.
    // -------------------------------------------------------------------------
    return $args;
}
