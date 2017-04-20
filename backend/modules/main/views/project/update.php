<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\project\ModelProject */

$this->title = 'Update Project: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="project-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
