<?php

get_header();

$content = [];
$object = \Reach\WordPress\PageObject::get();

$templateContent = \Reach\WordPress\TemplatePage::getContent($object);
$content[] = $templateContent ?: \Reach\Component::get('no-content', [
    'object' => $object,
]);

echo \Reach\Component::get('site-main', [
    'header' => \Reach\Component::get('page-header', [
        'object' => $object,
    ]),
    'object' => $object,
    'content' => implode($content),
]);

get_footer();
