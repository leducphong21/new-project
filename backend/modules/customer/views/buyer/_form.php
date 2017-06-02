<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;


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
                        <div class="form-group ">Tên
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'name', ['class' => 'form-control'])?>
                         </span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group ">Giới tính
                            <span class="input-icon icon-right">
                             <?=Html::activeDropDownList($model, 'gender',['1'=>'Nam','2'=>'Nữ'],['prompt'=>'Vui lòng chọn giới tính....',['class' => 'form-control'],['style'=> 'width:100% ']],['maxlenght'=> true])?>

                         </span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($model, 'birth_day', [
                            'template' => '{label} <span class="input-icon icon-right">{input}{error}{hint}</span>',
                        ])->widget(
                            'trntv\yii\datetime\DateTimeWidget',
                            [
                                'phpDatetimeFormat' => 'dd/MM/yyyy',
                                'showInputAddon' => true,
                                'options' => [
                                    'class' => 'form-control input-sm',
                                    'id' =>'ivDateIn'
                                ],
                                'clientOptions' => [
                                    //'minDate' => new \yii\web\JsExpression('new Date("2017-01-01")'),
                                    'locale' => 'vi',
                                    'allowInputToggle' => true,
                                ]]
                        )->label('Ngày sinh') ?>
                    </div>


                </div>
                <br>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group ">Số điện thoại
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'phone_number', ['class' => 'form-control'])?>
                         </span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group ">Địa chỉ
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'address', ['class' => 'form-control'])?>
                         </span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group ">Email
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'email', ['class' => 'form-control', 'style'])?>
                         </span>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">

                    <div class="col-sm-4">
                        <div class="form-group ">Nghề nghiệp
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'job', ['class' => 'form-control'])?>
                         </span>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group ">Mã số thuế
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'tax_code', ['class' => 'form-control'])?>
                         </span>
                        </div>
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
