<ul <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <?php foreach ($args['items'] as $key => $item) { ?>
        <?= \Reach\Component::get('menu/menu-item', [
            'item' => $item,
            'depth' => $args['depth'],
            'max_depth' => $args['max_depth'],
        ]); ?>
    <?php } ?>
</ul>