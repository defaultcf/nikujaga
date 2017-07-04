<?php

echo $this->Form->create($dish, ['enctype' => 'multipart/form-data']);
echo $this->Form->control('title', ['label' => 'タイトル', 'type' => 'text', 'required' => true]);
echo $this->Form->control('description', ['label' => '詳細', 'type' => 'textarea']);
echo $this->Form->file('img', ['required' => true]);
echo $this->Form->button('追加');
echo $this->Form->end();

?>
