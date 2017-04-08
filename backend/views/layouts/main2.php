<?php
/**
 * @var $this yii\web\View
 */
?>
<?php $this->beginContent('@backend/views/layouts/common.php'); ?>
<div class="tabbable">
   <div class="widget-body">
       <?php echo $content ?>
   </div>
</div>

<?php $this->endContent(); ?>