<section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <div class="icon-block__container">
        <div class="icon-block__inner">
            <?php foreach ($args['icon'] as $icon){ ?>
                <div class="icon-block__icon">
                    <img src="<?= $icon['image']; ?>">
                    <h3><?= $icon['title']; ?></h3>
                    <p><?= $icon['text']; ?></p>
                </div>
                <?php } ?>
        </div>
    </div>
</section>