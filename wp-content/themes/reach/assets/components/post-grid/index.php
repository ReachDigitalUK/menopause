<section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <div class="post-grid__container">
        <div class="post-grid__inner">
            <div class = "post-grid__filters">
                <h4>Filter by</h4>
                <select name="category" id="post_grid__category">
                    <option value="all"> -- Please Select --</option>
                    <?php
                        $categories = get_categories();
                        foreach ($categories as $category) {
                            echo '<option value="' . $category->slug . '">' . $category->name . '</option>';
                        }?>
                </select>
                <div class ="post-grid__all-button">All</div>
        </div>
                   

            <div class="post-grid__posts"></div>
        
        </div>
    </div>
</section>