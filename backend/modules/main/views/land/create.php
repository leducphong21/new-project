

<?php

use yii\helpers\Html;



$this->title = 'Thêm mới thửa đất';
$this->params['breadcrumbs'][] = ['label' => 'Thêm mới nhóm hàng hóa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php echo $this->render('_form', [
    'model' => $model,
    'modelProject' => $modelProject
]) ?>

