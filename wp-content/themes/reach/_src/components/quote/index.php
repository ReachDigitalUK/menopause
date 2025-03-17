<section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <div class="quote__container">
        <div class="quote__inner">
            <?php if (!empty($args['quote'])){ ?>
                <h3 class="quote__quote">
                    <?= $args['quote']; ?>
                </h3>
            <?php } ?>
        </div>
</section>