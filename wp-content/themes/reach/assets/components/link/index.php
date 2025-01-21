<a <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <?php
    echo trim($args['content_filter']($args['content']));
    ?>
</a>