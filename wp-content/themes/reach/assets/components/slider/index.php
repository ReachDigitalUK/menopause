<?php

$args['type'] = 'reviews';
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
          <div class="swiper cards-slider">
                <div class="swiper-wrapper">
                    <?php
                    if ($args['type'] == 'reviews') {
                        foreach ($args['items'] as $key => $card) {?>
                            <div class="swiper-slide">
                                <div class="swiper_inner">
                                    <img class='profile-photo' src='<?= $card['profile_photo_url'] ?>' />
                                    <h3 class='author_name'><?= $card['author_name']; ?></h3>
                                    <p class = 'author_date'><?= $card['time']; ?></p> 
                                    <p class='rating'><?= $card['rating']; ?></p>
                                    <p class='review-text'><?= $card['text']; ?></p>
                                    <a href = '<?= $card['author_url'] ?>'><img class='google-icon' src='/wp-content/themes/reach/_src/images/icons/google.svg' /></a>
                                </div>
                            </div>
                     <?php } 
                    } ?>
                </div>
            </div>
        </div>
</section>