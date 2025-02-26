<footer <?= \Reach\Helpers::buildAttributes($args['attributes']) ?>>
    <div class="site-footer__inner">
        <div class="site-footer__top alignwide">
            <div class="site-footer__logo">
                <?= \Reach\Component::get('link', [
                    'url' => home_url('/'),
                    'content' => \Reach\Image::get('logo.svg', [
                        'alt' => get_bloginfo('name'),
                    ]),
                    'content_filter' => false,
                ]); ?>
            </div>

            <?php if ($top_text = get_field('footer_text_top', 'option')) { ?>
            <div class="site-footer__top-text">
                <?= wp_kses_post($top_text); ?>
            </div>
            <?php } ?>

            <?= \Reach\Component::get('menu', [
                'theme_location' => 'footer-1',
                'max_depth' => 1,
                'classes' => [
                    'site-footer__menu',
                    'site-footer__menu-1',
                ],
                'heading' => false,
            ]); ?>


            <div class="site-footer__right">
                <?= \Reach\Component::get('social-icons', [
                    // translators: 1: Social network name.
                    'title' => \__('Visit our %s page', 'reach'),
                ]); ?>
            </div>
        </div>

        <div class="site-footer__middle">
            <?php echo '‎'; // do_shortcode('[reviews_rating]'); ?>


            <div class='footer-images'>
                <?php $images = get_field('footer_images', 'option');


                if ($images) { ?>
                    <?php foreach ($images as $image) { ?>
                <div class='footer-image'>
                    <a href='<?= $image['image']['link'] ?>'>
                        <img src='<?= $image['image']['url'] ?>' alt='<?= $image['image']['alt'] ?>'>
                    </a>
                </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>

        <div class="site-footer__bottom">
            <div class="site-footer__bottom__inner">
                <?php if ($bottom_text = get_field('footer_text_bottom', 'option')) { ?>
                <div class="site-footer__bottom-text">
                    <?= wp_kses_post($bottom_text); ?>
                </div>
                <?php } ?>
                <div class='site-footer__made-by-reach'>
                    <a href="https://reachdigital.media/?utm_source=website&utm_medium=footer&utm_campaign=menopause_studio"
                        target='_blank'>Design & Development by </a>
                    <a
                        href="https://reachdigital.media/?utm_source=website&utm_medium=footer&utm_campaign=menopause_stusio"><?= \Reach\Image::get('logo-reach.svg'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
