<?php

use yii\helpers\Html;
use backend\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;


$this->title = 'Danh sách nhân viên';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="row">
            <div class="tabbable">
                <div class="widget-body">
                    <div class="table-toolbar">
                        <div class="widget">


                            <div class="btn-group pull-right">
                                <a class="btn btn-success" href="<?=Url::to(['create'])?>"><i class="fa fa-plus withe"></i>Thêm mới</a>

                                <button class="btn btn-danger btnDelete"><i class="fa fa-times withe circular"></i>Xóa</button>
                            </div>
                        </div>
                    </div>

                    <div id="registration-form" style="overflow: scroll">
                        <?php Pjax::begin(['id' => 'datas', 'timeout' => 3000]); ?>
                        <?php echo GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            //'summary' => '',
                            'options' => [
                                'id' => 'w1',
                                'style'=>'width: 1500px'
                            ],
                            'columns' => [
                                ['class' => 'yii\grid\CheckboxColumn'],
                                [
                                    'attribute' => 'name',
                                    'contentOptions' => ['style' => 'width:200px;'],
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        return Html::a($model->name, ['update', 'id' =>$model->id], ['class' =>'alink']);
                                    },
                                ],
                                'code',
                                [
                                    'attribute' => 'gender',
                                    'contentOptions' => ['style' => 'width:200px;'],
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        if ($model->gender==1)
                                            return 'Nam';
                                        else if ( $model->gender==2 )
                                            return 'Nữ';
                                        else
                                            return "";
                                    },
                                ],
                                'birth_day',
                                [
                                    'attribute' => 'address',
                                    'contentOptions' => ['style' => 'width:200px;'],
                                ],
                                'phone_number',
                                'email',
                                'job',
                                'tax_code',
                                [
                                    'class' => 'backend\grid\ActionColumn',
                                    'template'=>'{update} {delete}',
                                    'contentOptions' => ['style' => 'width:200px;text-align:center'],
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
                        <?php Pjax::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php
$app_css = <<<CSS
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
CSS;
$this->registerCss($app_css);

$ajaxUrl = Url::to(['ajax-delete']);
$app_js = <<<JS
$(".btnDelete").click(function(){
    var keys = $('#w1').yiiGridView('getSelectedRows');
    if(keys.length > 0){
         bootbox.confirm({
        message: "Xác nhận xóa nội dung?",
        buttons: {
            confirm: {
                label: 'Xác nhận',
                className: 'btn-success'
            },
            cancel: {
                label: 'Hủy',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if(result){
               var keys = $('#w1').yiiGridView('getSelectedRows');
               $.ajax({
                  url: '$ajaxUrl',
                  data: {
                     ids: keys
                  },
                  error: function() {
                     alert('Có lỗi xảy ra');
                  },
                  success: function(data) {
                     $.pjax.reload({container:"#datas"}); 
                  },
                  type: 'POST'
               });
             }
            }
        });     
    }else{
        bootbox.alert("Chưa chọn nội dung cần xóa!");
    }
});
JS;
$this->registerJs($app_js);



