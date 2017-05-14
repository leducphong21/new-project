<?php

use yii\helpers\Html;


$this->title = 'Sửa lô đất: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Product Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-category-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelProject' => $modelProject
    ]) ?>

</div>
