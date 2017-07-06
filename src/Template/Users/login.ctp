<?= $this->Flash->render() ?>
<?= $this->Form->create() ?>
<fieldset>
    <legend><?= __('ログイン') ?></legend>
    <?= $this->Form->control('email', ['label' => 'メールアドレス']) ?>
    <?= $this->Form->control('password', ['label' => 'パスワード']) ?>
</fieldset>
<?= $this->Form->button(__('ログイン')); ?>
<?= $this->Form->end() ?>

<?= $this->Html->link('ユーザー登録はこちら', ['controller' => 'Users', 'action' => 'add']) ?>
