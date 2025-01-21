<section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <?php if (\have_comments()) { ?>
        <?= \Reach\Component::get('heading', $args['heading']); ?>

        <?= \Reach\Component::get('comments-navigation', [
            'attributes' => [
                'id' => 'comment-nav-above',
            ],
        ]); ?>

        <ol class="comments__comment-list">
            <?php \wp_list_comments([
                'style' => 'ol',
                'type' => 'comment',
            ]); ?>
        </ol>

        <?= \Reach\Component::get('comments-navigation', [
            'attributes' => [
                'id' => 'comment-nav-below',
            ],
        ]); ?>
    <?php } ?>

    <?php if (!empty($args['closed_message'])) { ?>
        <p class="comments__closed-message">
            <?= \esc_html($args['closed_message']); ?>
        </p>
    <?php } ?>

    <div class="comments__form">
        <?php \comment_form([
            'submit_button' => '<button name="%1$s" type="submit" id="%2$s" class="reach-button %3$s"/>%4$s</button>',
        ]); ?>
    </div>
</section>