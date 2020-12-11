<h1 class="title"><?php print $data['title']; ?></h1>
<p class="message"><?php print $data['welcome']; ?></p>
<section class="container">
    <div class="grid_box">
        <?php foreach ($data['products'] as $index => $product) : ?>
            <div class="pizza_card">
                <?php print $product; ?>
                <div class="pizza_card_buttons">
                    <?php foreach ($data['forms'] as $form) : ?>
                        <?php $form->fill(['id' => $index]) ?>
                        <div><?php print $form->render(); ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php if (isset($data['message'])) : ?>
    <p class="message"><?php print $data['message'] ?? '' ?></p>
<?php endif; ?>