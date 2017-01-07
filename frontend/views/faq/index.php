<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\Cities;
use common\models\UploadedFiles;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TourSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'FAQ');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container title-bar">
  <div class="row">
    <div class="cities-banner">
      <?= Html::img('@web/statics/images/faq-bg' . ((Yii::$app->params['is_mobile'])?'':'-pc') . '.jpg', ['alt'=>'FAQ', 'width'=>"100%"]) ?>
      <div class="banner-text"><?=Yii::t('app','FAQ')?></div>
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
          <a href="<?= Url::toRoute(['faq/view', 'title'=>$item['title']]) ?>" class="list-group-item col-lg-12 col-md-12 col-xs-12">
              <i class="glyphicon glyphicon-chevron-right pull-right" /></i>
              <span><?= $item['title'] ?></span>
          </a>
          <?php } ?>
      </div>
      <div class="clearfix"></div> 
    </div>

    <div class="article-index">
      <div class="list-group">
          <div class="list-group-item"><center><h2><?= Yii::$app->params['faq_type'][FAQ_TYPE_IN_CHINA] ?></h2></center></div>
          <?php foreach ($faq as $item) { 
            if ($item['sub_type'] != FAQ_TYPE_IN_CHINA) {
              continue;
            }
          ?>
          <a href="<?= Url::toRoute(['faq/view', 'title'=>$item['title']]) ?>" class="list-group-item col-lg-12 col-md-12 col-xs-12">
              <i class="glyphicon glyphicon-chevron-right pull-right" /></i>
              <span><?= $item['title'] ?></span>
          </a>
          <?php } ?>
      </div>
    </div>
  </div>


  <?php if (!Yii::$app->params['is_mobile']) { ?>
    <?= $this->render('/layouts/_exp-right', [
        'tours' => $tours,
    ]) ?>
  <?php } ?>

</div>

<?php
$js = <<<JS

JS;
$this->registerJs($js);
?>