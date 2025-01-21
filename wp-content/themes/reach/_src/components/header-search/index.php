<form <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <div class="header-search__inner">
        <input
            id="<?= esc_attr($args['input_id']); ?>"
            class="header-search__input"
            type="text"
            name="s"
            aria-label="<?= esc_attr__('Search', 'reach'); ?>"
            placeholder="<?= esc_attr__('Search...', 'reach'); ?>"
            required>

        <?= \Reach\Component::get('button', $args['submit-button']); ?>
    </div>
</form>