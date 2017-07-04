<h3><?= $dish->title ?></h3>
<?= $this->Html->image($dish->imgname, ['alt' => $dish->title]); ?>
<br>
<?= $dish->description ?>
