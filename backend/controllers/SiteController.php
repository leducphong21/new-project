<?php

namespace backend\controllers;

use common\components\keyStorage\FormModel;
use common\helpers\DataHelper;
use common\helpers\gara\CarHelper;
use common\helpers\gara\ProductHelper;
use common\models\gara\repair\TicketCustomer;
use common\models\gara\stock\BillDetail;
use common\models\User;
use common\task\DownloadTask;
use Intervention\Image\Exception\NotFoundException;
use Yii;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * Site controller
 */
class SiteController extends AdminController
{
    public $layout = 'main2';

    public function actionIndex(){
        $output = shell_exec('mysql -V');
        preg_match('@[0-9]+\.[0-9]+\.[0-9]+@', $output, $version);
        if($version){
            if (strpos($version[0], '5.7') !== false) {
               return true;
            }
        }
        return false;
    }
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function beforeAction($action)
    {
        $this->layout = Yii::$app->user->isGuest || !Yii::$app->user->can('loginToBackend') ? 'base' : 'common';
        return parent::beforeAction($action);
    }

    public function actionSettings()
    {
        $this->layout = 'main2';
        $model = new FormModel([
            'keys' => [
                'frontend.maintenance' => [
                    'label' => Yii::t('backend', 'Frontend maintenance mode'),
                    'type' => FormModel::TYPE_DROPDOWN,
                    'items' => [
                        'disabled' => Yii::t('backend', 'Disabled'),
                        'enabled' => Yii::t('backend', 'Enabled')
                    ]
                ],
                'backend.theme-skin' => [
                    'label' => Yii::t('backend', 'Backend theme'),
                    'type' => FormModel::TYPE_DROPDOWN,
                    'items' => [
                        'skin-black' => 'skin-black',
                        'skin-blue' => 'skin-blue',
                        'skin-green' => 'skin-green',
                        'skin-purple' => 'skin-purple',
                        'skin-red' => 'skin-red',
                        'skin-yellow' => 'skin-yellow'
                    ]
                ],
                'backend.layout-fixed' => [
                    'label' => Yii::t('backend', 'Fixed backend layout'),
                    'type' => FormModel::TYPE_CHECKBOX
                ],
                'backend.layout-boxed' => [
                    'label' => Yii::t('backend', 'Boxed backend layout'),
                    'type' => FormModel::TYPE_CHECKBOX
                ],
                'backend.layout-collapsed-sidebar' => [
                    'label' => Yii::t('backend', 'Backend sidebar collapsed'),
                    'type' => FormModel::TYPE_CHECKBOX
                ]
            ]
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'body' => Yii::t('backend', 'Settings was successfully saved'),
                'options' => ['class' => 'alert ialert alert-success']
            ]);
            return $this->refresh();
        }

        return $this->render('settings', ['model' => $model]);
    }

    public function actionYearSetting()
    {
        $this->layout = 'main2';
        $model = new FormModel([
            'keys' => [
                'gara.year' => [
                    'label' => 'Năm tài chính',
                    'type' => FormModel::TYPE_TEXTINPUT,
                ],
            ]
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'body' => 'Lưu thông tin thành công',
                'options' => ['class' => 'alert ialert alert-success']
            ]);
            return $this->refresh();
        }

        return $this->render('year-setting', ['model' => $model]);
    }

    public function actionTest()
    {
        $a = \common\models\gara\repair\TicketCustomer::updateAll(['customer_id' => 1], ['ticket_id' => 9, 'type' => 1]);
        dd($a);

        Yii::warning('Start Log: ', 'gara');
        dd(Yii::$app->request->getUserIP());
        dd(Yii::$app->keyStorage->get('pageSize', 5));
        return $this->render('test');
    }

    public function actionLogout()
    {

        return $this->render('logout');
    }

    public function actionGetIP()
    {
        $a = \Yii::$app->getRequest()->getUserIP();
        dd($a);
    }

    public function actionUrl()
    {
        $url = \Yii::$app->urlManagerApi->createAbsoluteUrl('/site/index');
        dd($url);

    }

    public function actionData()
    {
        $car = CarHelper::getDetail(1);
        dd($car);

    }

    public function actionDate()
    {
        $date = '25/05/2010';
        $date = str_replace('/', '-', $date);
        echo date('d-m-y', strtotime($date));
        die;
        $car = Yii::$app->formatter->asDatetime('17/03/2017'); // 2014-10-06

        dd($car);

    }

    public function actionMoney()
    {
        $money = '10000';
        $total = Yii::$app->formatter->asDecimal('1231212.121');
        dd($total);
    }

    public function actionRepo()
    {
        $repoBillInfo = BillDetail::find()
            ->select('ANY_VALUE(id) AS id, repo_id, ANY_VALUE(repo_name) as repo_name')//Mysql 5.7
            //->select(['id', 'repo_id', 'repo_name'])
            ->where(['product_id' => 1, 'status' => STATUS_ACTIVE])
            ->groupBy(['repo_id', 'repo_name'])
            ->asArray()
            ->all();


        $data = ProductHelper::getHasProduct(1);
        dd($data);

        $model = BillDetail::find()
            ->select(['repo_id', 'repo_name'])
            ->where(['product_id' => 2])
            ->groupBy('repo_id')
            ->asArray()
            ->all();
        $repoId = ArrayHelper::getColumn($model, 'repo_id');

        dd($repoId);
        dd($model);
    }

    public function actionProduct()
    {
        $sumQuery = 'sum(case when type = 1 then count  when type = 2 then -count END) total';
        $dataBill = BillDetail::find()
            //->select('ANY_VALUE(id) AS id, repo_id, ANY_VALUE(repo_name) as repo_name') //Mysql 5.7
            ->select(['id', 'repo_id', 'repo_name', 'product_id', $sumQuery])
            ->where(['status' => STATUS_ACTIVE, 'repo_id' => 3])
            //->andWhere(['total' => 0])
            ->groupBy(['product_id', 'repo_id'])
         ->asArray()
         ->all();
        $a = ArrayHelper::getColumn($dataBill, 'product_id');
        dd($a);

    }

}
