<?php

use yii\helpers\Html;
use backend\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'Danh sách loại sản phẩm';
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
                            ],
                            'columns' => [
                                ['class' => 'yii\grid\CheckboxColumn'],
                                [
                                    'attribute' => 'name',
                                    'contentOptions' => ['style' => 'width:150px;'],
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        return Html::a($model->name, ['update', 'id' =>$model->id], ['class' =>'alink']);
                                    },
                                ],
                                [
                                    'attribute' => 'code',
                                    'contentOptions' => ['style' => 'width:70px;'],
                                ],
                                [
                                    'attribute' => 'product_category_id',
                                    'contentOptions' => ['style' => 'width:150px;'],
                                    'value' => function ($model) {
                                        return $model->productCategory? $model->productCategory->name : '';
                                    },
                                ],
                                [
                                    'attribute' => 'price',
                                    'contentOptions' => ['style' => 'width:90px;'],
                                ],
                                [
                                    'attribute' => 'acreage',
                                    'contentOptions' => ['style' => 'width:90px;'],
                                ],
                                [
                                    'attribute' => 'total_price',
                                    'contentOptions' => ['style' => 'width:90px;'],
                                ],
                                [
                                    'attribute' => 'status',
                                    'contentOptions' => ['style' => 'width:150px;'],
                                    'value' => function ($model) {
                                        if($model->status==1)
                                            return 'Không mở bán';
                                        else if($model->status==2)
                                            return 'Mở bán';
                                    },
                                ],
                                [
                                    'attribute' => 'status_description',
                                    'contentOptions' => ['style' => 'width:150px;'],
                                    'value' => function ($model){
                                        if ($model->description != '')
                                            return 'Đã mô tả';
                                        else
                                            return 'Chưa mô tả';
                                    }
                                ],
                                [
                                    'class' => 'backend\grid\ActionColumn',
                                    'template'=>'{view}{my_button}{update} {delete}',
                                    'contentOptions' => ['style' => 'width:250px;text-align:center'],
                                    'buttons' => [
                                        'view' => function ($url, $model, $key) {
                                            return Html::button('<span class="glyphicon glyphicon-eye-open"></span> Chi tiết', [
                                                'class' => 'activity-view-link btn btn-dèault btn-xs',
                                                'title' => Yii::t('yii', 'View'),
                                                'data-toggle' => 'modal',
                                                'data-target' => '#activity-modal',
                                                'data-id' => $key,
                                                'data-pjax' => '0',

                                            ]);
                                        },
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

    <div id="activity-modal" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 70%">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Thông tin chi tiết sản phẩm</h4>
                </div>
                <div class="modal-body">
                    <table id="show-info">
                        <tr>
                            <td class="width">
                                Tên sản phẩm:
                            </td>
                            <td>
                                <p id="name"></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="width">
                                Mã sản phẩm:
                            </td>
                            <td>
                                <p id="code"></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="width">
                                Loại sản phẩm:
                            </td>
                            <td>
                                <p id="product_category"></p>
                            </td>
                        </tr>
<!--                        <tr>-->
<!--                            <td class="width">-->
<!--                                Khu vực:-->
<!--                            </td>-->
<!--                            <td>-->
<!--                                <p id="khuvuc"></p>-->
<!--                            </td>-->
<!--                        </tr>-->
                        <tr>
                            <td class="width">
                                Địa chỉ:
                            </td>
                            <td>
                                <p id="address"></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="width">
                                Giá mét:
                            </td>
                            <td>
                                <p id="price"></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="width">
                                Diện tích:
                            </td>
                            <td>
                                <p id="acreage"></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="width">
                                Tổng giá:
                            </td>
                            <td>
                                <p id="total_price"></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="width">
                                Số tầng
                            </td>
                            <td>
                                <p id="floors"></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="width">
                                Tổng số phòng
                            </td>
                            <td>
                                <p id="rooms"></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="width">
                                Số phòng ngủ
                            </td>
                            <td>
                                <p id="bedrooms"></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="width">
                                Số phòng vệ sinh
                            </td>
                            <td>
                                <p id="bathrooms"></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="width">
                                Mô tả:
                            </td>
                            <td>
                                <p id="description"></p>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <?php
        $url = url::to(['product-sale/ajax-info']);
    ?>
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

#show-info tr td{
    padding: 5px 10px;
}

.width{
    width: 200px;
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

$(".activity-view-link").click(function() {
    var ab = $(this).data("id");
    console.log(ab);
                    $.ajax({
                    url : "$url", 
                    type : "get", 
                    dateType:"text", 
                    data : { 
                         id : ab
                    },
                    success : function (data){
                        $('#name').html(data.name);
                        $('#code').html(data.code);
                        $('#product_category').html(data.product_category);
                        // $('#khuvuc').html(data.county + ' - ' + data.city);
                        $('#price').html(data.price);
                        $('#acreage').html(data.acreage);
                        $('#address').html(data.address);
                        $('#total_price').html(data.total_price);
                        $('#floors').html(data.floors + ' tầng');
                        $('#rooms').html(data.rooms + ' phòng');
                        $('#bedrooms').html(data.bedrooms + ' phòng ngủ');
                        $('#bathrooms').html(data.bathrooms + ' phòng vệ sinh');
                        $('#description').html(data.description);
                    }
                });
});
JS;
$this->registerJs($app_js);



