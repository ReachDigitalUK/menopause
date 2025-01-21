<article <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <?= \Reach\Component::get('heading', $args['heading']); ?>

    <?php if (!empty($args['content'])) { ?>
        <div class="post-summary__content">
            <?= wp_kses_post($args['content']); ?>
        </div>
    <?php } ?>

    <?php if (!empty($args['image'])) { ?>
        <div class="poReachst-summary__image img-fit">
            <?= \Reach\Component::get('image', $args['image']); ?>
        </div>
    <?php } ?>
</article>