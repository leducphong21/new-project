<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?php echo ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="<?php echo Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">

    <?php echo "<?php " ?>$form = ActiveForm::begin([
    'layout' => 'horizontal',
    ]); ?>

    <?php echo "<?php echo " ?>$form->errorSummary($model); ?>

<?php foreach ($generator->getColumnNames() as $attribute) {
    if (in_array($attribute, $safeAttributes)) {
        echo "    <?php echo " . $generator->generateActiveField($attribute) . " ?>\n\n";
    }
} ?>

    <div class="form-group">
        <div class="col-sm-<?=$model->isNewRecord? '3': '1'?> col-xs-2"></div>
        <div class="col-sm-3 col-xs-4">
            <?php echo "<?php ". "\n" ?>
            echo \yii\helpers\Html::a('<span class="glyphicon glyphicon-arrow-left"></span>'. Yii::t('backend', 'Back'), ['index'],['class'=>'btn btn-default btn200']);
            ?>
        </div>
        <div class="col-sm-3 col-xs-4">
            <?php echo "<?php echo " ?> Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn200' : 'btn btn-primary btn200']) ?>
        </div>
        <div class="col-sm-3 col-xs-2">
            <?php echo "<?php ". "\n"; ?>
            if (!$model->isNewRecord) {
                echo Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id],
                    [
                        'class' => 'btn btn-warning btn200 bold',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete?',
                            'method' => 'post',
                        ]
                    ]);
            }
            ?>
        </div>
    </div>


    <?php echo "<?php " ?>ActiveForm::end(); ?>

</div>
