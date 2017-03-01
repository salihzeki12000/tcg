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
$this->description = 'China travel destinations, China tourist cities, China tourist sights';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container title-bar">
  <div class="row">
    <div class="cities-banner">
      <?= Html::img('@web/statics/images/destinations-bg' . ((Yii::$app->params['is_mobile'])?'':'-pc') . '.jpg', ['alt'=>'Destinations', 'width'=>"100%"]) ?>
      <div class="banner-text"><?=Yii::t('app','DESTINATIONS')?></div>
    </div>
  </div>
</div>

<div class="cities-index container">
  <p><?=Yii::t('app','A lifetime would hardly be enough to explore everything that China has to offer. From historic architecture to mysterious culture, from futuristic cityscapes to boundless deserts and mist-shrouded karst landscapes, there is something to discover around every corner, no matter what kind of travel experience you are looking for.')?></p>

  <p><?=Yii::t('app','As a result, where you visit very much depends on what you are interested in and how long you can allow for your trip. The destinations below are just a taste of what we can offer. We can arrange tours in cities across the whole of China. If the city that you want to visit is missing from the list below, just let your travel agent know.')?></p>

  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header"><center><?=Yii::t('app','Popular Destinations')?></center></h1>
      </div>
      <?php foreach ($cities as $city) { 
        if (strpos($city['rec_type'], REC_TYPE_POPULAR.'') === false) {
          continue;
        }
      ?>
      <div class="col-lg-3 col-md-4 col-xs-6 thumb">
          <a class="thumbnail" href="<?= Url::toRoute(['destination/view', 'url_id'=>$city['url_id']]) ?>">
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
          <h1 class="page-header"><center><?=Yii::t('app','Other Destinations')?></center></h1>
      </div>
      <?php foreach ($cities as $city) { 
        if (strpos($city['rec_type'], REC_TYPE_OFF_THE_BEATEN_TRACK.'') === false) {
          continue;
        }
      ?>
      <div class="col-lg-3 col-md-4 col-xs-6 thumb">
          <a class="thumbnail" href="<?= Url::toRoute(['destination/view', 'url_id'=>$city['url_id']]) ?>">
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