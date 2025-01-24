<section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <div class="single-quote__container">
        <div class="single-quote__inner">
            <div class="single-quote__image">
                <img src="<?= $args['image']; ?>" alt="<?= $args['title']; ?>">
            </div>
            <div class="single-quote__content">
                <div class="single-quote__title">
                    <h3><?= $args['title']; ?></h3>
                </div>
                <div class="single-quote__text">
                    <p><?= $args['main_text']; ?></p>
                </div>
        </div>
    </div>
</section>