<?php if (!empty($args['items_component_args']['items'])) { ?>
    <?= \Reach\Component::get('taxonomy-filters', [
        'object' => $args['object'],
        'show' => $args['show_taxonomy_filters'],
    ]); ?>

    <?= \Reach\Component::get($args['items_component'], $args['items_component_args']); ?>
    <?= \Reach\Component::get('pagination'); ?>
<?php } else { ?>
    <?= \Reach\Component::get('no-content', [
        'object' => $args['object'],
    ]); ?>
<?php }
