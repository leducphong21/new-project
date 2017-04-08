<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = 'Hello Page';
?>
<div class="test">
    <h1>Test Page 1</h1>
</div><!-- /.error-page -->
    <div class="checkbox">
        <label>
            <input type="checkbox"> Check me out
        </label>
    </div>
<?php

$app_js = <<<JS
console.log('Hello');

JS;
$this->registerJs($app_js);