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

<div class="container">
  <div class="row">
    <div class="cities-banner hidden-md hidden-lg">
      <?= Html::img('@web/statics/images/faq-bg.jpg', ['alt'=>'FAQ', 'width'=>"100%"]) ?>
      <div class="banner-text">FAQ</div>
    </div>
    <div class="cities-banner hidden-xs hidden-sm">
      <h2 class="banner-text-d">FAQ</h2>
    </div>
  </div>
</div>

<div class="article-index container">

    <div class="list-group">
        <div class="list-group-item"><center><h2><?= Yii::$app->params['faq_type'][FAQ_TYPE_TRIP_PLANNING] ?></h2></center></div>
        <?php foreach ($faq as $item) { 
          if ($item['sub_type'] != FAQ_TYPE_TRIP_PLANNING) {
            continue;
          }
        ?>
        <a href="<?= Url::toRoute(['faq/view', 'title'=>$item['title']]) ?>" class="list-group-item col-lg-6 col-md-6 col-xs-12">
            <i class="glyphicon glyphicon-chevron-right pull-right" /></i>
            <span><?= $item['title'] ?></span>
        </a>
        <?php } ?>
    </div>
</div>

<div class="article-index container">
    <div class="list-group">
        <div class="list-group-item"><center><h2><?= Yii::$app->params['faq_type'][FAQ_TYPE_IN_CHINA] ?></h2></center></div>
        <?php foreach ($faq as $item) { 
          if ($item['sub_type'] != FAQ_TYPE_IN_CHINA) {
            continue;
          }
        ?>
        <a href="<?= Url::toRoute(['faq/view', 'title'=>$item['title']]) ?>" class="list-group-item col-lg-6 col-md-6 col-xs-12">
            <i class="glyphicon glyphicon-chevron-right pull-right" /></i>
            <span><?= $item['title'] ?></span>
        </a>
        <?php } ?>
    </div>

</div>


<?php
$js = <<<JS

JS;
$this->registerJs($js);
?>