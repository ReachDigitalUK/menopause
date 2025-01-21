<?php

get_header();

$content = [];
$object = \Reach\WordPress\PageObject::get();

while (have_posts()) {
    the_post();
    $content[] = apply_filters('the_content', get_the_content());
}

$content[] = \Reach\Component::get('comments');

echo \Reach\Component::get('site-main', [
    'object' => $object,
    'content' => implode($content),
]);

get_footer();
