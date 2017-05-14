<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use common\helpers\project\CityHelper;


$modelCounty = [];
if($model->county){
    $modelCounty = CityHelper::getCounty($model->county->id);
}
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
                         <label>Loại dự án</label>
                             <?php
                             echo Select2::widget([
                                 'model' => $model,
                                 'attribute' => 'project_category_id',
                                 'data' => $modelProjectCategory,
                                 'theme' => Select2::THEME_BOOTSTRAP,
                                 'options' => [
                                     'class' => 'form-control input-sm',
                                     'placeholder' => 'Chọn loại dự án'
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
                    <div class="col-sm-4">
                        <div class="form-group ">Địa chỉ
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'address', ['class' => 'form-control', 'style' =>'width: 320px;'])?>
                         </span>
                        </div>
                    </div>
                </div>
                <br><br>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group ">Diện tích
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'acreage', ['class' => 'form-control', 'style' =>'width: 320px;'])?>
                         </span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                         <span class="input-icon icon-right">
                         <label>Tỉnh/Thành</label>
                             <?php
                             echo Select2::widget([
                                 'model' => $model,
                                 'attribute' => 'city_id',
                                 'data' => $modelCity,
                                 'theme' => Select2::THEME_BOOTSTRAP,
                                 'options' => [
                                     'class' => 'form-control input-sm',
                                     'placeholder' => 'Chọn tỉnh thành',
                                     'id'=>'city_id'
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
                    <div class="col-sm-3">
                        <label>Quận huyện</label>
                        <span class="input-icon icon-right">
                                    <?php
                                    echo DepDrop::widget([
                                        'type'=>DepDrop::TYPE_SELECT2,
                                        'model' => $model,
                                        'attribute' => 'county_id',
                                        'options'=> [
                                            'id'=>'county_id',
                                            'class' => 'form-control input-sm',
                                        ],
                                        'data'=> $modelCounty,
                                        'pluginOptions'=>[
                                            'depends'=>['city_id'],
                                            'placeholder'=> 'Chọn quận huyện ...',
                                            'url'=>Url::to(['/extra/county/list'])
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
