<?php

namespace Reach\Components\CookiesPreferences;

add_filter('reach/partial/assets/components/cookies-preferences', __NAMESPACE__ . '\\filterArgs');

add_action('parse_request', __NAMESPACE__ . '\\checkCookiesConsentReset');
