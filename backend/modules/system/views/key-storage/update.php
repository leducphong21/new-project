<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\KeyStorageItem */

$this->title = 'Cập nhật cài đặt' . ' ' . $model->key;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Key Storage Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="key-storage-item-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
