<?php
$this->Breadcrumbs->add([
    ['title' => '料理一覧', 'url' => ['controller' => 'dishes', 'action' => 'index']],
    ['title' => h($dish->title), 'url' => ['controller' => 'dishes', 'action' => 'view', $dish->id]],
]);
echo $this->Breadcrumbs->render(
    ['class' => 'breadcrumbs']
);
?>

<h3><?= $dish->title ?></h3>
<?= $this->Html->image($dish->imgname, ['alt' => $dish->title]); ?>
<br>
<?= $dish->description ?>
