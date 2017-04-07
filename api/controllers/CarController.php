<?php

namespace api\controllers;

use api\components\AccessTokenAuth;
use common\helpers\gara\CarHelper;
use common\models\gara\Car;
use common\models\gara\Customer;
use common\models\gara\data\CarCustomer;
use yii\filters\AccessControl;

class CarController extends ApiController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'index'  => ['get'],
                    'view'   => ['get'],
                    'create' => ['post'],
                    'update' => ['get', 'put', 'post'],
                    'delete' => ['post', 'delete'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $this->msg = 'Car Controller';
    }

    public function actionCreate()
    {
        $isOK = false;
        $msg = '';
        $dataCar = postParam('car');
        $dataOwner = postParam('owner');
        $dataContacter = postParam('contacter');
        //Car model
        $model = new Car();
        $model->attributes = $dataCar;

        //Owner Model
        $modelOwner = new Customer();
        $modelOwner->type = Customer::TYPE_CUSTOMER_CAROWNER;
        $modelOwner->attributes = $dataOwner;

        if ($modelOwner->validate()) {
            if ($modelOwner->name) {
                $model->owner_name = $modelOwner->name;
            }
        }

        //var_dump($model->validate());
       // dd($modelOwner->getErrors());

        $isValid = $modelOwner->validate() && $model->validate();
        if ($isValid) {
            if ($model->save()) {
                //Save car owner
                if ($modelOwner->save()) {
                    /** @var CarCustomer $carCustomerModel */
                    $carCustomerModel = new CarCustomer();
                    $carCustomerModel->car_id = $model->id;
                    $carCustomerModel->customer_id = $modelOwner->id;
                    $carCustomerModel->type = CarCustomer::TYPE_OWNER;
                    if ($carCustomerModel->validate()) {
                        $carCustomerModel->save();
                    }else{
                        \Yii::warning('Start Log: Model CarCustomer detail not update', 'ticket');
                        dd($carCustomerModel->getErrors());
                    }
                };
                //Save Car contacter
                if($dataContacter){
                    $modelContacter = new Customer();
                    $modelContacter->type = Customer::TYPE_CUSTOMER_CAROWNER;
                    $modelContacter->attributes = $dataContacter;
                    if ($modelContacter->validate()) {
                        $modelContacter->save();
                        //Add Car contacter
                        /** @var CarCustomer $carCustomerModel */
                        $carCModel = new CarCustomer();
                        $carCModel->car_id = $model->id;
                        $carCModel->customer_id = $modelContacter->id;
                        $carCModel->type = CarCustomer::TYPE_CONTACTER;
                        if ($carCModel->validate()) {
                            $carCModel->save();
                        } else {
                            \Yii::warning('Start Log: Model CarCustomer detail not update', 'car');
                            //dd($carCModel->getErrors());
                        }
                    }else{
                        \Yii::warning('Start Log: Model Customer detail not update', 'car');
                        //dd($modelContacter->getErrors());
                    }
                }

                $isOK = true;

            }
        } else {
            if($modelOwner->validate()){
                $model->validate();
                $carError = array_values($model->getFirstErrors());;
                $msg = 'Có lỗi xảy ra: ' . $carError[0];
            }else{
                $ownerError = array_values($modelOwner->getFirstErrors());;
                $msg = 'Lỗi thông tin chủ xe: ' . $ownerError[0];
            }

        }
        if ($isOK) {
            $this->msg = 'Thêm mới thông tin xe thành công.';
            $this->data = [
                'car_id' => $model->id
            ];
        } else {
            $this->msg = $msg;
            $this->code = 422;
        }

    }

    public function actionValidate(){
        $carData = postParam('car');
        $isOk = false;
        $msg = '';
        if($carData){
            $model = new Car();
            $model->attributes = $carData;
            $model->owner_name = 'ABC';
            if($model->validate()){
                $isOk = true;
            }else{
                $model->validate();
                $carError = array_values($model->getFirstErrors());;
                $msg =  $carError[0];
            }
        }
        if($isOk){
            $this->msg = 'Thông tin hợp lệ';
        }else{
            $this->msg = $msg;
            $this->code = 422;
        }
    }

    public function actionView()
    {
        $cid = getParam('id', null);
        if ($cid) {
            $data = CarHelper::getDetail($cid);
            $this->msg = 'Car Info';
            $this->data = $data;
        } else {
            $this->msg = 'Car Not Found';
            $this->code = 322;
        }

    }

    public function actionUser()
    {

        $this->msg = 'User login demo';
        $this->data = \Yii::$app->getUser()->getId();
    }
}
