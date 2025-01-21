<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <?= \Reach\Component::get('cookies-notice'); ?>
    <?= \Reach\Component::get('skip-link'); ?>
    <?= \Reach\Component::get('site-header'); ?>