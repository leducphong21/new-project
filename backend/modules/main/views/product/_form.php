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

                <h1>Thông tin sản phẩm</h1>
                <br>
                <div class="row">
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
                                     'placeholder' => 'Chọn tỉnh thành'
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
                         <label>Chọn quận huyện</label>
                             <?php
                             echo Select2::widget([
                                 'model' => $model,
                                 'attribute' => 'county_id',
                                 'data' => $modelCounty,
                                 'theme' => Select2::THEME_BOOTSTRAP,
                                 'options' => [
                                     'class' => 'form-control input-sm',
                                     'placeholder' => 'Chọn quận huyện'
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
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group ">Giá mết vuông
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'price', ['class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group ">Diện tích
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'acreage', ['class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group ">Số lượng
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'count', ['class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                        </div>
                    </div>
                </div>
                <br>
                <h1>Mô tả chi tiết sản phẩm</h1>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group ">Địa chỉ
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'address', ['class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                        </div>
                        <br><br><br>
                        <div class="form-group ">Hình ảnh
                            <span class="input-icon icon-right">
                             <?= $form->field($modelImage, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
                         </span>
                        </div>
                    </div>
                    <div class="col-sm-8">
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
