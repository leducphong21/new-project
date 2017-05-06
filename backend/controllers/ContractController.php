<?php

namespace backend\controllers;

use common\helpers\ArticleHelper;
use Yii;
use common\models\Article;
use backend\models\search\ArticleSearch;
use \common\models\ArticleCategory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ContractController extends Controller
{
    public $layout = 'main2';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post']
                ]
            ]
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = [
            'defaultOrder' => ['published_at' => SORT_DESC]
        ];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => ArticleCategory::find()->active()->all(),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $id = getParam('id', null);
        $model = new Article();
        //Copy data
        if ($id) {
            /** @var Article $eModel */
            $eModel = Article::find()->published()->where(['id' => $id])->one();
            if ($eModel) {
                $data = $eModel->attributes;
                $model->setAttributes($data);

                //Copy thumbnail
                if ($eModel->thumbnail) {
                    $model->thumbnail = $eModel->thumbnail;
                    $copyImage = "1/cp_" . Yii::$app->security->generateRandomString(20) . ".jpg";
                    $model->thumbnail['path'] = $copyImage;
                    $model->thumbnail_path = $copyImage;
                    fileSystem()->copy($eModel->thumbnail['path'], $copyImage);
                }

                //Copy attachments
                $model->attachments = $eModel->attachments;
                foreach ($eModel->articleAttachments as $key => $img) {
                    $new_filename = "1/cp_" . $key . "_" . date('YmdHim') . rand(1, 100000) . ".jpg";
                    fileSystem()->copy($eModel->attachments[$key]['path'], $new_filename);
                    $model->attachments[$key]['path'] = $new_filename;
                }
            } else {
                throw new NotFoundHttpException('Article does not exist.');
            }
        }
        // Init article id
        $model->aid = ArticleHelper::getRandomID();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            ArticleHelper::getDetail($model->id);
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'categories' => ArticleCategory::find()->active()->all(),
            ]);
        }
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            ArticleHelper::getDetail($model->id);
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'categories' => ArticleCategory::find()->active()->all(),
            ]);
        }
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->getSession()->setFlash('alert', [
            'body'=>'Xóa dữ liệu thành công.',
            'options'=>['class'=>'ialert alert-success']
        ]);
        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
