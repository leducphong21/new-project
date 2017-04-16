<?php

namespace backend\modules\main\controllers;

use Yii;
use common\models\project\Employee;
use common\models\project\Regency;
use common\models\project\Branch;
use common\models\project\Department;
use common\models\project\EmployeeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\response;

/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeeController extends Controller
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
     * Lists all Employee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmployeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Employee model.
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
     * Creates a new Employee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Employee();
        $maxId = Employee::find()->orderBy('id DESC')->one();
        $nextID = isset($maxId) ? $maxId->id : 0;
        $model->code = 'NV00' .($nextID + 1);

        $modelRegency = Regency::find()->all();
        $modelDepartment = Department::find()->all();
        $modelBranch = Branch::find()->all();

        if ($model->load(Yii::$app->request->post())) {
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
            'modelRegency' => ArrayHelper::map($modelRegency, 'id', 'name'),
            'modelDepartment' => ArrayHelper::map($modelDepartment, 'id', 'name'),
            'modelBranch' => ArrayHelper::map($modelBranch, 'id', 'name'),
        ]);
    }

    /**
     * Updates an existing Employee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelRegency = Regency::find()->all();
        $modelDepartment = Department::find()->all();
        $modelBranch = Branch::find()->all();

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
            'modelRegency' => ArrayHelper::map($modelRegency, 'id', 'name'),
            'modelDepartment' => ArrayHelper::map($modelDepartment, 'id', 'name'),
            'modelBranch' => ArrayHelper::map($modelBranch, 'id', 'name'),
        ]);
    }

    public function actionAjaxDelete()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (isAjax()) {
            $dataPost = $_POST;
            $dataId = isset($dataPost['ids']) ? $dataPost['ids'] : [];
            foreach ($dataId as $item) {
                /** @var Employee $mode */
                $mode = Employee::find()->where(['id' => $item])->one();
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
     * Deletes an existing Employee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->deleted = 0;
        $model->save();

        Yii::$app->getSession()->setFlash('alert', [
        'body' => 'Xóa dữ liệu thành công.',
        'options' => ['class' => 'ialert alert-success']
        ]);
        return $this->redirect(['index']);
    }

    /**
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employee::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The Employee item does not exist.');
        }
    }
}
