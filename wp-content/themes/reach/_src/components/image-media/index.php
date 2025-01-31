<section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <div class = "image-media__container">
        <div class="image-media__inner" style='background-image: url("<?= $args['background_image']; ?>")'>
            <div class='img-padding'>
                <?php if (!empty($args['sub_heading'])): ?>
                    <h3 class="image-media__sub-heading"><?= $args['sub_heading']; ?></h3>
                <?php endif; ?>
                <?php if (!empty($args['heading'])): ?>
                    <h2 class="image-media__heading"><?= $args['heading']; ?></h2>
                <?php endif; ?>
                <?php if (!empty($args['description'])): ?>
                    <p class="image-media__description"><?= $args['description']; ?></p>
                <?php endif; ?>
                <?php if (!empty($args['button'])){ ?>
                    <div class="image-media__button">
                        <a href="<?= $args['button']['url']; ?>" class="<?= $args['button_class']; ?>"><?= $args['button']['title']; ?></a>
                    </div>
                <?php } ?>
            </div>
            </div>
    </div>
</section>