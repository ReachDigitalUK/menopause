<?php get_header(); ?>

<div class="single-post__container">

<div class='single-post__return'>
            <a href="/free-resource/">Back to Free resources</a>
        </div>


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


        $components[] = \Reach\Component::get('are-you-ready', [

            'background_colour' => '#C8E1CF',
            'padding' => ['5rem', '0rem', '5rem', '0rem'],
            'margin' => ['0', '0', '0', '0'],
            'text_colour' => '#5c5c5c',


        ],);





            echo implode($components);

            ?>


</div>

<?php get_footer(); ?>