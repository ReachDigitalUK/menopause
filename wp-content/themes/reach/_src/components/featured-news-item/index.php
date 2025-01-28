<section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <div class='featured-news-item__container'>
        <div class='featured-news-item__inner'>
            <div class='featured-news-item__image'>
                <img src='<?= $args['feautured_post']['post_image']; ?>' />
            </div>
            <div class='featured-news-item__content'>
                <div class = 'featured-news-item__category'>
                    <?= $args['feautured_post']['post_category']; ?>
                </div>
                <div class='featured-news-item__date'>
                    <?= $args['feautured_post']['post_date']; ?>
                </div>
                <div class='featured-news-item__title'>
                    <?= $args['feautured_post']['post_title']; ?>
                </div>
                <div class='featured-news-item__read-more'>
                    <a href='<?= $args['feautured_post']['post_link']; ?>'>Read More</a>
                </div>
            </div> 
        </div>
    </div>
</section>