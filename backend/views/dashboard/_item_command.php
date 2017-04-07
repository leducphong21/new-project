<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\gara\repair\RepairCommand */
?>
<li class="order-item">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 item-left">
            <div class="item-booker"><?= isset($model->customer) ? $model->customer->name : '' ?></div>
            <div class="item-time">
                <i class="fa fa-calendar"></i>
                <span><?php echo Yii::$app->formatter->asRelativeTime(strtotime($model->created_at)) ?></span>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 item-right">
            <div class="item-price">
                <span class="currency"><b>Kỹ thuật:</b></span>
                <span class="price"><?= isset($model->technician) ? $model->technician->username : '' ?></span>
            </div>
        </div>
    </div>
    <a class="item-more" href="<?= Url::to(['/repair/repair-command/update', 'id' => $model->id]) ?>">
        <i></i>
    </a>
</li>
