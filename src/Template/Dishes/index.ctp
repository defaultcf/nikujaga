<?php foreach($dishes as $dish): ?>
<?= $dish->created ?>
<?= $this->Html->image($dish->imgname, ['alt' => $dish->title]); ?>
<hr>
<?php endforeach; ?>
