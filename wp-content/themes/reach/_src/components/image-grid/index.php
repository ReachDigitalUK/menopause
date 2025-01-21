<section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <div class="image-grid__inner">
        <?php if (!empty($args['heading'])) { ?>
            <?= \Reach\Component::get('heading', $args['heading']); ?>
        <?php } ?>
        <?php if (!empty($args['images'])) { ?>
            <div class="image-grid__images">
                <?php foreach ($args['images'] as $image) { ?>
                    <div <?= \Reach\Helpers::buildAttributes($image['attributes']); ?>>
                        <div class="image-grid__images__image__content">
                            <?php if (!empty($image['heading'])) { ?>
                                <?= \Reach\Component::get('heading', ['heading' => $image['heading'], 'el' => 'h4']); ?>
                            <?php } ?>
                            <?php if (!empty($image['call_to_action'])) { ?>
                                <?php $image['call_to_action']['classes'] = ['reach-button']; ?>
                                <div class="image-grid__images__image__content__cta">
                                    <?php $image['call_to_action']['classes'] = ['reach-button']; ?>
                                    <?= \Reach\Component::get('link', $image['call_to_action']); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</section>