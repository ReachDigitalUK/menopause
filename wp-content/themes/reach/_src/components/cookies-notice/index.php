<div <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <div class="cookies-notice__banner has-blue-background-color">
        <?php if (!empty($args['heading'])) { ?>
            <?= \Reach\Component::get('heading', [
                'heading' => $args['heading'],
                'classes' => ['cookies-notice__heading'],
            ]); ?>
        <?php } ?>

        <div class="cookies-notice__description">
            <?= wp_kses_post($args['content']); ?>
        </div>

        <?= \Reach\Component::get('cookies-preferences', [
            'classes' => ['cookies-notice__preferences'],
            'groups_expanded' => false,
        ]); ?>
    </div>
</div>