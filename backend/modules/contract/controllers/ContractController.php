<?php

namespace backend\modules\contract\controllers;

use Yii;
use common\models\project\Contract;
use common\models\project\ContractSearch;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\project\Ticket;
use yii\helpers\ArrayHelper;

/**
 * ContractController implements the CRUD actions for Contract model.
 */
class ContractController extends Controller
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
     * Lists all Contract models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContractSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contract model.
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
     * Creates a new Contract model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Contract();
        $query = new Query();
        $query->from('m_ticket')->where(['status'=>1]);
        $modelTicket = $query->createCommand()->queryAll();
        if ($model->load(Yii::$app->request->post())) {
            $model->handover_dateline = date('Y-m-d', strtotime(str_replace('/', '-', $model->handover_dateline)));
            $model->renter_dateline = date('Y-m-d', strtotime(str_replace('/', '-', $model->renter_dateline)));

            $ticket = Ticket::findOne($model->ticket_id);
            if($model->save()){
                if(isset($ticket->status)){
                    $ticket->status = 2;
                    $ticket->save();
                }

                Yii::$app->getSession()->setFlash('alert', [
                    'body'=>'Thêm mới thành công.',
                    'options'=>['class'=>'ialert alert-success']
                ]);
                return $this->redirect(['index']);
           }
        }
        return $this->render('create', [
            'model' => $model,
            'modelTicket' => ArrayHelper::map($modelTicket,'id','code')
        ]);
    }

    /**
     * Updates an existing Contract model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $query = new Query();
        $query->from('m_ticket')->where(['status'=>1]);
        $modelTicket = $query->createCommand()->queryAll();

        if ($model->load(Yii::$app->request->post())) {
            if($model->save()){
            Yii::$app->getSession()->setFlash('alert', [
                'body'=>'Cập nhật thành công.',
                'options'=>['class'=>'ialert alert-success']
            ]);
            return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
            'model' => $model,
            'modelTicket' => ArrayHelper::map($modelTicket,'id','code')
        ]);
    }


    public function actionAjaxDelete()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (isAjax()) {
            $dataPost = $_POST;
            $dataId = isset($dataPost['ids']) ? $dataPost['ids'] : [];
            foreach ($dataId as $item) {
                /** @var Contract $mode */
                $mode = Contract::find()->where(['id' => $item])->one();
                if ($mode) {
                    $mode->deleted=0;
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
     * Deletes an existing Contract model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->getSession()->setFlash('alert', [
        'body' => 'Xóa dữ liệu thành công.',
        'options' => ['class' => 'ialert alert-success']
        ]);
        return $this->redirect(['index']);
    }

    /**
     * Finds the Contract model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contract the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contract::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The Contract item does not exist.');
        }
    }
}
