<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;


/* @var $this yii\web\View */
/* @var $dataCount */
$this->title = 'Bảng thông tin';
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="databox bg-white radius-bordered">
                <div class="databox-left bg-themesecondary">
                    <div class="databox-piechart">
                        <div data-toggle="easypiechart" class="easyPieChart" data-barcolor="#fff" data-linecap="butt" data-percent="50" data-animate="500" data-linewidth="3" data-size="47" data-trackcolor="rgba(255,255,255,0.1)" style="width: 47px; height: 47px; line-height: 47px;"><span class="white font-90">60</span><canvas width="47" height="47"></canvas></div>
                    </div>
                </div>
                <div class="databox-right">
                    <span class="databox-number themesecondary">Phiếu đặt cọc</span>
                    <div class="databox-text darkgray">Chưa thanh toán</div>
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
                        <div data-toggle="easypiechart" class="easyPieChart" data-barcolor="#fff" data-linecap="butt" data-percent="15" data-animate="500" data-linewidth="3" data-size="47" data-trackcolor="rgba(255,255,255,0.2)" style="width: 47px; height: 47px; line-height: 47px;"><span class="white font-90">30</span><canvas width="47" height="47"></canvas></div>
                    </div>
                </div>
                <div class="databox-right">
                    <span class="databox-number themethirdcolor">Phiếu đặt cọc</span>
                    <div class="databox-text darkgray">Đã thanh toán nhưng chưa lập hợp đồng</div>
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
                        <div id="users-pie" data-toggle="easypiechart" class="easyPieChart" data-barcolor="#fff" data-linecap="butt" data-percent="76" data-animate="500" data-linewidth="3" data-size="47" data-trackcolor="rgba(255,255,255,0.1)" style="width: 47px; height: 47px; line-height: 47px;"><span class="white font-90">10</span><canvas width="47" height="47"></canvas></div>
                    </div>
                </div>
                <div class="databox-right">
                    <span class="databox-number themeprimary">Số hợp đồng</span>
                    <div class="databox-text darkgray">Đã lập trong hôm nay</div>
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
                        <div id="users-pie" data-toggle="easypiechart" class="easyPieChart" data-barcolor="#fff" data-linecap="butt" data-percent="76" data-animate="500" data-linewidth="3" data-size="47" data-trackcolor="rgba(255,255,255,0.1)" style="width: 47px; height: 47px; line-height: 47px;"><span class="white font-90">20</span><canvas width="47" height="47"></canvas></div>
                    </div>
                </div>
                <div class="databox-right">
                    <span class="databox-number themeprimary">Hợp đồng cho thuê</span>
                    <div class="databox-text darkgray">Sắp hết thời hạn</div>
                    <div class="databox-state bg-themeprimary">
                        <i class="fa fa-check"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

