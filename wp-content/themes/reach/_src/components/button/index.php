<button <?= Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <?= wp_kses_post($args['content']); ?>
</button>