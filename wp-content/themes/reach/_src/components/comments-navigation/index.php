<nav <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <?= \Reach\Component::get('heading', $args['heading']); ?>

    <div class="comments-navigation__links">
        <div class="comments-navigation__previous">
            <?php \previous_comments_link(
                \__('Older Comments', 'reach')
            ); ?>
        </div>

        <div class="comments-navigation__next">
            <?php \next_comments_link(
                \__('Newer Comments', 'reach')
            ); ?>
        </div>
    </div>
</nav>