<section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <div class="homepage-hero__container">
        <div class="homepage-hero__inner">
            <div class='homepage-hero__header-top'>
                <div class='homepage-hero__text'>
                    <h1> <?php echo $args['header']; ?> </h1>
                    <p> <?php echo $args['sub_header']; ?> </p>

                    <?php if (!empty($args['homepage_checks'])) {
                        foreach ($args['homepage_checks'] as $check) { ?>
                            <div class='homepage-hero__check'>
                                <p><?php echo $check['check']; ?> </p>
                            </div>
                        <?php } ?>
                    <?php } ?>


                    <?php if (!empty($args['button'])) { ?>
                        <div class='homepage-hero__button'>
                            <a href="<?php echo $args['button']['url']; ?>" class='<?php echo $args['button_class'] ?>'><?php echo $args['button']['title']; ?></a>
                        </div>
                    <?php } ?>
                </div>

                <div class='homepage-hero__image'>
                    <img src="/wp-content/themes/reach/assets/images/home.svg" alt="homepage-hero-image">
                </div>

            </div>

            <?php $components = [];

            $components[] = \Reach\Component::get(
                'quote-slider',
                [

                    'padding' => ['15rem', '0rem', '0rem', '0rem'],
                    'margin' => ['0', '0', '0', '0'],
                    'text_colour' => '#5c5c5c',
                    'quote_slider_type' => 'home-page-hero',
                ],
            );



            echo implode($components);

            ?>


        </div>
    </div>
</section>