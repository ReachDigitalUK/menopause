<section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <div class='quote-slider__container'>
        <div class="quote-slider__inner <?php if (!empty($args['quote_slider_type'])) {
                                            echo $args['quote_slider_type'];
                                        } ?>">
            <div class='quote-slider__media'>
                <div class='quote-slider__media-image'>
                    <img src='/wp-content/themes/reach/assets/images/quote-pic.png'>
                </div>
                <div class='quote-slider__media-text'>
                    <div class='quote-slider__review-average'></div>
                    <div class='google-logo'><img src='/wp-content/themes/reach/assets/images/google.svg'></div>
                    <h5>Customer Reviews</h5>
                </div>
            </div>
            <div class='quote-slider__quote'>
                <strong>
                    <h5 class='quote-slider__title'></h5>
                </strong>
                <p class='quote-slider__text'></p>
                <div class='quote-slider__rating'></div>
            </div>
        </div>
</section>