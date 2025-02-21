<section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>

    <div class="product-details__inner">
        <a href='/packages/' class='back'>Return back to packages</a>
        <div class="product-details__header">
            <div class="product-details__gallery">
                <?php do_action('woocommerce_before_main_content'); ?>



                <?php

                $bullet_points = [];

                foreach (get_field('features') as $feature) {
                    $bullet_points[] = [
                        'point' => $feature['feature']
                    ];
                }

                $components = [];

                $components[] = \Reach\Component::get('flag', [

                'heading' =>  $args['product']->get_name(),
                'heading_type' => 'h1',
                'bullet_points' => $bullet_points,
                'content' => $args['product']->get_price_html(),

                'flag_type' => 'package',

                'image_settings' => [
                'image' => [
                    'url' => get_the_post_thumbnail_url($args['product']->get_id(), 'full'),
                    'id' => get_post_thumbnail_id($args['product']->get_id()),
                    'link' => '',
                ],
                'image_overlay_colour' => '',
                'image_overlay_opacity' => '',
                'media_side' => 'row-reverse',
                'media_size' => '',
                'align_items' => 'start',
                'image_border_tilt' => '-5deg',
                'image_border_color' => '#FAA28F',
                'image_flag_border_width' => '5',
                ],

                'row_gap' => '4rem',

                'padding' => ['1rem', '0rem', '1rem', '0rem'],
                'margin' => ['0', '0', '0', '0'],
                'image_border_radius' => ['10px', '10px', '10px', '10px'],

                'button' => [
                'url' => '/contact/',
                'title' => 'Talk to us',
                ],

                'button_class' => 'button-yellow',

                ]);


                echo implode($components);

                ?>




</section>