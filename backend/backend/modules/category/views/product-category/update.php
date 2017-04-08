<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\project\ProductCategory */

$this->title = 'Update Product Category: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Product Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-category-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
