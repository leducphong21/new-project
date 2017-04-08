<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\project\ProductCategory */

$this->title = 'Create Product Category';
$this->params['breadcrumbs'][] = ['label' => 'Product Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-category-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
