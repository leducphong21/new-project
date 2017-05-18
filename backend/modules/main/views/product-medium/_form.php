<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\helpers\Url;
use common\models\project\Seller;
use kartik\depdrop\DepDrop;
use common\helpers\project\ProjectHelper;
use common\helpers\project\CityHelper;

$modelPortion = [];
if($model->project){
    $modelPortion = ProjectHelper::getPortion($model->project->id);
}

$modelLand = [];
if($model->portion){
    $modelLand = ProjectHelper::getLand($model->portion->id);
}

$modelCounty = [];
if($model->county){
    $modelCounty = CityHelper::getCounty($model->county->id);
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

                <h1>Thông tin sản phẩm</h1>
                <br>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group ">Tên sản phẩm
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'name', ['class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <span class="input-icon icon-right">
                         <label>Loại sản phẩm 1</label>
                            <?php
                            echo Select2::widget([
                                'model' => $model,
                                'attribute' => 'product_category_id',
                                'data' => $modelProductCategory,
                                'theme' => Select2::THEME_BOOTSTRAP,
                                'options' => [
                                    'class' => 'form-control input-sm',
                                    'placeholder' => 'Chọn loại sản phẩm'
                                ],
                                'size' => Select2::SMALL,
                                'pluginOptions' => [
                                    'tags' => false,
                                    'tokenSeparators' => [',', ' '],
                                    'maximumInputLength' => 20
                                ],
                            ]);
                            ?>
                    </span>
                    </div>



                    <div class="col-sm-3">
                         <span class="input-icon icon-right">
                         <label>Chọn tỉnh thành</label>
                             <?php
                             echo Select2::widget([
                                 'model' => $model,
                                 'attribute' => 'city_id',
                                 'data' => $modelCity,
                                 'theme' => Select2::THEME_BOOTSTRAP,
                                 'options' => [
                                     'class' => 'form-control input-sm',
                                     'placeholder' => 'Chọn tỉnh thành',
                                     'id'=>'city_id'
                                 ],
                                 'size' => Select2::SMALL,
                                 'pluginOptions' => [
                                     'tags' => false,
                                     'tokenSeparators' => [',', ' '],
                                     'maximumInputLength' => 20
                                 ],
                             ]);
                             ?>
                    </span>
                    </div>

                    <div class="col-sm-3">
                        <label>Quận huyện</label>
                        <span class="input-icon icon-right">
                                    <?php
                                    echo DepDrop::widget([
                                        'type'=>DepDrop::TYPE_SELECT2,
                                        'model' => $model,
                                        'attribute' => 'county_id',
                                        'options'=> [
                                            'id'=>'county_id',
                                            'class' => 'form-control input-sm'
                                        ],
                                        'data'=> $modelCounty,
                                        'pluginOptions'=>[
                                            'depends'=>['city_id'],
                                            'placeholder'=> 'Chọn quận huyện ...',
                                            'url'=>Url::to(['/extra/county/list'])
                                        ],
                                    ]);
                                    ?>
                                </span>
                    </div>

                </div>
                <br>
                <div class="row">

                    <div class="col-sm-3">
                        <div class="form-group ">Giá mết vuông
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'price', ['class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group ">Diện tích
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'acreage', ['class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group ">Lãi mỗi giới
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'interest', ['class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                        </div>
                    </div>

                </div>
                <br>


                <h1>Thông tin chủ sở hữu</h1>
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
                                                    'content' => '<i id="btnAddNewCar"  class="fa fa-plus blue imouse"  data-toggle="modal" data-target="#myModal" title="Thêm mới chủ sở hữu"></i>',
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
                        <div class="form-group ">Địa chỉ
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'address_seller', ['class' => 'form-control', 'id' =>"data_address", 'style' =>'width: 100%;'])?>
                         </span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group ">Điện thoại
                         <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'mobile_seller', ['class' => 'form-control', 'id' =>"data_mobile", 'style' =>'width: 100%;'])?>
                         </span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group ">Email
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'email_seller', ['class' => 'form-control', 'id' =>"data_email", 'style' =>'width: 100%;'])?>
                         </span>
                        </div>
                    </div>
                </div>
                <br>
                <h1>Mô tả chi tiết sản phẩm</h1>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group ">Địa chỉ
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'address', ['class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group ">Số tầng
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'floors', ['class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group ">Tổng số phòng
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'rooms', ['class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group ">Số phòng ngủ
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'bedrooms', ['class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group ">Số phòng về sinh
                            <span class="input-icon icon-right">
                             <?=Html::activeTextInput($model, 'bathrooms', ['class' => 'form-control', 'style' =>'width: 100%;'])?>
                         </span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group ">Hình ảnh
                            <span class="input-icon icon-right">
                             <?= $form->field($modelImage, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
                         </span>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group ">Mô tả
                            <span class="input-icon icon-right">
                             <?=Html::activeTextarea($model, 'description', ['class' => 'form-control', 'style' =>'width: 500px; height: 200px;'])?>
                         </span>
                        </div>
                    </div>
                </div>
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

<div id="myModal" class="modal fade" role="dialog">
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
                        <input id="name" />
                    </div>
                    <div class="col-sm-4">
                        Giới tính<br>
                        <select id="gender">
                            <option>Chọn giới tính...</option>
                            <option value="1">Nam</option>
                            <option value="2">Nữ</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        Ngày sinh<br>
                        <input type="date" id="birthday"/>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-4">
                        Địa chỉ<br>
                        <input id="address" />
                    </div>
                    <div class="col-sm-4">
                        Điện thoại<br>
                        <input id="mobile" />
                    </div>
                    <div class="col-sm-4">
                        Thư điện tử<br>
                        <input id="email" />
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-4">
                        Nghề nghiệp<br>
                        <input id="job" />
                    </div>
                    <div class="col-lg-4">
                        Mã số thuế<br>
                        <input id="tax_code" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="save" class="btn btn-success" data-dismiss="modal">Lưu lại</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
            </div>
        </div>

    </div>

</div>

<?php
$app_js = <<<JS

$('#save').click(function(){
    var name = $('#name').val();
    var gender = $('#gender').val();
    var birthday = $('#birtday').val();
    var address = $('#address').val();
    var mobile = $('#mobile').val();
    var email = $('#email').val();
    var job = $('#job').val();
    var tax_code = $('#tax_code').val();
    var dataSeller = new Array(name,gender,birthday,address,mobile,email,job,tax_code);
    console.log(dataSeller);
                   $.ajax({
                      url: '/customer/seller/ajax-save',
                      data: {
                         name:name,
                         gender:gender,
                         birthday:birthday,
                         address:address,
                         mobile:mobile,
                         email:email,
                         job:job,
                         tax_code:tax_code
                      },
                      error: function() {
                         alert('Có lỗi xảy ra');
                      },
                      success: function() {
                         alert('Thanh cong');
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
            $('#data_address').val(result.address);
            $('#data_mobile').val(result.phone_number);
            $('#data_email').val(result.email);
        }
    });
    

})
JS;
$this->registerJs($app_js);

?>