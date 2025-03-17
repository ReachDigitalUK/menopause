<section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <div class='who-we-are__container'>

        <div class="who-we-are__title">
            <div class='who-we-are__top-content'>
                <h1 class="who-we-are__title__text"><?= $args['title']; ?></h1>

                <div class='who-we-are__buttons'>
                    <div class="who-we-are__button_inner">
                        <?php if(!empty($args['buttons'])){?>
                        <?php foreach($args['buttons'] as $button){ ?>
                        <a href="<?= $button['button']['url']; ?>"
                            class="<?= $button['button_class'] ?>"><?= $button['button']['title']; ?></a>
                        <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class='who-we-are__content'>
            <div class='who-we-are__content__inner'>
                <div class='who-we-are__content__image'>
                    <img src='<?= $args['image']; ?>'>
                </div>
                <div class='who-we-are__job'>
                    <h4><?= $args['job_title']; ?></h4>
                </div>
                <div class='who-we-are__name'>
                    <h2><?= $args['name_and_title']; ?></h2>
                </div>
                <div class='who-we-are__description'>
                    <p><?= $args['description']; ?></p>
                </div>
            </div>
        </div>

</section>