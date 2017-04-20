<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\project\ModelProject */

$this->title = 'Create Project';
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
