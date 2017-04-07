<?php

use yii\helpers\Html;
use backend\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\system\models\search\KeyStorageItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cài đặt chung';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tabbable">
    <div class="widget-body">
        <div class="key-storage-item-index">

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <div class="pull-right">
                <p>
                    <?php echo Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success']) ?>
                </p>
            </div>

            <?php echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'key',
                        'format' => 'raw',
                        'headerOptions' => ['style'=>'text-align:center'],
                        'value' => function ($model) {
                            return Html::a($model->key, ['update', 'id' =>$model->key], ['class' =>'alink']);
                        },
                    ],
                    'value',

                    'comment',

                    [
                        'class' => 'backend\grid\ActionColumn',
                        'template'=>'{update} {delete}'
                    ],
                ],
            ]); ?>

        </div>
    </div>

</div>

