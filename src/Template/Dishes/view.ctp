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

<?= $this->Form->create($comment); ?>
<?= $this->Form->control('comment', [
    'label' => 'コメント',
]); ?>
<?= $this->Form->button('投稿'); ?>
<?= $this->Form->end(); ?>

<?php foreach($comments as $com): ?>
<small><?= $com->created ?></small>
<p><?= $com->comment ?></p>
<?php endforeach; ?>
