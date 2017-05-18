<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\project\TicketSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="ticket-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'code') ?>

    <?php echo $form->field($model, 'code_product') ?>

    <?php echo $form->field($model, 'name_product') ?>

    <?php echo $form->field($model, 'total_price') ?>

    <?php // echo $form->field($model, 'ticket_price') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'name_buyer') ?>

    <?php // echo $form->field($model, 'code_buyer') ?>

    <?php // echo $form->field($model, 'address_buyer') ?>

    <?php // echo $form->field($model, 'mobile_buyer') ?>

    <?php // echo $form->field($model, 'name_seller') ?>

    <?php // echo $form->field($model, 'code_seller') ?>

    <?php // echo $form->field($model, 'address_seller') ?>

    <?php // echo $form->field($model, 'mobile_seller') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
