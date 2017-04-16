

<?php

use yii\helpers\Html;



$this->title = 'Thêm mới chi nhánh';
$this->params['breadcrumbs'][] = ['label' => 'Thêm mới nhóm hàng hóa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php echo $this->render('_form', [
    'model' => $model,
    'modelRegency' => $modelRegency,
    'modelDepartment' => $modelDepartment,
    'modelBranch' => $modelBranch
]) ?>

