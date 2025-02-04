<?php




///////// render slider for reviews //////////


if($args['card_source'] === 'reviews'){
        $headerClass = '';

        foreach ($args['items'] as $key => $card) {

            //get rating and make it round number and add stars
            $rating = $card['rating'];
            $rating = round($rating);
            $ratingString = '';
            for ($i = 0; $i < $rating; $i++) {
                $ratingString .= '<img src="/wp-content/themes/reach/_src/images/icons/star.svg" />';
            }
            $args['items'][$key]['rating'] = $ratingString;

            //make review text shorter and add '...' at the end
            $text = $card['text'];
            $text = substr($text, 0, 200);
            $text = $text . '...See More';
            $args['items'][$key]['text'] = $text;

        }
?>
<section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?> style="margin-top: 0px; margin-bottom: 0px;">
    <div class="slider__inner">

    <?php if(!empty($args['top_header_slider'])) { ?>
            <div class="slider__top-header">
                <h2><?= $args['top_header_slider']; ?></h2>
                <a href="<?= $args['cta']['url']; ?>"><?php echo $args['cta']['title']; ?></a>
            </div>
        <?php } ?>

        <?php if($args['show_navigation'] === true) { ?>
            <div class="slider__navigation">
                <div class="left-nav"><?= \Reach\SVG::get('slider-left.svg'); ?></div>
                <div class="right-nav"><?= \Reach\SVG::get('slider-right.svg'); ?></div>
            </div>
        <?php } ?>

          <div class="swiper cards-slider">
                <div class="swiper-wrapper">
                    <?php
                        foreach ($args['items'] as $key => $card) {?>
                            <div class="swiper-slide review-card">
                                <div class="swiper_inner">
                                    <img class='profile-photo' src='<?= $card['profile_photo_url'] ?>' />
                                    <h3 class='author_name'><?= $card['author_name']; ?></h3>
                                    <p class = 'author_date'><?= $card['time']; ?></p> 
                                    <p class='rating'><?= $card['rating']; ?></p>
                                    <p class='review-text'><?= $card['text']; ?></p>
                                    <a href = '<?= $card['author_url'] ?>'><img class='google-icon' src='/wp-content/themes/reach/_src/images/icons/google.svg' /></a>
                                </div>
                            </div>
                     <?php } ?>
                </div>
            </div>
        </div>
</section>

<?php } ?>


<?php

///////// Render slider for recent posts //////////

if ($args['card_source'] === 'recent') {

    $args['type'] = 'recent';

    // Loop through each item and fetch data
    foreach ($args['items'] as $key => $card) {
        // Fetch the featured image URL or set a fallback
        $card_image = get_the_post_thumbnail_url($card['object']->ID, 'full') ?: 'path/to/default-image.jpg';
        $args['items'][$key]['post_image'] = $card_image;
    }
    ?>
    <!-- Slider Section -->
    <section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?> style="margin-top: 0px; margin-bottom: 0px;">
        <div class="slider__inner">

            <?php if(!empty($args['top_header_slider'])) { ?>
            <div class="slider__top-header">
                <h2><?= $args['top_header_slider']; ?></h2>
                <a href="<?= $args['cta']['url']; ?>"><?php echo $args['cta']['title']; ?></a>
            </div>
        <?php } ?>

        <?php if($args['show_navigation'] === true) { ?>
            <div class="slider__navigation">
                <div class="left-nav"><?= \Reach\SVG::get('slider-left.svg'); ?></div>
                <div class="right-nav"><?= \Reach\SVG::get('slider-right.svg'); ?></div>
            </div>
        <?php } ?>






            <div class="swiper cards-slider">
                <div class="swiper-wrapper">
                    <?php
                    // Render each card as a slide
                    foreach ($args['items'] as $card) {
                        $post = $card['object']; // Access the WP_Post object
                        ?>
                        <div class="swiper-slide post-card">
                            <div class="swiper_inner--post">
                                <!-- Image -->
                                <div class="post-image-container">
                                    <img class="post-image" src="<?= esc_url($card['post_image']); ?>" alt="<?= esc_attr($post->post_title); ?>" />
                                    <div class="post-category"><?= esc_html(get_the_category($post->ID)[0]->name); ?></div>
                                </div>
                                <!-- Content -->
                                <div class="post-content">
                                    <p class="post_date"><?= esc_html(get_the_date('F j, Y', $post->ID)); ?></p>
                                    <p class="post_title"><?= esc_html($post->post_title); ?></p>
                                    <a class= 'post_link' href="<?= esc_url(get_the_permalink($post->ID)); ?>">Read more</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php
}