<?php

// echo '<pre>';
// print_r($args);
// echo '</pre>';

$args['type'] = '';
$headerClass = '';

switch ($args['slider_type']) {
    case 'Card Slider':
        $args['type'] = 'cards';
        $headerClass = 'slider__header-container';
        break;
    case 'Non-Card Slider':
        $args['type'] = 'non-cards';
        $headerClass = 'non-card-header';
        break;
    case 'Custom Slider':
        $args['type'] = 'custom';
        break;
    case 'Home':
        $args['type'] = 'custom-home';
        break;
    default:
        $args['type'] = 'cards';
        break;
}
?>

<section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?> style="margin-top: 0px; margin-bottom: 0px;">

    <?php
    // Example with data initialization (make sure data is an array)
    $data = [];  // Initialize $data as an array (not string)

    // Correct access with type-check:
    if (is_array($data) && isset($data['top_header']['top_header'])) {
        echo $data['top_header']['top_header'];
    }
    ?>

    <div class="slider__inner">
        <div class="slider__container <?php if (isset($args['header_location'])) echo $args['header_location'] == 'beside' ? ' header-beside' : '' ?>">
            <div class="slider__container__header">
                <h2>
                    <?php
                    if (is_array($args) && isset($args['top_header']['top_header'])) {
                        echo $args['top_header']['top_header'];
                    }
                    ?>
                </h2>

                <?php if (!empty($args['link']) && $args['header_location'] == 'beside') { ?>
                    <div class="slider__container__header__link">
                        <a href="<?= $args['link']['url'] ?>" target="<?= $args['link']['target'] ?>"><?= $args['link']['title'] ?></a>
                    </div>
                <?php } ?>
            </div>

            <div class="swiper cards-slider">
                <?php if ($args['show_navigation'] == true) { ?>
                    <div class="slider__navigation-container">
                        <div class="left-nav" style="background-color: <?= isset($args['navigation_buttons_color']) ? $args['navigation_buttons_color'] : '#FFFFFF' ?>;">
                            <?= \Reach\SVG::get('icons/white-arrow.svg'); ?>
                        </div>

                        <div class="right-nav" style="background-color: <?= isset($args['navigation_buttons_color']) ? $args['navigation_buttons_color'] : '#FFFFFF' ?>;">
                            <?= \Reach\SVG::get('icons/white-arrow.svg'); ?>
                        </div>
                    </div>
                <?php } ?>

                <div class="swiper-wrapper">
                    <!-- Slider Options -->
                    <?php
                    // Check the type of slider and render accordingly
                    if ($args['type'] == 'cards') {
                        foreach ($args['items'] as $key => $card) { ?>
                            <div class="swiper-slide" id="card" style="width: 300px;">
                                <?= \Reach\Component::get('card', $card); ?>
                            </div>
                        <?php }
                    } elseif ($args['type'] == 'non-cards') {
                        foreach ($args['items'] as $key => $card) { ?>
                            <div class="swiper-slide" id="non-card">
                                <img src="<?= $card['content']['image']['url']; ?>" />
                                <a style="float:right;" href="<?= $card['content']['link']['url']; ?>">
                                    <h3><?= $card['content']['heading']; ?></h3>
                                </a>
                                <a style="float:right;" href="<?= $card['content']['link']['url']; ?>">
                                    <p>Learn More</p>
                                </a>
                            </div>
                        <?php }
                    } elseif ($args['type'] == 'custom') {
                        foreach ($args['items'] as $key => $card) { ?>
                            <div class="swiper-slide">
                                <div class="slider__text custom">
                                    <img src="<?= $card['background']; ?>" />
                                    <div class="custom-badge"></div>
                                    <div class="slider__text-inner">
                                        <div class="category"><?= $card['categories']; ?></div>
                                        <h3><?= $card['title']; ?></h3>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } elseif ($args['type'] == 'custom-home') {
                        foreach ($args['items'] as $key => $card) { ?>
                            <div class="swiper-slide custom-home-width">
                                <div class="slider__text custom">
                                    <a href="<?= $card['link']; ?>">
                                        <img src="<?= $card['background']; ?>" />
                                        <div class="custom-badge--<?= $card['sub_level']; ?>"></div>
                                        <div class="slider__text-inner">
                                            <div class="category"><?= $card['categories']; ?></div>
                                            <h3><?= $card['title']; ?></h3>
                                        </div>
                                    </a>
                                </div>
                            </div>
                    <?php }
                    }
                    ?>
                </div>
            </div>

            <?php if ($args['show_button'] == true) { ?>
                <div class="slider__button-container">
                    <a href="/resources/" class="button">Browse all events</a>
                </div>
            <?php } ?>
        </div>
    </div>

</section>