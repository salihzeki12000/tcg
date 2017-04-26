<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\UploadedFiles;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\city */

$this->title = $sight_info['name'] . ' - ' . $city_info['name'] . ' ' . Yii::t('app','Travel Guide');
$this->description = Html::encode(\common\models\Tools::limit_words(strip_tags($sight_info['overview']), 30)) . '...';
$this->keywords = Html::encode($sight_info['keywords']);
$this->params['breadcrumbs'][] = ['label' => $city_info['name'], 'url'=>Url::toRoute(['destination/view', 'url_id'=>$city_info['url_id']])];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sights'), 'url'=>Url::toRoute(['destination/sights', 'url_id'=>$city_info['url_id']])];
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
        <?= Html::img(Yii::$app->params['uploads_url'] . UploadedFiles::getSize($slide['path'], $pic_type), ['alt'=>$slide['title'], 'width'=>"100%"]) ?>
      <?php break; } ?>
      
      <div class="banner-text"><?= $city_info['name'] ?></div>
    </div>
  </div>
</div>

<div class="sight-view">

    <div class="container back-container">
        <center><h1><?= $sight_info['name'] ?></h1></center>
        <div class="overview full-text col-lg-9 col-md-10">
          <?= $sight_info['overview'] ?>
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