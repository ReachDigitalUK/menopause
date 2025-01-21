<section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <div class="post-summaries__inner">
        <?php if (!empty($args['heading'])) { ?>
            <?= \Reach\Component::get('heading', $args['heading']); ?>
        <?php } ?>

        <?php if (!empty($args['items'])) { ?>
            <div class="post-summaries__items">
                <?php foreach ($args['items'] as $key => $item) { ?>
                    <?= \Reach\Component::get('post-summaries/item', $item); ?>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</section>