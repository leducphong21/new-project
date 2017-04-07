<?php
/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
$this->title = 'Khai báo năm tài chính';
?>
<div class="box">
    <div class="box-body">
        <?php echo \common\components\keyStorage\FormWidget::widget([
            'model' => $model,
            'formClass' => '\yii\bootstrap\ActiveForm',
            'submitText' => Yii::t('backend', 'Lưu lại'),
            'submitOptions' => ['class' => 'btn btn-primary']
        ]); ?>
    </div>
</div>

