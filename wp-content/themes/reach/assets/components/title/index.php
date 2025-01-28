<section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <div class="title__inner">
        <?php if (!empty($args['sub_heading'])): ?>
            <h3 class="title__sub-heading"><?= $args['sub_heading']; ?></h3>
        <?php endif; ?>
        <?php if (!empty($args['heading'])): ?>
            <h2 class="title__heading"><?= $args['heading']['heading']; ?></h2>
        <?php endif; ?>
        <?php if (!empty($args['description'])): ?>
            <p class="title__description"><?= $args['description']; ?></p>
        <?php endif; ?>
        <?php if (!empty($args['button'])){ ?>
            <div class="title__button">
                <a href="<?= $args['button']['url']; ?>" class="<?= $args['button_class']; ?>"><?= $args['button']['text']; ?></a>
            </div>
        <?php } ?>
    </div>
</section>