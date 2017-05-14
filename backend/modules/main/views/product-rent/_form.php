<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use common\helpers\project\ProjectHelper;
use yii\helpers\Url;
use common\helpers\project\CityHelper;

$modelPortion = [];
if($model->project){
    $modelPortion = ProjectHelper::getPortion($model->project->id);
}

$modelLand = [];
if($model->portion){
    $modelLand = ProjectHelper::getLand($model->portion->id);
}

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

                <h1>Thông tin sản phẩm</h1>
                <br>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group ">Tên sản phẩm
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'name', ['class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <span class="input-icon icon-right">
                         <label>Loại sản phẩm 1</label>
                            <?php
                            echo Select2::widget([
                                'model' => $model,
                                'attribute' => 'product_category_id',
                                'data' => $modelProductCategory,
                                'theme' => Select2::THEME_BOOTSTRAP,
                                'options' => [
                                    'class' => 'form-control input-sm',
                                    'placeholder' => 'Chọn loại sản phẩm'
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
                                    'placeholder' => 'Chọn dự án',
                                    'id'=>'project_id'
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
                        <label>Lô đất</label>
                        <span class="input-icon icon-right">
                                    <?php
                                    echo DepDrop::widget([
                                        'type'=>DepDrop::TYPE_SELECT2,
                                        'model' => $model,
                                        'attribute' => 'portion_id',
                                        'options'=> [
                                            'id'=>'portion_id',
                                            'class' => 'form-control input-sm'
                                        ],
                                        'data'=> $modelPortion,
                                        'pluginOptions'=>[
                                            'depends'=>['project_id'],
                                            'placeholder'=> 'Chọn lô đất ...',
                                            'url'=>Url::to(['/main/portion/list'])
                                        ],
                                    ]);
                                    ?>
                                </span>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-3">
                        <label>Lô đất</label>
                        <span class="input-icon icon-right">
                                    <?php
                                    echo DepDrop::widget([
                                        'type'=>DepDrop::TYPE_SELECT2,
                                        'model' => $model,
                                        'attribute' => 'land_id',
                                        'options'=> [
                                            'id'=>'land_id',
                                            'class' => 'form-control input-sm'
                                        ],
                                        'data'=> $modelLand,
                                        'pluginOptions'=>[
                                            'depends'=>['portion_id'],
                                            'placeholder'=> 'Chọn thửa đất ...',
                                            'url'=>Url::to(['/main/land/list'])
                                        ],
                                    ]);
                                    ?>
                                </span>
                    </div>

                    <div class="col-sm-3">
                         <span class="input-icon icon-right">
                         <label>Chọn tỉnh thành</label>
                             <?php
                             echo Select2::widget([
                                 'model' => $model,
                                 'attribute' => 'city_id',
                                 'data' => $modelCity,
                                 'theme' => Select2::THEME_BOOTSTRAP,
                                 'options' => [
                                     'class' => 'form-control input-sm',
                                     'placeholder' => 'Chọn tỉnh thành',
                                     'id' => 'city_id'
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
                                            'class' => 'form-control input-sm'
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
                    <div class="col-sm-3">
                        <div class="form-group ">Diện tích
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'acreage', ['class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                        </div>
                    </div>

                </div>
                <br>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group ">Giá thuê
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'total_price', ['class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                        </div>
                    </div>
                </div>
                <br>
                <h1>Mô tả chi tiết sản phẩm</h1>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group ">Địa chỉ
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'address', ['class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group ">Số tầng
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'floors', ['class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group ">Tổng số phòng
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'rooms', ['class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group ">Số phòng ngủ
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'bedrooms', ['class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group ">Số phòng về sinh
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'bathrooms', ['class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group ">Hình ảnh
                            <span class="input-icon icon-right">
                             <?= $form->field($modelImage, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
                         </span>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group ">Mô tả
                            <span class="input-icon icon-right">
                             <?=Html::activeTextarea($model, 'description', ['class' => 'form-control', 'style' =>'width: 500px; height: 200px;'])?>
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
