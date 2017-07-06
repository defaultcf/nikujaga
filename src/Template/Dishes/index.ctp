<?php
$this->Breadcrumbs->add([
    ['title' => '料理一覧', 'url' => ['controller' => 'dishes', 'action' => 'index']],
]);
echo $this->Breadcrumbs->render(
    ['class' => 'breadcrumbs']
);
?>

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

<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('<< ' . __('先頭')) ?>
        <?= $this->Paginator->prev('< ' . __('前')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('次') . ' >') ?>
        <?= $this->Paginator->last(__('末尾') . ' >>') ?>
    </ul>
    <p><?= $this->Paginator->counter(['format' => __('{{pages}}ページ中{{page}}ページ目, {{count}}件中{{current}}件表示中')]) ?></p>
</div>
