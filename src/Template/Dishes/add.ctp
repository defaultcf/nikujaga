<?php

$this->Breadcrumbs->add([
    ['title' => '料理一覧', 'url' => ['controller' => 'dishes', 'action' => 'index']],
    ['title' => '追加', 'url' => ['controller' => 'dishes', 'action' => 'add']],
]);
echo $this->Breadcrumbs->render(
    ['class' => 'breadcrumbs']
);

echo $this->Form->create($dish, [
    'enctype' => 'multipart/form-data',
]);
echo $this->Form->control('title', [
    'label' => 'タイトル',
    'type' => 'text',
    'required' => true,
]);
echo $this->Form->control('description', [
    'label' => '詳細',
    'type' => 'textarea',
]);
echo $this->Form->control('img', [
    'label' => '画像',
    'type' => 'file',
    'id' => 'img',
    'accept' => 'image/jpeg, image/png',
    'required' => true,
]);
echo "<div id='preview'></div>";
echo $this->Form->button('追加');
echo $this->Form->end();

?>

<script>
if(window.File) {
    let imgfile = document.getElementById('img');
    let preview = document.getElementById('preview');

    imgfile.addEventListener('change', function(e) {
        let imgData = e.target.files[0];
        if(!imgData.type.match(/^image\/(jpeg|png)$/)) {
            alert("画像を選択してください。");
            imgfile.value = '';
            return;
        }

        let reader = new FileReader();
        reader.onload = function() {
            let img = document.createElement('img');
            img.src = reader.result;
            preview.innerHTML = '';
            preview.appendChild(img);
        }
        reader.readAsDataURL(imgData);
    }, false);
}
</script>
