<?php

namespace Reach\Components\Breadcrumbs;

\add_filter('reach/partial/assets/components/breadcrumbs', __NAMESPACE__ . '\\filterArgs');

\add_filter('wpseo_breadcrumb_separator', __NAMESPACE__ . '\\alterYoastSeparatorMarkup');
\add_filter('wpseo_breadcrumb_output_class', __NAMESPACE__ . '\\setYoastWrapperMarkupClass');
