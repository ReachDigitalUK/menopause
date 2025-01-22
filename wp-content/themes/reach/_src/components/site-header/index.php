<header <?= \Reach\Helpers::buildAttributes($args['attributes']) ?>>

    <div class="site-header__inner">
        <div class='site-header__top-menu'>
            <div class="site-header__top">
                <?= \Reach\Component::get('link', [
                'url' => home_url('/'),
                'classes' => ['site-header__logo', 'img-fit'],
                'content' => \Reach\Image::get('logo.svg', [
                    'alt' => get_bloginfo('name'),
                    'loading' => false,
                    'attributes' => [
                        'data-spai-eager' => class_exists('\\ShortPixelAI') ? 'true' : null,
                    ],
                ]),
                'content_filter' => false,
            ]); ?>

            <div class='site-header__reviews-rating'>
                <?=  do_shortcode('[reviews_rating]'); ?>
            </div>

            <div class='menu-wrapper'>
                <?= \Reach\Component::get('menu', [
                    'theme_location' => 'header-top',
                    'menu_id' => 'header', // Required for 'aria-controls' in burger component.
                    'classes' => [
                        'site-header__navigation',
                    ],
            ]); ?>
            </div>

         <?= \Reach\Component::get('burger', [
        'classes' => [
            'site-header__burger',
            'js-site-header-toggle',
        ],
        'attributes' => [
            'aria-label' => __('Main menu button', 'reach'),
            'aria-controls' => 'main-menu',
            'aria-expanded' => 'false',
        ],
    ]); ?>
    </div>

    </div>
        <div class='site-header__bottom-menu'>
            <div class="site-header__bottom">
                <?= \Reach\Component::get('megamenu', [
                'theme_location' => 'header',
                'menu_id' => 'header', // Required for 'aria-controls' in burger component.
                'classes' => [
                    'site-header__navigation',
                ],
            ]); ?>

                <div class='site-header__bottom__right'>
                    <?= \Reach\Component::get('search', [     
                'classes' => ['site-header__search'],
                ],
            ); ?>

                    <div class='call-to-action'>
                        <a href='/book/' class='button-yellow'>Book consultation</a>
                    </div>

                </div>
            </div>
        </div>
</header>