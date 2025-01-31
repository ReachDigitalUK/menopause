<section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <div class="flag__inner <?php if(!empty($args['add_classes'])){echo $args['add_classes'];}; ?>">
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

           
                <?php if (!empty($args['bullet_points'])) { ?>
                <div class="flag__layout__content__bullets">
                    <div class="column">
                        <ul>
                            <?php foreach (array_slice($args['bullet_points'], 0, 5) as $bullet) { ?>
                                <li><?= htmlspecialchars($bullet['point']); ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="column">
                        <ul>
                            <?php 
                            $totalItems = count($args['bullet_points']);
                            $lastIndex = $totalItems - 1;

                            foreach (array_slice($args['bullet_points'], 5) as $index => $bullet) { 
                                $isLast = ($index + 5 === $lastIndex); // Check if it's the last item
                            ?>
                                <li <?= $isLast ? 'class="no-bullet bold-text"' : ''; ?>>
                                    <?= htmlspecialchars($bullet['point']); ?>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            <?php } ?>


                <?php if (!empty($args['button'])) { ?>
                    <div class="flag__layout__content__button">
                        <a href="<?= $args['button']['url']; ?>" class="<?= $args['button_class'];?>"><?= $args['button']['title']; ?></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>