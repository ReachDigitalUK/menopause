<nav <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <div class="megamenu__inner">
        <div class="megamenu__inner__toplevel">
            <?php foreach ($args['items'] as $key => $item) { ?>
                <div class="megamenu__inner__toplevel__item <?php if (!empty($item->children)) {echo 'has-children';} ?>">
                    <div class="megamenu-child__child__header-wrap">
                        <a href="<?= $item->url; ?>" class="<?= $item->is_current_item ? 'active' : ''; ?> top-level-mega" <?php if (!empty($item->children)) {
                                                                                                                echo ' data-child="megamenu-child-' . $item->ID . '"';
                                                                                                            } ?>><?= $item->title; ?></a><?php if (!empty($item->children)) { ?>
                            <div class="megamenu-child__child__header__toggle">+</div>
                        <?php } ?>
                    </div>
                    <?php if (!empty($item->children)) { ?>
                        <div class="megamenu-child megamenu-child-<?= $item->ID; ?>">
                            <div class="megamenu-child__inner">
                                <div class="megamenu-child__children">
                                    <?php $first_child = true; // Initialize the flag for the first child ?>
                                    <?php foreach ($item->children as $child) { ?>
                                        <div class="megamenu-child__child">
                                            <div class="megamenu-child__child__header-wrap">
                                                <a class="megamenu-child__child__header full-width <?= $first_child ? 'first-child' : ''; ?>" href="<?= $child->url; ?>" 
                                                <?php if (!empty($child->children)) {
                                                    echo ' data-child="megamenu-child-' .$child->ID. '"';} ?>><?= $child->title; ?></a>
                                            </div>
                                            <?php if (!empty($child->children)) { ?>
                                                <div class="megamenu-child megamenu-child__child__grandchildren">
                                                    <?php foreach ($child->children as $grandchild) { ?>
                                                        <a class="megamenu-child__child__grandchild" href="<?= $grandchild->url; ?>"><?= $grandchild->title; ?></a>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <?php $first_child = false; // Set the flag to false after the first child ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</nav>