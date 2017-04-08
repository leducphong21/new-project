<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\PasswordResetRequestForm */

$this->title =  Yii::t('frontend', 'Request password reset');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-box">
    <div class="login-logo">
        <a href=""><b>Garage Management</b></a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg"><?php echo Html::encode($this->title) ?></p>
        <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
        <div class="form-group has-feedback">
                <?=Html::activeTextInput($model,'email' , ['class' => 'form-control' , 'placeholder' => 'Email'])?>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <?php echo Html::submitButton('Gửi', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>


