<?php

namespace backend\modules\manager\controllers;

use common\models\project\Buyer;
use common\models\project\Product;
use Yii;
use common\models\project\manager\Ticket;
use common\models\project\Seller;
use common\models\project\manager\TicketSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\response;

/**
 * TicketController implements the CRUD actions for Ticket model.
 */
class TicketController extends Controller
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
        $searchModel = new TicketSearch();
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

    /**
     * Creates a new Ticket model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     *///
    public function actionCreate()
    {
        $model = new Ticket();
        $modelSeller = new Seller();
        $modelBuyer = new Buyer();
        if ($model->load(Yii::$app->request->post())) {
            if($model->save()){
                $modelProduct = Product::findOne($model->name_product);
                $modelProduct->deleted = 0;
                $modelProduct->save();
            Yii::$app->getSession()->setFlash('alert', [
                'body'=>'Thêm mới thành công.',
                'options'=>['class'=>'ialert alert-success']
            ]);
            return $this->redirect(['index']);
           }
        }
        return $this->render('create', [
            'model' => $model,
            'modelSeller' => $modelSeller,
            'modelBuyer' => $modelBuyer,
        ]);
    }

    /**
     * Updates an existing Ticket model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
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
}
