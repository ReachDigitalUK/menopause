<li <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <span class="menu-item__wrap">
        <?= \Reach\Component::get('link', $args['link']); ?>

        <?php if ($args['display_submenu'] === true) { ?>
            <?= \Reach\Component::get('button', $args['button']); ?>
        <?php } ?>
    </span>

    <?php if ($args['display_submenu'] === true) { ?>
        <div <?= \Reach\Helpers::buildAttributes($args['sub-menu-attributes']) ?>>
            <?= \Reach\Component::get('menu/menu-list', [
                'items' => $args['item']->children,
                'depth' => ($args['depth'] + 1),
                'max_depth' => $args['max_depth'],
            ]); ?>
        </div>
    <?php } ?>
</li>