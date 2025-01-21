<div <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <?php if (!empty($args['label'])) { ?>
        <div class="taxonomy-filters__label">
            <span><?= wp_kses_post($args['label']) ?></span>
        </div>
    <?php } ?>

    <ul class="taxonomy-filters__list flex-list">
        <?php foreach ($args['items'] as $item) : ?>
            <li class="taxonomy-filters__item-wrap">
                <?= \Reach\Component::get('link', $item); ?>
            </li>
        <?php endforeach;  ?>
    </ul>
</div>