<form <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <fieldset <?= \Reach\Helpers::buildAttributes($args['fieldset_attributes']); ?>>
        <legend class="visually-hidden">
            <?= esc_html__('Select cookie consent by type', 'reach'); ?>
        </legend>

        <?php foreach ($args['groups'] as $group) { ?>
            <div class="cookies-preferences__consent-group">
                <?= \Reach\Component::get('toggle-field', $group); ?>
            </div>
        <?php } ?>
    </fieldset>

    <ul class="cookies-preferences__action-list button-list">
        <li class="cookies-preferences__action" aria-hidden="true">
            <?= \Reach\Component::get('button', $args['save_preferences_button']); ?>
        </li>

        <li class="cookies-preferences__action">
            <?= \Reach\Component::get('button', $args['consent_all_button']); ?>
        </li>

        <li class="cookies-preferences__action">
            <?= \Reach\Component::get('button', $args['reject_all_button']); ?>
        </li>

        <?php if (empty($args['groups_expanded'])) { ?>
            <li class="cookies-preferences__action">
                <?= \Reach\Component::get('button', $args['manage_preferences_button']); ?>
            </li>
        <?php } ?>
    </ul>
</form>