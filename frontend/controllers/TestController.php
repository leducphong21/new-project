<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:01 PM
 */

namespace frontend\controllers;

use Yii;
use common\models\Page;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TestController extends Controller
{
    public function actionIndex()
    {
        $a = Yii::$app->mailer->compose()
            ->setTo('dungpx.s@gmail.com')
            ->setSubject('Message subject')
            ->setTextBody('Plain text content')
            ->setHtmlBody('<b>HTML content</b>')
            ->send();
        echo $a;
        dd('ok');
    }
    public function actionDemo(){
        Yii::$app->mailer->compose('test',  ['myVar' => 'HALLO']) // a view rendering result becomes the message body here
        ->setFrom('from@domain.com')
            ->setTo('dungpx.s@gmail.com')
            ->setSubject('Message subject')

            ->send();
    }
}
