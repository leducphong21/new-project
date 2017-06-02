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

$modelProduct = [];
if($model->product){
    $modelPortion = ProductHelper::getProduct($model->product->id);
}
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
                        <div class="form-group ">Số phiếu
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'code', ['class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group ">Loại phiếu
                            <span class="input-icon icon-right">
                             <?=Html::activeDropDownList($model, 'type',['0'=>'Chọn loại hình kinh doanh','1'=>'Bán','2'=>'Cho thuê','3'=>'Môi giới'],['id'=>'type','class'=>'form-control','style'=>'width:100%'])?>
                         </span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label>Tên sản phẩm</label>
                        <span class="input-icon icon-right">
                                    <?php
                                    echo DepDrop::widget([
                                        'type'=>DepDrop::TYPE_SELECT2,
                                        'model' => $model,
                                        'attribute' => 'name_product',
                                        'options'=> [
                                            'id'=>'name_product',
                                            'class' => 'form-control input-sm'
                                        ],
                                        'data'=> $modelProduct,
                                        'pluginOptions'=>[
                                            'depends'=>['type'],
                                            'placeholder'=> 'Chọn sản phẩm...',
                                            'url'=>Url::to(['/main/product-sale/list'])
                                        ],
                                    ]);
                                    ?>
                                </span>
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
                    <div class="col-sm-3">
                        <div class="form-group ">Giá trị đặt cọc
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'ticket_price', ['id'=>'ticket_price_product','class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group ">Tình trạng kinh doanh
                            <span class="input-icon icon-right">
                             <?=Html::activeDropDownList($model, 'status',['0'=>'Đã đặt cọc','1'=>'Đã thành toán','2'=>'Hủy'],['id'=>'status','class'=>'form-control','style'=>'width:100%'])?>
                         </span>
                        </div>
                    </div>
                </div>
                <br>
                <h3>Thông tin chủ sở hữu</h3>
                <br>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Chủ sở hữu</label>
                            <span class="input-icon icon-right">
                                        <?php
                                        $urlCarJson = Url::to(['/customer/seller/json-list']);
                                        // Get the initial city description
                                        $carDesc = empty($modelSeller->name) ? '' : Seller::findOne($modelSeller->name);
                                        if($modelSeller->name){
                                            $carDesc = $modelSeller->name;
                                        }

                                        echo Select2::widget([
                                            'model' => $model,
                                            'attribute' => 'name_seller',
                                            //'name' => 'car_id',
                                            //'data' => $carsNo,
                                            //'value' => $model->car_id,
                                            'initValueText' => $carDesc,
                                            'theme' => Select2::THEME_BOOTSTRAP,
                                            'options' => [
                                                'placeholder' => 'Chọn chủ sở hữu ...',
                                                'class' => 'form-control input-sm',
                                                'id' => 'select_seller'
                                            ],
                                            'size' => Select2::SMALL,
                                            'addon' => [
                                                'append' => [
                                                    'content' => '<i id="btnAddNewCar"  class="fa fa-plus blue imouse"  data-toggle="modal" data-target="#Seller" title="Thêm mới chủ sở hữu"></i>',
                                                    'asButton' => false
                                                ]
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
                                                'ajax' => [
                                                    'url' => $urlCarJson,
                                                    'dataType' => 'json',
                                                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
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
                        <div class="form-group">
                            <label>Tên người mua</label>
                            <span class="input-icon icon-right">
                                        <?php
                                        $urlCarJson = Url::to(['/customer/buyer/json-list']);
                                        // Get the initial city description
                                        $carDesc = empty($modelBuyer->name) ? '' : Buyer::findOne($modelBuyer->name);
                                        if($modelBuyer->name){
                                            $carDesc = $modelBuyer->name;
                                        }

                                        echo Select2::widget([
                                            'model' => $model,
                                            'attribute' => 'name_buyer',
                                            //'name' => 'car_id',
                                            //'data' => $carsNo,
                                            //'value' => $model->car_id,
                                            'initValueText' => $carDesc,
                                            'theme' => Select2::THEME_BOOTSTRAP,
                                            'options' => [
                                                'placeholder' => 'Chọn chủ sở hữu ...',
                                                'class' => 'form-control input-sm',
                                                'id' => 'select_buyer'
                                            ],
                                            'size' => Select2::SMALL,
                                            'addon' => [
                                                'append' => [
                                                    'content' => '<i id="btnAddNewCar"  class="fa fa-plus blue imouse"  data-toggle="modal" data-target="#Buyer" title="Thêm mới chủ sở hữu"></i>',
                                                    'asButton' => false
                                                ]
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
                                                'ajax' => [
                                                    'url' => $urlCarJson,
                                                    'dataType' => 'json',
                                                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
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

    <div id="Seller" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 70%">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Thông tin chủ sở hữu</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4">
                            Tên chủ sở hữu<br>
                            <input id="name_seller" />
                        </div>
                        <div class="col-sm-4">
                            Giới tính<br>
                            <select id="gender_seller">
                                <option>Chọn giới tính...</option>
                                <option value="1">Nam</option>
                                <option value="2">Nữ</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            Ngày sinh<br>
                            <input type="date" id="birthday_seller"/>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-4">
                            Địa chỉ<br>
                            <input id="address_seller" />
                        </div>
                        <div class="col-sm-4">
                            Điện thoại<br>
                            <input id="mobile_seller" />
                        </div>
                        <div class="col-sm-4">
                            Thư điện tử<br>
                            <input id="email_seller" />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-4">
                            Nghề nghiệp<br>
                            <input id="job_seller" />
                        </div>
                        <div class="col-lg-4">
                            Mã số thuế<br>
                            <input id="tax_code_seller" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="save_seller" class="btn btn-success" data-dismiss="modal">Lưu lại</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                </div>
            </div>

        </div>

    </div>

    <div id="Buyer" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 70%">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Thông tin người mua/thuê</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4">
                            Tên chủ sở hữu<br>
                            <input id="name_buyer" />
                        </div>
                        <div class="col-sm-4">
                            Giới tính<br>
                            <select id="gender_buyer">
                                <option>Chọn giới tính...</option>
                                <option value="1">Nam</option>
                                <option value="2">Nữ</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            Ngày sinh<br>
                            <input type="date" id="birthday_buyer"/>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-4">
                            Địa chỉ<br>
                            <input id="address_buyer" />
                        </div>
                        <div class="col-sm-4">
                            Điện thoại<br>
                            <input id="mobile_buyer" />
                        </div>
                        <div class="col-sm-4">
                            Thư điện tử<br>
                            <input id="email_buyer" />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-4">
                            Nghề nghiệp<br>
                            <input id="job_buyer" />
                        </div>
                        <div class="col-lg-4">
                            Mã số thuế<br>
                            <input id="tax_code_buyer" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="save_buyer" class="btn btn-success" data-dismiss="modal">Lưu lại</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                </div>
            </div>

        </div>

    </div>

<?php
$app_js = <<<JS

    $('#name_product').on('change',function() {
    var idProduct = $('#name_product').val();
    console.log(idProduct);
    $.ajax({
        url: '/main/product-sale/ajax-info',
        type: 'GET',
        data:{
            id:idProduct
        },
        success: function(result){
            $('#code_product').val(result.code);
            $('#total_price_product').val(result.total_price);
            
            $('#ticket_price_product').val(result.total_price/10);
        }
    });
    

})

//Selller
$('#save_seller').click(function(){
                   $.ajax({
                      url: '/customer/seller/ajax-save',
                      data: {
                         name:$('#name_seller').val(),
                         gender:$('#gender_seller').val(),
                         birthday:$('#birtday_seller').val(),
                         address:$('#address_seller').val(),
                         mobile:$('#mobile_seller').val(),
                         email:$('#email_seller').val(),
                         job:$('#job_seller').val(),
                         tax_code:$('#tax_code_seller').val()
                      },
                      error: function() {
                         alert('Có lỗi xảy ra');
                      },
                      success: function() {
                         alert('Thanh cong');
                         $('#name_seller').val('');
                         $('#gender_seller').val('');
                         $('#birtday_seller').val('');
                         $('#address_seller').val('');
                         $('#mobile_seller').val('');
                         $('#email_seller').val('');
                         $('#job_seller').val('');
                         $('#tax_code_seller').val('')
                      },
                      type: 'POST'
                   });
});

$('#select_seller').on('change',function() {
    var idSeller = $('#select_seller').val();
    console.log(idSeller);
    $.ajax({
        url: '/customer/seller/ajax-info',
        type: 'GET',
        data:{
            id:idSeller
        },
        success: function(result){
            $('#data_address_seller').val(result.address);
            $('#data_mobile_seller').val(result.phone_number);
            $('#data_code_seller').val(result.code);
        }
    });
    

})


$('#save_buyer').click(function(){
                   $.ajax({
                      url: '/customer/buyer/ajax-save',
                      data: {
                         name:$('#name_buyer').val(),
                         gender:$('#gender_buyer').val(),
                         birthday:$('#birtday_buyer').val(),
                         address:$('#address_buyer').val(),
                         mobile:$('#mobile_buyer').val(),
                         email:$('#email_buyer').val(),
                         job:$('#job_buyer').val(),
                         tax_code:$('#tax_code_buyer').val()
                      },
                      error: function() {
                         alert('Có lỗi xảy ra');
                      },
                      success: function() {
                         alert('Thanh cong');
                         $('#name_buyer').val('');
                         $('#gender_buyer').val('');
                         $('#birtday_buyer').val('');
                         $('#address_buyer').val('');
                         $('#mobile_buyer').val('');
                         $('#email_buyer').val('');
                         $('#job_buyer').val('');
                         $('#tax_code_buyer').val('')
                      },
                      type: 'POST'
                   });
});

$('#select_buyer').on('change',function() {
    var idSeller = $('#select_buyer').val();
    console.log(idSeller);
    $.ajax({
        url: '/customer/seller/ajax-info',
        type: 'GET',
        data:{
            id:idSeller
        },
        success: function(result){
            $('#data_address_buyer').val(result.address);
            $('#data_mobile_buyer').val(result.phone_number);
            $('#data_code_buyer').val(result.code);
        }
    });
    

})
JS;
$this->registerJs($app_js);
?>