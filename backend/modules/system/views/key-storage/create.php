<?php
/* @var $this yii\web\View */
/* @var $model common\models\KeyStorageItem */

$this->title = 'Thêm mới cài đặt';
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Key Storage Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="key-storage-item-create">

    <?php echo $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
