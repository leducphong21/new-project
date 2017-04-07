<?php
/**
 * Created by PhpStorm.
 * User: sirja
 * Date: 01/03/2017
 * Time: 6:19 SA
 */

$format = Yii::$app->getFormatter();
$format->thousandSeparator = '.';

//Logging
Yii::warning('Start Log: ', 'gara');
?>
Form Filed

<?= $form->field($model, 'no', [
    'template' => '{label} <span class="input-icon icon-right">{input}{error}{hint}</span>',
])->textInput(['class' => 'form-control input-sm'])->label('Biển số xe') ?>

