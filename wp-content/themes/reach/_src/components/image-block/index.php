<section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <div class = "image-block__container">
        <div class="image-block__inner" style='background_image: url("<?= $args['background_image']; ?>")'>
            <?php if (!empty($args['sub_heading'])): ?>
                <h3 class="image-block__sub-heading"><?= $args['sub_heading']; ?></h3>
            <?php endif; ?>
            <?php if (!empty($args['heading'])): ?>
                <h2 class="image-block__heading"><?= $args['heading']['heading']; ?></h2>
            <?php endif; ?>
            <?php if (!empty($args['description'])): ?>
                <p class="image-block__description"><?= $args['description']; ?></p>
            <?php endif; ?>
            <?php if (!empty($args['button'])){ ?>
                <div class="image-block__button">
                    <a href="<?= $args['button']['url']; ?>" class="<?= $args['button_class']; ?>"><?= $args['button']['text']; ?></a>
                </div>
            <?php } ?>
        <div>
    </div>
</section>