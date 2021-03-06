<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\UploadedFiles;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\city */

$this->title = $activity_info['name'] . ' - ' . $city_info['name'] . ' ' . Yii::t('app','Travel Guide');
$this->description = Html::encode(\common\models\Tools::limit_words(strip_tags($activity_info['overview']), 30)) . '...';
$this->keywords = Html::encode($activity_info['keywords']);
$this->params['breadcrumbs'][] = ['label' => $city_info['name'], 'url'=>Url::toRoute(['destination/view', 'url_id'=>$city_info['url_id']])];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activities'), 'url'=>Url::toRoute(['destination/activities', 'name'=>$city_info['name']])];
$this->params['breadcrumbs'][] = $this->title;

$pic_type = 'l';
if (Yii::$app->params['is_mobile']) {
    $pic_type = 'mob';
}
?>

<div class="title-bar">
  <div class="row">
    <div class="cities-banner">
      <?php for($i=0; $i<count($city_info['images']); $i++) {
          $slide=$city_info['images'][$i];
      ?>
        <?= Html::img(Yii::$app->params['uploads_url'] . UploadedFiles::getSize($slide['path'], $pic_type), ['alt'=>$slide['title'], 'width'=>"100%"]) ?>
      <?php break; } ?>
      
      <h1 class="banner-text"><span><?= $city_info['name'] ?> <?=Yii::t('app','Travel Guide')?></span></h1>
    </div>
  </div>
</div>

<div class="activity-view">

    <div class="container back-container">
        <center><h1><?= $activity_info['name'] ?></h1></center>
        <div class="overview full-text col-lg-9 col-md-10">
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