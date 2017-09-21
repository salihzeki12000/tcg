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

$this->title = Yii::t('app', 'China Travel Destinations');
$this->description = 'China\'s popular & off-the-beaten-track travel destinations, including Great Wall of China, Beijing, Xi\'an, Shanghai, Yangshuo, Zhangjiajie, Tibet and more.';
$this->keywords = Yii::t('app','China destinations, China\'s tourist destinations, China\'s top tourist cities, China\'s top tourist sights, cities in China, China city guide, China travel guide, China guide');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container title-bar">
  <div class="row">
    <div class="cities-banner">
      <?= Html::img('@web/statics/images/destinations-bg' . ((Yii::$app->params['is_mobile'])?'':'-pc') . '.jpg', ['alt'=>'China Travel Destinations', 'width'=>"100%"]) ?>
      <h1 class="banner-text"><?=Yii::t('app','China Travel Destinations')?></h1>
    </div>
  </div>
</div>

<div class="cities-index container">
  <p class="full-text col-lg-9 col-md-10"><?=Yii::t('app','A lifetime would hardly be enough to explore everything that China has to offer, from historic architecture to captivating culture, from futuristic cityscapes to mist-shrouded karst landscapes, there is something to discover around every corner, no matter what kind of travel experience you are looking for.')?></p>

  <p class="full-text col-lg-9 col-md-10"><?=Yii::t('app','As a result, where you visit very much depends on what you are interested in and how long you can allow for your China trip. The destinations below are just a taste of what we can offer. We can arrange tours in cities across the whole of China. If the city that you want to visit is missing from the list below, just let your travel agent know.')?></p>

  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header"><center><?=Yii::t('app','Popular Travel Destinations')?></center></h1>
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
                  <span><?= $city['name'] ?></span>
              </div>
          </a>
      </div>
      <?php } ?>
  </div>

  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header"><center><?=Yii::t('app','Off the Beaten Track')?></center></h1>
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
                  <span><?= $city['name'] ?></span>
              </div>
          </a>
      </div>
      <?php } ?>
  </div>

  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header"><center><?=Yii::t('app','Other Travel Destinations')?></center></h1>
      </div>
      <?php foreach ($cities as $city) { 
        if (strpos($city['rec_type'], REC_TYPE_POPULAR.'') === false && strpos($city['rec_type'], REC_TYPE_OFF_THE_BEATEN_TRACK.'') === false) {
      ?>
        <div class="col-lg-2 col-md-2 col-xs-6 dest-other">
          <a href="<?= Url::toRoute(['destination/view', 'url_id'=>$city['url_id']]) ?>">
            <span><?= $city['name'] ?></span>
          </a>
        </div>
      <?php } }?>
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