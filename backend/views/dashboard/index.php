<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;


/* @var $this yii\web\View */
/* @var $dataCount */
$this->title = 'Dashboard';
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="databox bg-white radius-bordered">
                <div class="databox-left bg-themesecondary">
                    <div class="databox-piechart">
                        <div data-toggle="easypiechart" class="easyPieChart" data-barcolor="#fff" data-linecap="butt" data-percent="50" data-animate="500" data-linewidth="3" data-size="47" data-trackcolor="rgba(255,255,255,0.1)" style="width: 47px; height: 47px; line-height: 47px;"><span class="white font-90"><?=$dataCount['totalInvoice']?></span><canvas width="47" height="47"></canvas></div>
                    </div>
                </div>
                <div class="databox-right">
                    <span class="databox-number themesecondary">Báo giá</span>
                    <div class="databox-text darkgray">Đã được tạo trong hôm nay</div>
                    <div class="databox-stat themesecondary radius-bordered">
                        <i class="stat-icon  icon-lg fa fa-envelope-o"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="databox bg-white radius-bordered">
                <div class="databox-left bg-themethirdcolor">
                    <div class="databox-piechart">
                        <div data-toggle="easypiechart" class="easyPieChart" data-barcolor="#fff" data-linecap="butt" data-percent="15" data-animate="500" data-linewidth="3" data-size="47" data-trackcolor="rgba(255,255,255,0.2)" style="width: 47px; height: 47px; line-height: 47px;"><span class="white font-90"><?=$dataCount['totalCommand']?></span><canvas width="47" height="47"></canvas></div>
                    </div>
                </div>
                <div class="databox-right">
                    <span class="databox-number themethirdcolor">Lệnh sửa chữa</span>
                    <div class="databox-text darkgray">Đã được tạo trong hôm nay</div>
                    <div class="databox-stat themethirdcolor radius-bordered">
                        <i class="stat-icon  icon-lg fa fa-envelope-o"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="databox bg-white radius-bordered">
                <div class="databox-left bg-themeprimary">
                    <div class="databox-piechart">
                        <div id="users-pie" data-toggle="easypiechart" class="easyPieChart" data-barcolor="#fff" data-linecap="butt" data-percent="76" data-animate="500" data-linewidth="3" data-size="47" data-trackcolor="rgba(255,255,255,0.1)" style="width: 47px; height: 47px; line-height: 47px;"><span class="white font-90"><?=$dataCount['totalCustomerNewnvoice']?></span><canvas width="47" height="47"></canvas></div>
                    </div>
                </div>
                <div class="databox-right">
                    <span class="databox-number themeprimary">Khách hàng mới</span>
                    <div class="databox-text darkgray">Đã sửa chữa trong hôm nay</div>
                    <div class="databox-state bg-themeprimary">
                        <i class="fa fa-check"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="databox bg-white radius-bordered">
                <div class="databox-left label-palegreen">
                    <div class="databox-piechart">
                        <div id="users-pie" data-toggle="easypiechart" class="easyPieChart" data-barcolor="#fff" data-linecap="butt" data-percent="76" data-animate="500" data-linewidth="3" data-size="47" data-trackcolor="rgba(255,255,255,0.1)" style="width: 47px; height: 47px; line-height: 47px;"><span class="white font-90"><?=$dataCount['totalCustomerSchedule']?></span><canvas width="47" height="47"></canvas></div>
                    </div>
                </div>
                <div class="databox-right">
                    <span class="databox-number themeprimary">Khách đến hẹn</span>
                    <div class="databox-text darkgray">Trong hôm nay</div>
                    <div class="databox-state bg-themeprimary">
                        <i class="fa fa-check"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
    <div class="orders-container">
        <div class="orders-header">
            <h6><b>Báo giá gần nhất</b></h6>
        </div>
        <?=
        ListView::widget([
            'dataProvider' => $dataProviderInvoice,
            'options' => [
                'tag' => 'ul',
                'class' => 'orders-list',
                'id' => 'list-wrapper',
            ],
            'summary' => '',
            'itemView' => '_item_invoice',
        ]);
        ?>
        <div class="orders-footer">
            <a class="show-all" href="<?=Url::to(['/repair/invoice/index?sort=new'])?>"><i class="fa fa-angle-down"></i> Xem tất cả</a>
        </div>
    </div>
</div>
<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
    <div class="orders-container">
        <div class="orders-header">
            <h6><b>Lệnh sửa chữa gần nhất</b></h6>
        </div>
        <?=
        ListView::widget([
            'dataProvider' => $dataProviderCommand,
            'options' => [
                'tag' => 'ul',
                'class' => 'orders-list',
                'id' => 'list-command',
            ],
            'summary' => '',
            'itemView' => '_item_command',
        ]);
        ?>
        <div class="orders-footer">
            <a class="show-all" href="<?=Url::to(['/repair/repair-command/index?sort=new'])?>"><i class="fa fa-angle-down"></i> Xem tất cả</a>
        </div>
    </div>
</div>
