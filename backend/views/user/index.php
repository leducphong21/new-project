<?php

use common\grid\EnumColumn;
use common\models\User;
use yii\helpers\Html;
use backend\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="pull-right">
    <p>
        <?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
        'modelClass' => 'User',
         ]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    </div>
    <div class="clearfix"></div>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-striped table-bordered table-hover'
        ],
        'columns' => [

            [
                'attribute' => 'id',
                'format' => 'raw',
                'headerOptions' => ['style'=>'text-align:center'],
                'contentOptions' => ['style' => 'width:10%;text-align:center'],
            ],
//            [
//                'attribute' => 'fullname',
//                'format' => 'raw',
//                'headerOptions' => ['style'=>'text-align:center'],
//                'value' => function ($model) {
//                    return Html::a($model->profile->fullname);
//                },
//            ],
            [
                'attribute' => 'username',
                'format' => 'raw',
                'headerOptions' => ['style'=>'text-align:center'],
                'value' => function ($model) {
                    return Html::a($model->username, ['update', 'id' =>$model->id], ['class' =>'alink']);
                },
            ],
            'email',
            [
                'class' => EnumColumn::className(),
                'attribute' => 'status',
                'enum' => User::statuses(),
                'filter' => User::statuses()
            ],
            'created_at:datetime',
            'logged_at:datetime',
            // 'updated_at',

            [
                'class' => 'backend\grid\ActionColumn',
                'template'=>'{update} {delete}',
                'contentOptions' => ['style' => 'width:150px;text-align:center'],
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-edit"></i>Cập nhật', $url, [
                            'title' => \Yii::t('common', 'Update'),
                            'class' => 'btn btn-info btn-xs edit'
                        ]);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-trash-o"></i>Xóa', $url, [
                            'title' => \Yii::t('common', 'Delete'),
                            'class' => 'btn btn-danger btn-xs delete',
                            'data' => [
                                'confirm' => \Yii::t('common', 'Confirm Delete'),
                                'method' => 'post',
                            ]
                        ]);
                    },
                ]
            ]
        ],
    ]); ?>

</div>
