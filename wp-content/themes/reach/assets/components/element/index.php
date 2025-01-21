<<?= esc_html($args['el']); ?> <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <?php
    if (isset($args['content'])) {
        echo $args['content_filter']($args['content']);
    ?></<?= esc_html($args['el']); ?>>
<?php }
