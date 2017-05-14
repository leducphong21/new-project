<?php
/**
 * @var $this yii\web\View
 */
use backend\assets_b\ProjectAsset;
use backend\widgets\Menu;
use common\models\TimelineEvent;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

$bundle = ProjectAsset::register($this);
?>
<?php $this->beginContent('@backend/views/layouts/base.php'); ?>

    <div class="navbar">
        <div class="navbar-inner">
            <div class="navbar-container">
                <div class="navbar-header pull-left">
                    <a href="<?=Url::to(['/'])?>" class="navbar-brand">
                        <small>
                            <img src="<?=$this->assetManager->getAssetUrl($bundle, 'img/logo.png')?>" />
                        </small>
                    </a>
                </div>

                <div class="sidebar-collapse" id="sidebar-collapse">
                    <i class="collapse-icon fa fa-bars"></i>
                </div>

                <div class="pull-left">
                    <form action="<?=Url::to(['/search/index'])?>">
                        <input type="text"
                               class="form-control"
                               style="margin-top: 5px; margin-left: 35px; width: 350px;"
                               placeholder="Tìm khách hàng"
                        />
                    </form>
                </div>

                <div class="navbar-header pull-right">
                    <div class="navbar-account">
                        <ul class="account-area">
                            <li>
                                <a class="wave in" id="chat-link" title="Chat" href="#">
                                    <i class="icon glyphicon glyphicon-comment"></i>
                                </a>
                            </li>
                            <li>
                                <a class="login-area dropdown-toggle" data-toggle="dropdown">
                                    <div class="avatar" title="View your public profile">
                                        <img src="<?php echo Yii::$app->user->identity->userProfile->getAvatar($this->assetManager->getAssetUrl($bundle, 'img/anonymous.png')) ?>">
                                    </div>
                                    <section>
                                        <h2><span class="profile"><span>Administrator</span></span></h2>
                                    </section>
                                </a>
                                <!--Login Area Dropdown-->
                                <ul class="pull-right dropdown-menu dropdown-arrow dropdown-login-area">
                                    <li class="username"><a>David Stevenson</a></li>
                                    <li class="email"><a>David.Stevenson@live.com</a></li>
                                    <!--Avatar Area-->
                                    <li>
                                        <div class="avatar-area">
                                            <img src="<?php echo Yii::$app->user->identity->userProfile->getAvatar($this->assetManager->getAssetUrl($bundle, 'img/anonymous.png')) ?>" class="avatar">
                                            <span class="caption">Change Photo</span>
                                        </div>
                                    </li>
                                    <!--Avatar Area-->
                                    <li class="edit">
                                        <a href="<?=Url::to(['/sign-in/profile'])?>" class="pull-left">Profile</a>
                                        <a href="<?=Url::to(['/sign-in/profile'])?>"" class="pull-right">Setting</a>
                                    </li>

                                    <!--/Theme Selector Area-->
                                    <li class="dropdown-footer">
                                        <?php echo Html::a(Yii::t('backend', 'Logout'), ['/sign-in/logout'], ['class'=>'', 'data-method' => 'post']) ?>
                                    </li>
                                </ul>
                                <!--/Login Area Dropdown-->
                            </li>
                            <!-- /Account Area -->
                            <!--Note: notice that setting div must start right after account area list.
                            no space must be between these elements-->
                            <!-- Settings -->
                        </ul><div class="setting">
                            <a id="btn-setting1" title="Setting" href="<?=Url::to(['/system/key-storage'])?>">
                                <i class="icon glyphicon glyphicon-cog"></i>
                            </a>

                        <!-- Settings -->
                    </div>
                </div>
                <!-- /Account Area and Settings -->
            </div>
        </div>
    </div>
    <!-- /Navbar -->
    <!-- Main Container -->
    <div class="main-container container-fluid">
        <!-- Page Container -->
        <div class="page-container">

            <!-- Page Sidebar -->
            <div class="page-sidebar" id="sidebar">

                <!-- sidebar menu: : style can be found in sidebar.less -->
                <?php echo Menu::widget([
                    'options'=>['class'=>'nav sidebar-menu'],
                    'linkTemplate' => '<a href="{url}">{icon}<span class="menu-text">{label}</span>{right-icon}{badge}</a>',
                    'submenuTemplate'=>"\n<ul class=\"submenu\">\n{items}\n</ul>\n",
                    'activateParents'=>true,
                    'items'=>[
                        [
                            'label'=> 'Bảng thông tin',
                            'icon'=>'<i class="menu-icon glyphicon glyphicon-home"></i>',
                            'url'=>['/'],
                        ],
                        [
                            'label'=> 'Hợp đồng',
                            'url' => '#',
                            'is_toggle' => 1,
                            'icon'=>'<i class="menu-icon fa fa-th"></i>',
                            //'options'=>['class'=>'open'],
                            'items'=>[
                                [
                                    'label'=> 'Phiếu đặt cọc',
                                    'url'=>['/deposit/create'],
                                ],
                                [
                                    'label'=> 'Lập hợp đồng',
                                    'url'=>['/contract/create'],
                                ],
                                [
                                    'label'=> 'Tổng hợp phiếu đặt cọc',
                                    'url'=>['/deposit/index'],
                                ],
                                [
                                    'label'=> 'Tổng hợp hợp đồng',
                                    'url'=>['/contract/index'],
                                ],
                            ]
                        ],
                        [
                            'label'=> 'Sản phẩm',
                            'url' => '#',
                            'is_toggle' => 1,
                            'icon'=>'<i class="menu-icon fa fa-th"></i>',
                            //'options'=>['class'=>'open'],
                            'items'=>[
                                [
                                    'label'=> 'Bán',
                                    'url'=>['/main/product-sale'],
                                ],
                                [
                                    'label'=> 'Cho thuê',
                                    'url'=>['/main/product-rent'],
                                ],
                                [
                                    'label'=> 'Môi giới',
                                    'url'=>['/main/product-medium'],
                                ],
                            ]
                        ],
                        [
                            'label'=> 'Dự án',
                            'url' => '#',
                            'is_toggle' => 1,
                            'icon'=>'<i class="menu-icon fa fa-th"></i>',
                            //'options'=>['class'=>'open'],
                            'items'=>[
                                [
                                    'label'=> 'Dự án',
                                    'url'=>['/main/project'],
                                ],
                                [
                                    'label'=> 'Lô đất',
                                    'url'=>['/main/portion'],
                                ],
                                [
                                    'label'=> 'Thửa đất',
                                    'url'=>['/main/land'],
                                ],
                            ]
                        ],
                        [
                            'label'=> 'Khách hàng',
                            'url' => '#',
                            'is_toggle' => 1,
                            'icon'=>'<i class="menu-icon fa fa-th"></i>',
                            //'options'=>['class'=>'open'],
                            'items'=>[
                                [
                                    'label'=> 'Người mua',
                                    'url'=>['/customer/buyer'],
                                ],
                                [
                                    'label'=> 'Người bán',
                                    'url'=>['/customer/seller'],
                                ],
                                [
                                    'label'=> 'Người thuê',
                                    'url'=>['/customer/renter'],
                                ],
                                [
                                    'label'=> 'Người liên hệ',
                                    'url'=>['/customer/contacter'],
                                ],
                            ]
                        ],
                        [
                            'label'=> 'Danh mục chung',
                            'url' => '#',
                            'is_toggle' => 1,
                            'icon'=>'<i class="menu-icon fa fa-th"></i>',
                            //'options'=>['class'=>'open'],
                            'items'=>[
                                [
                                    'label'=> 'Loại sản phẩm',
                                    'url'=>['/category/product-category'],
                                ],
                                [
                                    'label'=> 'Loại dự án',
                                    'url'=>['/category/project-category'],
                                ],
                                [
                                    'label'=> 'Loại hợp đồng',
                                    'url'=>['/category/contract-category'],
                                ],
                            ]
                        ],
                        [
                            'label'=> 'Phụ mục',
                            'url' => '#',
                            'is_toggle' => 1,
                            'icon'=>'<i class="menu-icon fa fa-th"></i>',
                            //'options'=>['class'=>'open'],
                            'items'=>[
                                [
                                    'label'=> 'Danh sách tỉnh/thành',
                                    'url'=>['/extra/city'],
                                ],
                                [
                                    'label'=> 'Danh sách quận/huyện',
                                    'url'=>['/extra/county'],
                                ],
                                [
                                    'label'=> 'Danh sách chi nhánh',
                                    'url'=>['/extra/branch'],
                                ],
                                [
                                    'label'=> 'Danh sách bộ phận',
                                    'url'=>['/extra/department'],
                                ],
                                [
                                    'label'=> 'Danh sách chức vụ',
                                    'url'=>['/extra/regency'],
                                ],
                            ]
                        ],
                        [
                            'label'=> 'Quản lý cấp cao',
                            'url' => '#',
                            'is_toggle' => 1,
                            'icon'=>'<i class="menu-icon fa fa-th"></i>',
                            'visible' => Yii::$app->user->can('administrator'),
                            //'options'=>['class'=>'open'],
                            'items'=>[
                                [
                                    'label'=> 'Sản phẩm',
                                    'url' => '#',
                                    'is_toggle' => 1,
                                    'items'=>[
                                        [
                                            'label'=> 'Sản phẩm bán',
                                            'url' => '/manager/product-sale',
                                        ],
                                        [
                                            'label'=> 'Sản phẩm cho thuê',
                                            'url' => '/manager/product-rent',
                                        ],
                                    ]
                                ],
                                [
                                    'label'=> 'Hợp đồng',
                                    'url' => '#',
                                    'is_toggle' => 1,
                                    'items'=>[
                                        [
                                            'label'=> 'Tổng hợp phiếu đặt cọc',
                                            'url' => '/deposit',
                                        ],
                                        [
                                            'label'=> 'Tổng hợp hợp đồng',
                                            'url' => '/contract',
                                        ],
                                    ]
                                ],
                                [
                                    'label'=> 'Thống kê',
                                    'url' => '#',
                                    'is_toggle' => 1,
                                    'items'=>[
                                        [
                                            'label'=> 'Thống kê 1',
                                            'url' => '#',
                                        ],
                                        [
                                            'label'=> 'Thống kê 2',
                                            'url' => '#',
                                        ],
                                        [
                                            'label'=> 'Thống kê ...',
                                            'url' => '#',
                                        ],
                                    ]
                                ],
                                [
                                    'label'=> 'Nhân viên',
                                    'icon'=>'<i class="menu-icon glyphicon glyphicon-user"></i>',
                                    'url'=>['/main/employee'],
                                ],
                                [
                                    'label'=> 'Quản lý tài khoản',
                                    'icon'=>'<i class="menu-icon glyphicon glyphicon-user"></i>',
                                    'url'=>['/user/index'],
                                ],
                            ]
                        ],


                    ]
                ]) ?>

                <!-- /Sidebar Menu -->
            </div>
            <!-- /Page Sidebar -->
            <!-- Chat Bar -->
            <div id="chatbar" class="page-chatbar">
                <div class="chatbar-contacts">
                    <div class="contacts-search">
                        <input type="text" class="searchinput" placeholder="Search Contacts" />
                        <i class="searchicon fa fa-search"></i>
                        <div class="searchhelper">Search Your Contacts and Chat History</div>
                    </div>
                    <ul class="contacts-list">
                        <li class="contact">
                            <div class="contact-avatar">
                                <img src="<?=$this->assetManager->getAssetUrl($bundle, 'img/avatars/divyia.jpg')?>" />
                            </div>
                            <div class="contact-info">
                                <div class="contact-name">Divyia Philips</div>
                                <div class="contact-status">
                                    <div class="online"></div>
                                    <div class="status">online</div>
                                </div>
                                <div class="last-chat-time">
                                    last week
                                </div>
                            </div>
                        </li>
                        <li class="contact">
                            <div class="contact-avatar">
                                <img src="<?=$this->assetManager->getAssetUrl($bundle, 'img/avatars/Nicolai-Larson.jpg')?>" />
                            </div>
                            <div class="contact-info">
                                <div class="contact-name">Adam Johnson</div>
                                <div class="contact-status">
                                    <div class="offline"></div>
                                    <div class="status">left 4 mins ago</div>
                                </div>
                                <div class="last-chat-time">
                                    today
                                </div>
                            </div>
                        </li>
                        <li class="contact">
                            <div class="contact-avatar">
                                <img src="<?=$this->assetManager->getAssetUrl($bundle, 'img/avatars/John-Smith.jpg')?>" />
                            </div>
                            <div class="contact-info">
                                <div class="contact-name">John Smith</div>
                                <div class="contact-status">
                                    <div class="online"></div>
                                    <div class="status">online</div>
                                </div>
                                <div class="last-chat-time">
                                    1:57 am
                                </div>
                            </div>
                        </li>
                        <li class="contact">
                            <div class="contact-avatar">
                                <img src="<?=$this->assetManager->getAssetUrl($bundle, 'img/avatars/Osvaldus-Valutis.jpg')?>" />
                            </div>
                            <div class="contact-info">
                                <div class="contact-name">Osvaldus Valutis</div>
                                <div class="contact-status">
                                    <div class="online"></div>
                                    <div class="status">online</div>
                                </div>
                                <div class="last-chat-time">
                                    today
                                </div>
                            </div>
                        </li>
                        <li class="contact">
                            <div class="contact-avatar">
                                <img src="<?=$this->assetManager->getAssetUrl($bundle, 'img/avatars/Javi-Jimenez.jpg')?>" />
                            </div>
                            <div class="contact-info">
                                <div class="contact-name">Javi Jimenez</div>
                                <div class="contact-status">
                                    <div class="online"></div>
                                    <div class="status">online</div>
                                </div>
                                <div class="last-chat-time">
                                    today
                                </div>
                            </div>
                        </li>
                        <li class="contact">
                            <div class="contact-avatar">
                                <img src="<?=$this->assetManager->getAssetUrl($bundle, 'img/avatars/Stephanie-Walter.jpg')?>" />
                            </div>
                            <div class="contact-info">
                                <div class="contact-name">Stephanie Walter</div>
                                <div class="contact-status">
                                    <div class="online"></div>
                                    <div class="status">online</div>
                                </div>
                                <div class="last-chat-time">
                                    yesterday
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="chatbar-messages" style="display: none;">
                    <div class="messages-contact">
                        <div class="contact-avatar">
                            <img src="<?=$this->assetManager->getAssetUrl($bundle, 'img/avatars/divyia.jpg')?>" />
                        </div>
                        <div class="contact-info">
                            <div class="contact-name">Divyia Philips</div>
                            <div class="contact-status">
                                <div class="online"></div>
                                <div class="status">online</div>
                            </div>
                            <div class="last-chat-time">
                                a moment ago
                            </div>
                            <div class="back">
                                <i class="fa fa-arrow-circle-left"></i>
                            </div>
                        </div>
                    </div>
                    <ul class="messages-list">
                        <li class="message">
                            <div class="message-info">
                                <div class="bullet"></div>
                                <div class="contact-name">Me</div>
                                <div class="message-time">10:14 AM, Today</div>
                            </div>
                            <div class="message-body">
                                Hi, Hope all is good. Are we meeting today?
                            </div>
                        </li>
                        <li class="message reply">
                            <div class="message-info">
                                <div class="bullet"></div>
                                <div class="contact-name">Divyia</div>
                                <div class="message-time">10:15 AM, Today</div>
                            </div>
                            <div class="message-body">
                                Hi, Hope all is good. Are we meeting today?
                            </div>
                        </li>
                        <li class="message">
                            <div class="message-info">
                                <div class="bullet"></div>
                                <div class="contact-name">Me</div>
                                <div class="message-time">10:14 AM, Today</div>
                            </div>
                            <div class="message-body">
                                Hi, Hope all is good. Are we meeting today?
                            </div>
                        </li>
                        <li class="message reply">
                            <div class="message-info">
                                <div class="bullet"></div>
                                <div class="contact-name">Divyia</div>
                                <div class="message-time">10:15 AM, Today</div>
                            </div>
                            <div class="message-body">
                                Hi, Hope all is good. Are we meeting today?
                            </div>
                        </li>
                        <li class="message">
                            <div class="message-info">
                                <div class="bullet"></div>
                                <div class="contact-name">Me</div>
                                <div class="message-time">10:14 AM, Today</div>
                            </div>
                            <div class="message-body">
                                Hi, Hope all is good. Are we meeting today?
                            </div>
                        </li>
                        <li class="message reply">
                            <div class="message-info">
                                <div class="bullet"></div>
                                <div class="contact-name">Divyia</div>
                                <div class="message-time">10:15 AM, Today</div>
                            </div>
                            <div class="message-body">
                                Hi, Hope all is good. Are we meeting today?
                            </div>
                        </li>
                    </ul>
                    <div class="send-message">
                        <span class="input-icon icon-right">
                            <textarea rows="4" class="form-control" placeholder="Type your message"></textarea>
                            <i class="fa fa-camera themeprimary"></i>
                        </span>
                    </div>
                </div>
            </div>
            <!-- /Chat Bar -->
            <!-- Page Content -->
            <div class="page-content">
                <!-- Page Breadcrumb -->
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="<?=Url::to(['/'])?>">Trang chủ</a>
                        </li>
                    </ul>

                    <div class=" pull-right">
                        <a class="btn btn-default" href="/deposit/create">
                            <i class="fa fa-plus withe"></i>Phiếu đặt cọc
                        </a>

                        <a class="btn btn-default" href="/contract/create">
                            <i class="fa fa-plus withe"></i>Lập hợp đồng
                        </a>

                    </div>
                </div>
                <!-- /Page Breadcrumb -->
                <!-- Page Header -->
                <div class="page-header position-relative">
                    <div class="header-title">
                        <h1>
                            <?= isset($this->context->heading)? $this->context->heading: $this->title ?>
                        </h1>
                    </div>
                    <!--Header Buttons-->
                    <div class="header-buttons">
                        <a class="sidebar-toggler" href="#">
                            <i class="fa fa-arrows-h"></i>
                        </a>
                        <a class="refresh" id="refresh-toggler" href="">
                            <i class="glyphicon glyphicon-refresh"></i>
                        </a>

                        <a class="fullscreen" id="fullscreen-toggler" href="#">
                            <i class="glyphicon glyphicon-fullscreen"></i>
                        </a>
                    </div>
                    <!--Header Buttons End-->
                </div>
                <!-- /Page Header -->
                <!-- Page Body -->
                <div class="page-body">
                    <div class="row">
                            <div class="tabbable">
                                <?php if (Yii::$app->session->hasFlash('alert')):?>
                                    <?php echo \yii\bootstrap\Alert::widget([
                                        'body'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
                                        'options'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
                                    ])?>
                                <?php endif; ?>
                            </div>
                    </div>
                    <div class="row">
                        <?php echo $content ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php $this->endContent(); ?>