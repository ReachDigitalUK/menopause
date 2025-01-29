<?php get_header(); ?>

<div class="single-post__container">

    <div class="single-post__content">

        <?php if (have_posts()){
            while (have_posts()){
                the_post(); ?>

        <div class='single-post__category'>
            <?php the_category(); ?>
        </div>

        <div class='single-post__title'>
            <h1><?php the_title(); ?></h1>
        </div>

        <div class='single-post__date'>
            <?php the_date(); ?>
        </div>

        <div class='single-post__image'>
            <?php the_post_thumbnail('full'); ?>
        </div>

        <div class='single-post__content'>
            <?php the_content(); ?>
        </div>
        <?php   }

        } ?>
    </div>

    <div class="single-post__slider">
        <?php 


        
        $components[] = \Reach\Component::get('slider', [
            'top_header' => 'You may also like',
            'card_source' => 'recent',
            'post_type' => 'post',
            'limit' => 14,
            'break_container' => false,
            'background_colour' => '#FDFBE6',
            ]);

            echo implode($components);

            ?>


</div>

<?php get_footer(); ?>