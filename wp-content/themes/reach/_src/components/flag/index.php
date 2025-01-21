<section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <div class="flag__inner">
        <div class="flag__layout">
            <div class="flag__layout__media">
                <?php if (!empty($args['image_settings']['image'])) { ?>
                    <?= \Reach\Component::get('image', $args['image_settings']['image']); ?>
                <?php } ?>
            </div>
            <div class="flag__layout__content">
                <?php if (!empty($args['heading'])) { ?>
                    <?= \Reach\Component::get('heading', $args['heading']); ?>
                <?php } ?>
                <?php if (!empty($args['content'])) { ?>
                    <div class="flag__layout__content__content">
                        <?= $args['content']; ?>
                    </div>
                <?php } ?>
                <?php if (!empty($args['button'])) { ?>
                    <div class="flag__layout__content__button">
                        <?= \Reach\Component::get('link', $args['button']); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>