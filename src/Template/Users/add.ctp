<?= $this->Form->create($user) ?>
<fieldset>
    <legend><?= __('ユーザー登録') ?></legend>
    <small>パスワードをhash化して保存するなど、最低限のセキュリティー措置は施していますが、万が一に備えて普段使うようなパスワードは使わないでください...</small>
    <?= $this->Form->control('email', ['label' => 'メールアドレス']) ?>
    <?= $this->Form->control('password', ['label' => 'パスワード']) ?>
</fieldset>
<?= $this->Form->button(__('登録')) ?>
<?= $this->Form->end() ?>

<?= $this->Html->link('ログインはこちら', ['controller' => 'Users', 'action' => 'login']) ?>
