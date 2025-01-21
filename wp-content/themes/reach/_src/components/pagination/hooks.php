<?php

namespace Reach\Components\Pagination;

\add_filter('reach/partial/assets/components/pagination', __NAMESPACE__ . '\\filterArgs');

\add_filter('navigation_markup_template', __NAMESPACE__ . '\\filterPaginationMarkupTemplate');
