<section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <div class="packages__inner">
        <?php if (!empty($args['heading'])) { ?>
            <?= \Reach\Component::get('heading', $args['heading']); ?>
        <?php } ?>

        <?php if (!empty($args['description'])) { ?>
            <div class="packages__content">
                <?= wp_kses_post($args['content']); ?>
            </div>
        <?php } ?>

        <?php if (!empty($args['packages'])) { ?>
            <div class="packages__list">
                <?php foreach ($args['packages'] as $package) { ?>
                    <div class="packages__item">
                        <div class="packages__item__header" style="--package-background: <?= $package['background']; ?>;">
                            <?= \Reach\Component::get('heading', ['heading' => $package['product']->get_name(), 'el' => 'h3']); ?>
                            <div class="packages__item__header__price">
                                <?= $package['product']->get_price_html(); ?>
                            </div>
                        </div>
                        <div class="packages__item__body">
                            <div class="packages__item__image">
                                <?= $package['product']->get_image(); ?>
                            </div>
                            <div class="packages__item__features">
                                <?php foreach ($package['features'] as $feature) { ?>
                                    <div class="packages__item__feature">
                                        <?= \Reach\SVG::get('check-circle.svg'); ?>
                                        <span><?= $feature['feature']; ?></span>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="packages__item__button">
                                <?= \Reach\Component::get('link', ['title' => 'Learn more', 'url' => $package['product']->get_permalink(), 'classes' => ['button']]); ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</section>