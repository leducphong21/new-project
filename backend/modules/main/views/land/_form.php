<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use common\helpers\project\ProjectHelper;

$modelPortion = [];
if($model->project){
    $modelPortion = ProjectHelper::getPortion($model->project->id);
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
                        <div class="form-group ">Tên thửa đất
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'name', ['class' => 'form-control', 'style' =>'width: 320px;'])?>
                         </span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Dự án</label>
                            <span class="input-icon icon-right">
                                    <?php
                                    echo Select2::widget([
                                        'model' => $model,
                                        'attribute' => 'project_id',
                                        'data' => $modelProject,
                                        'theme' => Select2::THEME_BOOTSTRAP,
                                        'options' => [
                                            'id' => 'project_id',
                                            'class' => 'form-control input-sm',
                                            'prompt' =>'Chọn dự án',
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

                    <div class="col-sm-4">
                        <div class="form-group">
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
