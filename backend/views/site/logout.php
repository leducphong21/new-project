<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = 'Hello Page';
?>
<a href="<?=\yii\helpers\Url::to(['/sign-in/logout'])?>" data-method ="Post">Logout</a>