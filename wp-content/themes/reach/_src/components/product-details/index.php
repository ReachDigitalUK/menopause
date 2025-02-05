<section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>

    <div class="product-details__inner">
        <a href='/packages/' class='back'>Return back to packages</a>
        <div class="product-details__header">
            <div class="product-details__gallery">
                <?php do_action('woocommerce_before_main_content'); ?>

                <div class="product-details__gallery__images">
                <img src="<?= get_the_post_thumbnail_url($args['product']->get_id(), 'full'); ?>" alt="<?= get_post_meta(get_post_thumbnail_id($args['product']->get_id()), '_wp_attachment_image_alt', true); ?>">
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
                                <div class='package-item-perk'>
                                    <h4><?php echo $perk['feature']; ?></h4>
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