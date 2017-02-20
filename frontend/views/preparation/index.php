<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\Cities;
use common\models\UploadedFiles;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TourSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'China travel Preparations');
$this->description = Yii::t('app', 'China travel Preparations, China travel tips');
$this->params['breadcrumbs'][] = Yii::t('app', 'Preparation');
?>

<div class="container title-bar">
  <div class="row">
    <div class="cities-banner">
      <?= Html::img('@web/statics/images/title-bg' . ((Yii::$app->params['is_mobile'])?'':'-pc') . '.jpg', ['alt'=>'Preparation', 'width'=>"100%"]) ?>
      <div class="banner-text"><?=Yii::t('app','Preparation')?></div>
    </div>
  </div>
</div>

<div class="tour-view">
  <div class="container tour-left col-lg-8 col-md-12 col-sm-12 col-xs-12">
    <div class="article-index">

      <div class="list-group">
          <div class="list-group-item"><center><h2><?= Yii::$app->params['faq_type'][FAQ_TYPE_TRIP_PLANNING] ?></h2></center></div>
          <?php foreach ($faq as $item) { 
            if ($item['sub_type'] != FAQ_TYPE_TRIP_PLANNING) {
              continue;
            }
          ?>
          <a href="<?= Url::toRoute(['preparation/view', 'url_id'=>$item['url_id']]) ?>" class="list-group-item col-lg-12 col-md-12 col-xs-12">
              <i class="glyphicon glyphicon-chevron-right pull-right" ></i>
              <span><?= $item['title'] ?></span>
          </a>
          <?php } ?>
      </div>
    </div>

    <div class="article-index">
      <div class="list-group">
          <div class="list-group-item"><center><h2><?= Yii::$app->params['faq_type'][FAQ_TYPE_IN_CHINA] ?></h2></center></div>
          <?php foreach ($faq as $item) { 
            if ($item['sub_type'] != FAQ_TYPE_IN_CHINA) {
              continue;
            }
          ?>
          <a href="<?= Url::toRoute(['preparation/view', 'url_id'=>$item['url_id']]) ?>" class="list-group-item col-lg-12 col-md-12 col-xs-12">
              <i class="glyphicon glyphicon-chevron-right pull-right" ></i>
              <span><?= $item['title'] ?></span>
          </a>
          <?php } ?>
      </div>
    </div>

    <div class="article-index">
      <div class="list-group">
          <div class="list-group-item"><center><h2><?= Yii::$app->params['faq_type'][FAQ_TYPE_FAQ] ?></h2></center></div>
          <?php foreach ($faq as $item) { 
            if ($item['sub_type'] != FAQ_TYPE_FAQ) {
              continue;
            }
          ?>
          <a href="<?= Url::toRoute(['preparation/view', 'url_id'=>$item['url_id']]) ?>" class="list-group-item col-lg-12 col-md-12 col-xs-12">
              <i class="glyphicon glyphicon-chevron-right pull-right" ></i>
              <span><?= $item['title'] ?></span>
          </a>
          <?php } ?>
      </div>
    </div>
  </div>


    <?= $this->render('/layouts/_exp-right', []) ?>

</div>

<?php
$js = <<<JS

JS;
$this->registerJs($js);
?>