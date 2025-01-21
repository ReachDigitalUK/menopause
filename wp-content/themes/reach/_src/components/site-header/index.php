<header <?= \Reach\Helpers::buildAttributes($args['attributes']) ?>>
    <div class="site-header__inner">
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

            <button
                class="site-header__search-toggler site-header__search-toggler--mobile reach-button"
                aria-expanded="false"
                aria-controls="site-header-search-form">
                <span class="visually-hidden">
                    <?= esc_html__('Expand the search field', 'reach'); ?>
                </span>
            </button>

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

        <div class="site-header__bottom">
            <?= \Reach\Component::get('menu', [
                'theme_location' => 'header',
                'menu_id' => 'main-menu', // Required for 'aria-controls' in burger component.
                'classes' => [
                    'site-header__navigation',
                ],
            ]); ?>

            <button
                class="site-header__search-toggler site-header__search-toggler--desktop reach-button reach-button--square"
                aria-expanded="false"
                aria-controls="site-header-search-form">
                <span class="visually-hidden">
                    <?= esc_html__('Expand the search field', 'reach'); ?>
                </span>
            </button>

            <?php if (!empty($args['content']['call_to_action_1'])) { ?>
                <div class="site-header__widgets">
                    <?= \Reach\Component::get('link', $args['content']['call_to_action_1']); ?>
                </div>
            <?php } ?>
        </div>

        <?= \Reach\Component::get('header-search', [
            'id' => 'site-header-search-form',
            'classes' => ['js-expandable-element'],
        ]); ?>
    </div>
</header>