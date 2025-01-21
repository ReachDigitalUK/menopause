<?php

get_header();

$content = [];
$object = \Reach\WordPress\PageObject::get();

$templatePage = \Reach\WordPress\TemplatePage::getTemplatePage($object);
$content[] = \Reach\WordPress\TemplatePage::getContent($object);

if (empty($templatePage)) {
    $content[] = \Reach\Component::get('template-loop');
}

echo \Reach\Component::get('site-main', [
    'object' => $object,
    'content' => implode($content),
]);

get_footer();
