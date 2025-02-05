<section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>

    <div class='contact-form__container'>
        <div class="contact-form__inner">
            <h1><?= $args['header']; ?></h1>
            <?php 
                    echo do_shortcode("{$args['gravity_form_shortcode']}");
            ?>
        </div>
    </div>

</section>