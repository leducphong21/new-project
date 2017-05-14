<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;


?>
<div class="tabbable">
    <div class="widget-body">
        <div class="table-toolbar">
            <div class="widget">
                <?php $form = ActiveForm::begin([
                    'options' => [
                        'class' => 'form-inline',
                        'role' => 'form'
                    ]
                ]); ?>
                <?php echo $form->errorSummary($model, [
                    'class' => 'alert alert-warning alert-dismissible',
                    'header' => ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-warning"></i> Vui lòng sửa các lỗi sau</h4>'
                ]); ?>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group ">Tên dự án
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'name', ['class' => 'form-control', 'style' =>'width: 320px;'])?>
                         </span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                    <span class="input-icon icon-right">
                         <label>Dự án</label>
                        <?php
                        echo Select2::widget([
                            'model' => $model,
                            'attribute' => 'project_id',
                            'data' => $modelProject,
                            'theme' => Select2::THEME_BOOTSTRAP,
                            'options' => [
                                'class' => 'form-control input-sm',
                                'placeholder' => 'Chọn dự án'
                            ],
                            'size' => Select2::SMALL,
                            'pluginOptions' => [
                                'tags' => false,
                                'tokenSeparators' => [',', ' '],
                                'maximumInputLength' => 20
                            ],
                        ]);
                        ?>
                    </span>
                    </div>
                </div>
                <br>
                <div class=" pull-right">
                    <div class="btn-group pull-right">
                        <button type="submit" class="btn btn-success" href="javascript:void(0);">
                            <i class="fa fa-save"></i>Lưu lại</button>
                        <a class="btn btn-danger" href="<?=\yii\helpers\Url::to(['index'])?>"><i class="fa fa-backward"></i>Quay lại</a>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
