<?php
//
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use common\helpers\project\ProductHelper;
use yii\web\JsExpression;
use common\models\project\Seller;
use common\models\project\Buyer;

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
                    <h3>Thông tin chung</h3>
                    <br>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group ">Số hợp đồng
                                <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'code', ['class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Phiêu đặt cọc</label>
                                <span class="input-icon icon-right">
                                        <?php
                                        echo Select2::widget([
                                            'model' => $model,
                                            'attribute' => 'ticket_id',
                                            //'name' => 'car_id',
                                            'data' => $modelTicket,
                                            //'value' => $model->car_id,
                                            'theme' => Select2::THEME_BOOTSTRAP,
                                            'options' => [
                                                'placeholder' => 'Chọn phiếu đặt cọc ...',
                                                'class' => 'form-control input-sm',
                                                'id' => 'ticket'
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true,
                                                'tags' => true,
                                                'tokenSeparators' => [','],
                                                'maximumInputLength' => 15,
                                                //'minimumInputLength' => 2,
                                                'language' => [
                                                    'errorLoading' => new JsExpression("function () { return 'Đang tìm kiếm...'; }"),
                                                ],
                                                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                                'templateSelection' => new JsExpression('function (city) { return city.text; }'),
                                            ],
                                            'pluginEvents' => [
                                                "change" => "function() { console.log('change'); }",
                                                "select2:unselect" => "function() { console.log('unselect'); }"
                                            ]
                                        ]);
                                        ?>
                                     </span>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group ">Tên sản phẩm
                                <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'name_product', ['id'=>'name_product','class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group ">Mã sản phẩm
                                <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'code_product', ['id'=>'code_product','class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group ">Tổng giá sản phẩm
                                <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'total_price', ['id'=>'total_price_product','class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                            </div>
                        </div>


                    </div>
                    <br>
                    <h3>Thông tin chủ sở hữu</h3>
                    <br>
                    <div class="row">

                        <div class="col-sm-3">
                            <div class="form-group ">Tên chủ sở hữu
                                <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'name_seller', ['id'=>'data_name_seller','class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group ">Mã chủ sở hữu
                                <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'code_seller', ['id'=>'data_code_seller','class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group ">Địa chỉ chủ sở hữu
                                <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'address_seller', ['id'=>'data_address_seller','class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group ">Điện thoại chủ sở hữu
                                <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'mobile_seller', ['id'=>'data_mobile_seller','class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                            </div>
                        </div>
                    </div>
                    <br>
                    <h3>Thông tin người mua/thuê</h3>
                    <br>
                    <div class="row">

                        <div class="col-sm-3">
                            <div class="form-group ">Tên người mua
                                <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'name_buyer', ['id'=>'data_name_buyer','class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group ">Mã người mua
                                <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'code_buyer', ['id'=>'data_code_buyer','class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group ">Địa chỉ người mua
                                <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'address_buyer', ['id'=>'data_address_buyer','class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group ">Điện thoại người mua
                                <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'mobile_buyer', ['id'=>'data_mobile_buyer','class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                            </div>
                        </div>
                    </div>
                    <br>
                    <h3>Điều khoản</h3>
                    <br>

                    <div class="col-sm-3">
                        <?= $form->field($model, 'handover_dateline', [
                            'template' => '{label} <span class="input-icon icon-right">{input}{error}{hint}</span>',
                        ])->widget(
                            'trntv\yii\datetime\DateTimeWidget',
                            [
                                'phpDatetimeFormat' => 'dd/MM/yyyy',
                                'showInputAddon' => true,
                                'options' => [
                                    'class' => 'form-control input-sm',
                                    'id' =>'ivDateIn'
                                ],
                                'clientOptions' => [
                                    //'minDate' => new \yii\web\JsExpression('new Date("2017-01-01")'),
                                    'locale' => 'vi',
                                    'allowInputToggle' => true,
                                ]]
                        )->label('Ngày bàn giao') ?>

                    </div>

                    <div class="col-sm-3">
                        <div class="form-group ">Bảo hảnh
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'guarantee', ['id'=>'guarantee','class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <?= $form->field($model, 'renter_dateline', [
                            'template' => '{label} <span class="input-icon icon-right">{input}{error}{hint}</span>',
                        ])->widget(
                            'trntv\yii\datetime\DateTimeWidget',
                            [
                                'phpDatetimeFormat' => 'dd/MM/yyyy',
                                'showInputAddon' => true,
                                'options' => [
                                    'class' => 'form-control input-sm',
                                    'id' =>'ivDateIn'
                                ],
                                'clientOptions' => [
                                    //'minDate' => new \yii\web\JsExpression('new Date("2017-01-01")'),
                                    'locale' => 'vi',
                                    'allowInputToggle' => true,
                                ]]
                        )->label('Thời hạn thuê') ?>

                    </div>
                    <br>
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




<?php
$app_js = <<<JS

$('.select2-selection__clear').click(function(){
    alert('aaaaa');
});

$('#ticket').on('change',function() {
    var idTicket = $('#ticket').val();
    console.log(idTicket);
    $.ajax({
        url: '/contract/ticket/ajax-info',
        type: 'GET',
        data:{
            id:idTicket
        },
        success: function(result){
            //fill data
            if(result.hasTicket){
                $('#name_product').val(result.name_product);
                $('#code_product').val(result.code_product);
                $('#total_price_product').val(result.total_price);
                $('#data_name_seller').val(result.name_seller);
                $('#data_code_seller').val(result.code_seller);
                $('#data_address_seller').val(result.address_seller);
                $('#data_mobile_seller').val(result.mobile_seller);
                $('#data_name_buyer').val(result.name_buyer);
                $('#data_code_buyer').val(result.code_buyer);
                $('#data_address_buyer').val(result.address_buyer);
                $('#data_mobile_buyer').val(result.mobile_buyer);
                
                //add attribute readonly
                 $('#name_product').attr('readonly','readonly');
                 $('#code_product').attr('readonly','readonly');
                 $('#total_price_product').attr('readonly','readonly');
                 $('#data_name_seller').attr('readonly','readonly');
                 $('#data_code_seller').attr('readonly','readonly');
                 $('#data_address_seller').attr('readonly','readonly');
                 $('#data_mobile_seller').attr('readonly','readonly');
                 $('#data_name_buyer').attr('readonly','readonly');
                 $('#data_code_buyer').attr('readonly','readonly');
                 $('#data_address_buyer').attr('readonly','readonly');
                 $('#data_mobile_buyer').attr('readonly','readonly');
            } else {
                //reset data
                $('#name_product').val('');
                $('#code_product').val('');
                $('#total_price_product').val('');
                $('#data_name_seller').val('');
                $('#data_code_seller').val('');
                $('#data_address_seller').val('');
                $('#data_mobile_seller').val('');
                $('#data_name_buyer').val('');
                $('#data_code_buyer').val('');
                $('#data_address_buyer').val('');
                $('#data_mobile_buyer').val('');
                
                //remove attribute readonly
                $('#name_product').removeAttr("readonly");
                $('#code_product').removeAttr("readonly");
                $('#total_price_product').removeAttr("readonly");
                $('#data_name_seller').removeAttr("readonly");
                $('#data_code_seller').removeAttr("readonly");
                $('#data_address_seller').removeAttr("readonly");
                $('#data_mobile_seller').removeAttr("readonly");
                $('#data_name_buyer').removeAttr("readonly");
                $('#data_code_buyer').removeAttr("readonly");
                $('#data_address_buyer').removeAttr("readonly");
                $('#data_mobile_buyer').removeAttr("readonly");
            }
        }
    });
})
JS;
$this->registerJs($app_js);
?>