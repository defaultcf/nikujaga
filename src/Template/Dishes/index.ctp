<?php
$this->Breadcrumbs->add([
    ['title' => '料理一覧', 'url' => ['controller' => 'dishes', 'action' => 'index']],
]);
echo $this->Breadcrumbs->render(
    ['class' => 'breadcrumbs']
);
?>

<?= $dishes->count(); ?>件
<hr>

<?php foreach($dishes as $dish): ?>
<?= $dish->created ?>
<?=
$this->Html->image($dish->imgname, [
    'alt' => $dish->title,
    'url' => ['controller' => 'dishes', 'action' => 'view', $dish->id]
]);
?>
<hr>
<?php endforeach; ?>
