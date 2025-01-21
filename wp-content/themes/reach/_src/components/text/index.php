<section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <div class="text__inner">
        <?php if (!empty($args['heading'])) { ?>
            <?= \Reach\Component::get('heading', $args['heading']); ?>
        <?php } ?>
        <div class="text__columns">
            <?php foreach ($args['columns'] as $column) { ?>
                <div class="text__columns__column">
                    <?php if (!empty($column['heading'])) { ?>
                        <?= \Reach\Component::get('heading', ['heading' => $column['heading'], 'el' => 'h4']); ?>
                    <?php } ?>
                    <?php if (!empty($column['content'])) { ?>
                        <div class="text__columns__column__text">
                            <?= $column['content']; ?>
                        </div>
                    <?php } ?>
                    <?php if (!empty($column['call_to_action'])) { ?>
                        <?php $column['call_to_action']['classes'] = ['reach-button']; ?>
                        <div class="text__columns__column__cta">
                            <?= \Reach\Component::get('link', $column['call_to_action']); ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</section>