<?php

namespace api\controllers;

use api\components\AccessTokenAuth;
use common\models\gara\Customer;
use yii\filters\AccessControl;

class CustomerController extends ApiController
{

    public function actionIndex()
    {
        $this->msg = 'Customer Controller';
    }

    public function actionCreate()
    {
        $postData = postParam('cus');
        $cid = 0;
        $isOK = false;
        $msg = '';
        $model = new Customer();
        if ($postData) {

            $model->attributes = $postData;
            //$model->type = Customer::TYPE_CUSTOMER;
            if ($model->validate()) {
                $model->save();
                $cid = $model->id;
                $isOK = true;
            } else {
                //$model->validate();
                $cusError = array_values($model->getFirstErrors());;
                //$msg = 'Có lỗi xảy ra: ' . $cusError[0];
                $msg = $cusError[0];
                //dd($model->getErrors());
            }
        }
        if ($isOK) {
            $this->msg = 'Lưu thông tin thành công.';
            $res = [
                'body' => 'Save Sucess',
                'isOk' => $isOK,
                'cid' => $cid,
                'success' => true,
            ];
            $this->data = $res;
        } else {

            $this->msg = $msg;
            $this->code = 422;
        }

    }

    public function actionUser()
    {

        $this->msg = 'User login demo';
        $this->data = \Yii::$app->getUser()->getId();
    }
}
