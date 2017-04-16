<?php

namespace backend\modules\category\controllers;

use Yii;
use common\models\project\ProductCategory;
use common\models\project\ProductCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * ProductCategoryController implements the CRUD actions for ProductCategory model.
 */
class ProductCategoryController extends Controller
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
     * Lists all ProductCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductCategory model.
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
     * Creates a new ProductCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductCategory();

        if ($model->load(Yii::$app->request->post())) {
            $model->created_at = Date('Y-m-d');
            if($model->save()){
            Yii::$app->getSession()->setFlash('alert', [
                'body'=>'Thêm mới thành công.',
                'options'=>['class'=>'ialert alert-success']
            ]);
            return $this->redirect(['index']);
           }
        }
        return $this->render('create', [
        'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProductCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

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
        ]);
    }

    /**
     * Deletes an existing ProductCategory model.
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


    public function actionAjaxDelete()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (isAjax()) {
            $dataPost = $_POST;
            $dataId = isset($dataPost['ids']) ? $dataPost['ids'] : [];
            foreach ($dataId as $item) {
                /** @var ProductCategory $mode */
                $mode = ProductCategory::find()->where(['id' => $item])->one();
                if ($mode) {
                    $mode->delete();
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
     * Finds the ProductCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The ProductCategory item does not exist.');
        }
    }
}
