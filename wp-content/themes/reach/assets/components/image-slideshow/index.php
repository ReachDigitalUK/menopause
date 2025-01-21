<section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <div class="image-slideshow__inner">
        <?php if (!empty($args['slides'])) { ?>
            <?php foreach ($args['slides'] as $index => $slide) { ?>
                <div class="image-slideshow__slide<?= $index === 0 ? ' active' : ''; ?>" style="background-image: url(<?= $slide['image_settings']['image']['url']; ?>);<?= array_key_exists('image_overlay_opacity', $slide['image_settings']) ? ' --image-slideshow--overlay-opacity: ' . $slide['image_settings']['image_overlay_opacity'] . '%;' : '' ?><?= !empty($slide['image_settings']['image_overlay_colour']) ? ' --image-slideshow--overlay-color: ' . $slide['image_settings']['image_overlay_colour'] . ';' : '' ?>" data-index="<?= $index; ?>">
                    <div class="image-slideshow__slide__content">
                        <?php if (!empty($slide['subheading'])) { ?>
                            <div class="image-slideshow__slide__content__subheading">
                                <?= $slide['subheading']; ?>
                            </div>
                        <?php } ?>

                        <?php if (!empty($slide['heading'])) { ?>
                            <div class="image-slideshow__slide__content__heading">
                                <?= $slide['heading']; ?>
                            </div>
                        <?php } ?>

                        <?php if (!empty($slide['description'])) { ?>
                            <div class="image-slideshow__slide__content__description">
                                <?= $slide['description']; ?>
                            </div>
                        <?php } ?>

                        <?php if (!empty($slide['link'])) { ?>
                            <div class="image-slideshow__slide__content__link">
                                <?= $slide['link']; ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
    <div class="image-slideshow__controls">
        <?php if (!empty($args['slides'])) { ?>
            <?php foreach ($args['slides'] as $index => $slide) { ?>
                <div class="image-slideshow__controls__indicator" data-index="<?= $index; ?>"></div>
            <?php } ?>
        <?php } ?>
    </div>
</section>