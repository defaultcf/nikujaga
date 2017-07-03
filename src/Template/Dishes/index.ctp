<?php foreach($dishes as $dish): ?>
<?= $this->Html->image($dish->imgname, ['alt' => $dish->title]); ?>
<?php endforeach; ?>
