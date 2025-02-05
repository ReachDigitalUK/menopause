<section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <div class="title__inner">
        <?php if (!empty($args['sub_heading'])): ?>
            <h3 class="title__sub-heading"><?= $args['sub_heading']; ?></h3>
        <?php endif; ?>
        <?php if (!empty($args['heading'])): ?>
    <?php 
        $headingType = !empty($args['heading_type']) ? $args['heading_type'] : 'h2'; 
    ?>
    <<?php echo $headingType; ?> class="title__heading">
        <?php echo htmlspecialchars($args['heading']['heading'], ENT_QUOTES, 'UTF-8'); ?>
    </<?php echo $headingType; ?>>
<?php endif; ?>

        <?php if (!empty($args['description'])): ?>
            <p class="title__description"><?= $args['description']; ?></p>
        <?php endif; ?>
        <?php if (!empty($args['button'])){ ?>
            <div class="title__button">
                <a href="<?= $args['button']['url']; ?>" class="<?= $args['button_class']; ?>"><?= $args['button']['text']; ?></a>
            </div>
        <?php } ?>
    </div>
</section>
