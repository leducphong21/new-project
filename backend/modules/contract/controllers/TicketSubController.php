<?php

namespace backend\modules\contract\controllers;

use common\models\project\Buyer;
use common\models\project\Product;
use Yii;
use common\models\project\TicketSub;
use common\models\project\Seller;
use common\models\project\TicketSubSearch;
use common\models\project\TicketSearch;
use common\models\project\Ticket;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\response;

/**
 * TicketController implements the CRUD actions for Ticket model.
 */
class TicketSubController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Ticket models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TicketSubSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ticket model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelSeller = new Seller();
        $modelBuyer = new Buyer();

        if ($model->load(Yii::$app->request->post())) {
            if($model->save()){
                if ($model->status==2){
                    $modelProduct = Product::findOne($model->name_product);
                    $modelProduct->deleted=1;
                    $modelProduct->save();

                    Yii::$app->getSession()->setFlash('alert', [
                        'body'=>'Hủy thành công.',
                        'options'=>['class'=>'ialert alert-success']
                    ]);
                } else{
                    Yii::$app->getSession()->setFlash('alert', [
                        'body'=>'Cập nhật thành công.',
                        'options'=>['class'=>'ialert alert-success']
                    ]);
                }

            return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
            'model' => $model,
            'modelSeller' => $modelSeller,
            'modelBuyer' => $modelBuyer
        ]);
    }

    public function actionAjaxDelete()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (isAjax()) {
            $dataPost = $_POST;
            $dataId = isset($dataPost['ids']) ? $dataPost['ids'] : [];
            foreach ($dataId as $item) {
                /** @var Ticket $mode */
                $mode = Ticket::find()->where(['id' => $item])->one();
                if ($mode) {
                    $mode->status=2;
                    $mode->save();
                }
            }
            $res = [
                'body' => 'Sucess',
                'success' => true,
            ];
            return $res;
        }
        $res = [
            'body' => 'Not allow',
            'success' => false,
        ];
        return $res;
    }
    /**
     * Deletes an existing Ticket model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = 2;
        $model->save();

        $modelProduct = Product::findOne($model->name_product);
        $modelProduct->deleted = 1;
        $modelProduct->save();

        Yii::$app->getSession()->setFlash('alert', [
        'body' => 'Xóa dữ liệu thành công.',
        'options' => ['class' => 'ialert alert-success']
        ]);
        return $this->redirect(['index']);
    }

    /**
     * Finds the Ticket model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ticket the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ticket::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The Ticket item does not exist.');
        }
    }

    public function actionAjaxInfo()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $dataGet = $_GET;
        $dataId = isset($dataGet['id']) ? $dataGet['id'] : [];
        if (isset($dataId)){
            $ticket = [];
            if ($dataId && is_numeric($dataId)) {
                $ticket = Ticket::findOne($dataId);
                $name_product = Product::findOne($ticket->name_product)->name;
                $code_product = Product::findOne($ticket->name_product)->code;
                $total_price = Product::findOne($ticket->name_product)->total_price;
                $name_seller = Seller::findOne($ticket->name_seller)->name;
                $code_seller = Seller::findOne($ticket->name_seller)->code;
                $address_seller = $ticket->address_seller;
                $mobile_seller = $ticket->mobile_seller;
                $name_buyer = Buyer::findOne($ticket->name_buyer)->name;
                $code_buyer = Buyer::findOne($ticket->name_buyer)->code;
                $address_buyer = $ticket->address_buyer;
                $mobile_buyer = $ticket->mobile_buyer;
                $res = [
                    'hasTicket' => true,
                    'name_product' => $name_product,
                    'code_product' => $code_product,
                    'total_price' => $total_price,
                    'name_seller' => $name_seller,
                    'code_seller' => $code_seller,
                    'address_seller' => $address_seller,
                    'mobile_seller' => $mobile_seller,
                    'name_buyer' => $name_buyer,
                    'code_buyer' => $code_buyer,
                    'address_buyer' => $address_buyer,
                    'mobile_buyer' => $mobile_buyer,
                ];
                return $res;
            } else
                return ['hasTicket' => false];
        }

    }
}
