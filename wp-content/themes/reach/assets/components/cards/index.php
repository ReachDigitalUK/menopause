<?php if (!empty($args['items'])) { ?>
    <section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
        <div class="cards__inner">
            <?php if (!empty($args['heading']) || !empty($args['subheading'])) { ?>
                <div class="cards__header">
                    <?php if (!empty($args['heading'])) { ?>
                        <?= \Reach\Component::get('heading', [
                            'heading' => $args['heading'],
                            'classes' => ['cards__heading'],
                        ]); ?>
                    <?php } ?>

                    <?php if (!empty($args['subheading'])) { ?>
                        <div class="cards__subheading">
                            <?= wp_kses_post($args['subheading']); ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>

            <div class="cards__items">
                <?php foreach ($args['items'] as $key => $card) { ?>
                    <?= \Reach\Component::get('card', $card); ?>
                <?php } ?>
            </div>

            <?php if (!empty($args['button'])) { ?>
                <div class="cards__footer">
                    <div class="cards__more-link">
                        <?= \Reach\Component::get('link', $args['button']); ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
<?php } ?>