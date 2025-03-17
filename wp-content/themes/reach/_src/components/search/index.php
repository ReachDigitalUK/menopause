<section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <div class='search'>
        <div class='search__inner'>
            <div class='search__text'>
                <p class='search__text_title'>Search</p>
            </div>
            <div class='relative'>
                <form role="search" method="get" action="<?= esc_url(home_url('/')); ?>">
                <div class='search__input_wrapper'>
                <input type='text' class='search__input' name="s" value="<?= get_search_query(); ?>">
            </div>
            </form>
        </div>
    </div>
</div>
</section>

