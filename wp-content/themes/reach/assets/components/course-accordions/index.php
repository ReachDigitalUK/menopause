<section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <div class="course-accordions__inner">
        <div class="course-accordions__sections">
            <?php foreach ($args['accordion'] as $section) { ?>
                <div class="course-accordions__sections__section">
                    <div class="course-accordions__sections__section__title">
                        <?= \Reach\Component::get('heading', [
                            'el' => 'h4',
                            'heading' => $section['title']
                        ]); ?>
                        <?= \Reach\SVG::get('icons/plus.svg'); ?>
                    </div>
                    <div class="course-accordions__sections__section__text">
                        <?= $section['content']; ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>