<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\Cities;
use common\models\UploadedFiles;
use yii\widgets\LinkPager;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TourSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Destinations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
  <div class="row">
    <div class="cities-banner hidden-md hidden-lg hidden-sm">
      <?= Html::img('@web/statics/images/destinations-bg.jpg', ['alt'=>'Destinations', 'width'=>"100%"]) ?>
      <div class="banner-text">DESTINATIONS</div>
    </div>
    <div class="cities-banner hidden-xs">
      <h2 class="banner-text-d">DESTINATIONS</h2>
    </div>
  </div>
</div>

<div class="cities-index container">
  <span>Overview introduction about China.</span>

  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header"><center>Must Visit</center></h1>
      </div>
      <?php foreach ($cities as $city) { 
        if (strpos($city['rec_type'], REC_TYPE_MUST_VISIT.'') === false) {
          continue;
        }
      ?>
      <div class="col-lg-3 col-md-4 col-xs-6 thumb">
          <a class="thumbnail" href="<?= Url::toRoute(['destination/view', 'name'=>$city['name']]) ?>">
              <img class="img-responsive" src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($city['pic_s'], 's')?>" alt="<?=  $city['name'] ?>">
              <div class="carousel-caption">
                  <h3><?= $city['name'] ?></h3>
              </div>
          </a>
      </div>
      <?php } ?>
  </div>

  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header"><center>Popular Cities</center></h1>
      </div>
      <?php foreach ($cities as $city) { 
        if (strpos($city['rec_type'], REC_TYPE_POPULAR.'') === false) {
          continue;
        }
      ?>
      <div class="col-lg-3 col-md-4 col-xs-6 thumb">
          <a class="thumbnail" href="<?= Url::toRoute(['destination/view', 'name'=>$city['name']]) ?>">
              <img class="img-responsive" src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($city['pic_s'], 's')?>" alt="<?=  $city['name'] ?>">
              <div class="carousel-caption">
                  <h3><?= $city['name'] ?></h3>
              </div>
          </a>
      </div>
      <?php } ?>
  </div>

  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header"><center>Off-The-Beaten-Track</center></h1>
      </div>
      <?php foreach ($cities as $city) { 
        if (strpos($city['rec_type'], REC_TYPE_OFF_THE_BEATEN_TRACK.'') === false) {
          continue;
        }
      ?>
      <div class="col-lg-3 col-md-4 col-xs-6 thumb">
          <a class="thumbnail" href="<?= Url::toRoute(['destination/view', 'id'=>$city['id']]) ?>">
              <img class="img-responsive" src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($city['pic_s'], 's')?>" alt="<?=  $city['name'] ?>">
              <div class="carousel-caption">
                  <h3><?= $city['name'] ?></h3>
              </div>
          </a>
      </div>
      <?php } ?>
  </div>

</div>

<?php
$js = <<<JS
    
JS;
$this->registerJs($js);

$css = <<<CSS

CSS;
$this->registerCss($css); 
?>