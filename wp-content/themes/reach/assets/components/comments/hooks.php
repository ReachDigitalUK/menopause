<?php

namespace Reach\Components\Comments;

\add_filter('reach/partial/assets/components/comments', __NAMESPACE__ . '\\filterArgs');

\add_filter('comment_form_default_fields', __NAMESPACE__ . '\\removeCommentFormWebsiteField');
