<label <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <input id="<?= esc_attr($args['id']); ?>-input" type="checkbox" name="<?= esc_attr($args['name']); ?>" value="<?= esc_attr($args['value']); ?>" />

    <span class="toggle-field__indicator" hidden>
        <?= \Reach\SVG::get('check.svg'); ?>
        <?= \Reach\SVG::get('cross.svg'); ?>
    </span>

    <span class="toggle-field__label">
        <?= wp_kses_post($args['label']); ?>
    </span>
</label>