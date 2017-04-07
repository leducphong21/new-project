<?php

use common\models\User;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserForm */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $roles yii\rbac\Role[] */
/* @var $permissions yii\rbac\Permission[] */
?>

    <div class="user-form">
        <br>

        <?php $form = ActiveForm::begin([
            'layout' => 'horizontal',
        ]); ?>

        <?php echo $form->errorSummary($model, [
            'class' => 'alert alert-warning alert-dismissible',
            'header' => ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-warning"></i> Vui lòng sửa các lỗi sau</h4>'
        ]); ?>

        <?php echo $form->field($model, 'username') ?>

        <?php echo $form->field($model, 'email') ?>

        <?php echo $form->field($model, 'password')->passwordInput([
            'autocomplete' => 'off',
            'readonly' => true,
            'onfocus' => "this.removeAttribute('readonly');",
        ]) ?>

        <?php echo $form->field($model, 'status', [
            'template' => '{label} <div class="row"><div class="col-xs-3 col-sm-3">{input}{error}{hint}</div></div>'
        ])->dropDownList(User::statuses()) ?>

        <?php echo $form->field($model, 'roles')->checkboxList($roles) ?>

        <hr>
        <div class="form-group">
            <div class="col-sm-<?= $model->username ? '2' : '3' ?> col-xs-2"></div>
            <div class="col-sm-3 col-xs-4">
                <?php
                echo \yii\helpers\Html::a('<span class="glyphicon glyphicon-arrow-left"></span> Quay lại', ['index'], ['class' => 'btn btn-default btn200']);
                ?>
            </div>
            <div class="col-sm-3 col-xs-4">
                <?php echo Html::submitButton( 'Lưu lại', ['class' => 'btn btn-primary btn200', 'name' => 'signup-button']) ?>
            </div>
            <div class="col-sm-3 col-xs-2">

            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
<?php
$app_css = <<<CSS
.form-control[readonly], fieldset[disabled] .form-control {
    background-color: #fff !important;
    opacity: 1;
}
CSS;
$this->registerCss($app_css);

$app_css1 = <<<CSS
input[type=checkbox], input[type=radio]
{
  opacity: 1 !important;
  left: 22px !important;
}
.select-on-check-all{
margin-top: -20px !important;
}
@media (max-width: 1500px) {
input[type=checkbox], input[type=radio]
{
  opacity: 1 !important;
  left: 18px !important;
  width: 14px;
  height: 14px;
}
}
.checkbox label {
    padding-left: 30px;
}
CSS;
$this->registerCss($app_css1);