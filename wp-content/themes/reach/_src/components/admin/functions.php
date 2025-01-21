<?php

namespace Reach\Components\Admin;

/**
 * Enqueue custom CSS for the WP admin bar on the front- and back-end.
 */
function enqueueAdminBarStyles()
{
    if (!\is_admin_bar_showing()) {
        return;
    }

    \wp_enqueue_style(
        'reach-admin-bar-styles',
        \Reach\Asset::URL('components/admin/admin-bar.css', true),
        [],
        false
    );
}
