<section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <div class='certificate-grid__container'>
        <div class="certificate-grid__inner">
        <?php foreach($args['certificate'] as $certificate){?>
            <div class="certificate-grid__item">
                    <div class="certificate-grid__item-content">
                        <h3 class="certificate-grid__item-title"><?= $certificate['title']; ?></h3>
                        <p class="certificate-grid__item-description"><?= $certificate['description']; ?></p>
                        <a href="<?= $certificate['link']['url']; ?>" class="button-yellow"><?= $certificate['link']['title']; ?></a>
                    </div>
                </div>
        <?php }?>

        </div>
    </div>
</section>