<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\UploadedFiles;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\city */

$this->title = $activity_info['name'];
$this->params['breadcrumbs'][] = ['label' => $city_info['name'], 'url'=>Url::toRoute(['destination/view', 'name'=>$city_info['name']])];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activities'), 'url'=>Url::toRoute(['destination/activities', 'name'=>$city_info['name']])];
$this->params['breadcrumbs'][] = $this->title;

$pic_type = 'l';
if (Yii::$app->params['is_mobile']) {
    $pic_type = 'mob';
}
?>

<div class="container title-bar">
  <div class="row">
    <div class="cities-banner">
      <?php for($i=0; $i<count($city_info['images']); $i++) {
          $slide=$city_info['images'][$i];
      ?>
        <div class="sight-title-img col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <?= Html::img(Yii::$app->params['uploads_url'] . UploadedFiles::getSize($slide['path'], $pic_type), ['alt'=>$slide['title'], 'width'=>"100%"]) ?>
        </div>
      <?php break; } ?>
      
      <div class="banner-text"><?= $city_info['name'] ?></div>
    </div>
  </div>
</div>

<div class="activity-view">

    <div class="container back-container">
        <center><h1><?= $activity_info['name'] ?></h1></center>
        <?= Html::img(Yii::$app->params['uploads_url'] . UploadedFiles::getSize($activity_info['pic_s'], $pic_type), ['alt'=>$activity_info['name'], 'width'=>"100%"]) ?>
        <div class="overview back-body">
          <?= $activity_info['overview'] ?>
        </div>
    </div>

</div>

<?php
$js = <<<JS

JS;
$this->registerJs($js);

$css = <<<CSS
  .breadcrumb{
    margin-bottom: 0px;
  }
CSS;
$this->registerCss($css); 
?>