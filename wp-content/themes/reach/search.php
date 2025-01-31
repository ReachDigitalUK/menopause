<?php get_header(); ?>
<?php
$s=get_search_query();
$args = array(
                's' =>$s
            );

$the_query = new WP_Query( $args );

?>
<div class = 'search-results__container'>
    <div class='search-results__inner'>
    <?php

if ( $the_query->have_posts() ) {

   
            _e("<h1>Search Results for: ".get_query_var('s')."</h1>");
           ?>
            <div class='search-results__all-results'>
                <?php
            while ( $the_query->have_posts() ) {
            $the_query->the_post();
                    ?>
                    
                   
                        <div class='search-results__item'>
                        <a href="<?php the_permalink(); ?>">
                        <div class='search-results__item-content'>
                        <p><?php echo strtoupper(get_post_type()); ?></p>
                            <h3><?php the_title(); ?></h3>
                            <p><?php echo get_the_excerpt(); ?></p>
                            </div>
                            </a>
                        </div>
      



                    <?php
            }
            ?>
          
        <?php
        }else{
    ?>
            <h1>Nothing Found</h1>
            <div class="alert alert-info">
            <p>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>
            </div>
    <?php } ?>
    </div>
        </div>
    </div>

<?php
    $components[] = \Reach\Component::get('are-you-ready', [

'background_colour' => '#C8E1CF',
'padding' => ['5rem', '0rem', '5rem', '0rem'],
'margin' => ['0', '0', '0', '0'],
'text_colour' => '#5c5c5c',


],);

echo implode($components);

 get_footer(); ?>