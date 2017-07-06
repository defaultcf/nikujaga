<?= $this->Form->create($user) ?>
<fieldset>
    <legend><?= __('ユーザー追加') ?></legend>
    <?= $this->Form->control('email') ?>
    <?= $this->Form->control('password') ?>
</fieldset>
<?= $this->Form->button(__('追加')) ?>
<?= $this->Form->end() ?>
