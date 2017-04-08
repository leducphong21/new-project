<?php
namespace common\helpers\gara;

use common\helpers\DataHelper;
use common\models\gara\Car;
use common\models\gara\CarCarry;
use common\models\gara\CarModel;
use common\models\gara\Customer;
use yii\helpers\ArrayHelper;
use Yii;
use yii\helpers\Inflector;

class CarHelper extends Inflector
{
    public static function getDetail($id, $update = false){
        $cacheKey = CACHE_CAR_ITEM . $id;
        $data = dataCache()->get($cacheKey);

        $update = true;

        if ($data === false or $update) {
            $data = [];
            /** @var Car $model */
            $model = Car::find()->where(['id' => $id])->one();
            if ($model) {
                $dataC = [];
                $dataCarOwner = [];
                $dataC = [
                    'id' => $model->id,
                    'no' => $model->no,
                    'carry' => $model->carCarry ? $model->carCarry->name : '',
                    'carry_id' => $model->carCarry ? $model->carCarry->id : '',
                    'carry_name' => $model->carCarry ? $model->carCarry->name : '',
                    'model_id' => $model->carModel ? $model->carModel->id : '',
                    'model_name' => $model->carModel ? $model->carModel->name : '',
                    'type' => $model->carModel ? $model->carModel->name : '',
                    'model' => $model->model,
                    'number' => $model->number,
                    'machine' => $model->machine,
                    'color' => $model->color,
                ];
                $carOwner = Customer::find()
                    ->leftJoin('d_car_customer', '`m_customer`.`id` = `d_car_customer`.`customer_id`')
                    ->where(['d_car_customer.car_id' => $id])->andWhere(['d_car_customer.type' => 1])
                    ->asArray()
                    ->one();
                if ($carOwner) {
                    $dataCarOwner = $carOwner;
                }
                $data['car'] = $dataC;
                $data['owner'] = $dataCarOwner;
            }

            /*Set cache*/
            dataCache()->set($cacheKey, $data, 300);
        }
        return $data;
    }

    public static function getCarCarry(){
        $dataCarry = CarCarry::find()->all();
        return ArrayHelper::map($dataCarry, 'id', 'name');
    }
    /*
     * Random Car Carry ID
     * */
    public static function getRandomCarCarryID()
    {
        $code = DataHelper::getRandomNumber();
        $model = (new \yii\db\Query())
            ->from('m_car_carry')
            ->where('code ='.$code)
            ->one();
        if (!$model) {
            return $code;
        }
        return CarHelper::getRandomCarCarryID();
    }
    /*
     * Random Car Model ID
     * */
    public static function getRandomCarModelID()
    {
        $code = DataHelper::getRandomNumber();
        $model = (new \yii\db\Query())
            ->from('m_car_model')
            ->where('code='.$code)
            ->one();
        if (!$model) {
            return $code;
        }
        return CarHelper::getRandomCarCarryID();
    }

    public static function getCarModel($car_carry_id)
    {
        $dataModel = CarModel::find()
            ->where(['car_carry_id' => $car_carry_id])
            ->orderBy('id DESC')
            ->asArray()->all();
        $data = ArrayHelper::map($dataModel, 'id', 'name');
        return $data;
    }
    


}