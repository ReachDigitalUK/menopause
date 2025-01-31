<section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>

    <div class="product-details__inner">
        <a href='/packages/' class='back'>Return back to packages</a>
        <div class="product-details__header">
            <div class="product-details__gallery">
                <?php do_action('woocommerce_before_main_content'); ?>

                <div class="product-details__gallery__images">
                    <?php
                    $imageIds = array_slice($args['product']->get_gallery_image_ids(), 0, 6);
                    foreach ($imageIds as $imageId) { ?>
                        <img src="<?= wp_get_attachment_image_url($imageId, 'full'); ?>" alt="<?= get_post_meta($imageId, '_wp_attachment_image_alt', true); ?>">
                    <?php } ?>
                </div>
            </div>
            <div class="product-details__information">
                <strong>
                    <h1 class="product-details__information__title"><?= $args['product']->get_name(); ?><div class="product-details__information__price"><?= $args['product']->get_price_html(); ?> incl. VAT</div>
                    </h1>
                </strong>
                <div class="product-details__description">
                    <div class='item-desciption'><?= $args['product']->get_description(); ?></div>

                    <div class='all-perks'>
                        <h3>What's included?</h3>
                        <?php
                        $perks = get_field('features');
                        if ($perks) { ?>
                            <?php foreach ($perks as $perk) { ?>
                                <div class='package-item-perk' data-name=''>
                                    <h4><?php echo $perk['feature']; ?></h4>
                                    <!---<a class='info-modal' data-name='<?php //echo $perk['feature']; ?>' data-description='<?php //echo $perk['feature-description'] ?>'><img src="/wp-content/themes/reach/_src/images/infosmall.svg)"></a> -->
                                 </div> 
                            <?php } ?>

                            </ul>
                        <?php } ?>
                    </div>

                    <?php if (!is_user_logged_in() && !empty(get_option('users_can_register'))) { ?>
                        <a href="<?php echo $args['product']->add_to_cart_url() ?>" value="<?= $args['product']->get_id() ?>" class="ajax_add_to_cart add_to_cart_button button" data-product_id="<?= $args['product']->get_id(); ?>" aria-label="Add “<?php the_title_attribute() ?>” to your cart">
                            Get the <?= $args['product']->get_name(); ?>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class=''>




</section>