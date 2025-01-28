<section <?= \Reach\Helpers::buildAttributes($args['attributes']); ?>>
    <div class='are-you-ready__container'>
        <div class="are-you-ready__inner">
            <?php
                $components = [];

                $components[] = \Reach\Component::get('title', [
                    'sub_heading' => 'Are you ready?',
                    'heading' => 'Take control of your menopause',
                    'description' => 'Put yourself back in control.',
                    'button' => [
                        'text' => 'Reclaim your confidence now',
                        'url' => 'https://www.google.com',
                    ],
                    'button_class' => 'button-yellow',
            
                ]);

                $components[] = \Reach\Component::get('quote-slider');


                echo implode($components);



            ?>



        </div>
    </div>
</section>