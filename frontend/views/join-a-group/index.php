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

$this->title = Yii::t('app', 'China Experiences') . ', ' . Yii::t('app', 'Join A Group');
$this->description = Yii::t('app', 'A group tour is a great way to share the costs of your travel with others and meet new friends with similar interests. Even though you’ll only be paying the price of a group tour, you’ll still enjoy the same, high-standard service as our private tours.');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container title-bar">
  <div class="row">
    <div class="cities-banner">
      <?= Html::img('@web/statics/images/joinagroup-bg' . ((Yii::$app->params['is_mobile'])?'':'-pc') . '.jpg', ['alt'=>Yii::t('app', 'Join A Group'), 'width'=>"100%"]) ?>
      <div class="banner-text"><?= Yii::t('app', 'Join A Group') ?></div>
    </div>
  </div>
</div>

<div class="tour-index container">

  <p><?=Yii::t('app','Although we specialize in private tours, we realize that for some people, the cost of a group tour may be more approachable. That’s why we organize one-off group tours to different destinations on fixed dates throughout the year.')?></p>

  <p><?=Yii::t('app','A group tour is a great way to share the costs of your travel with others and meet new friends with similar interests. Even though you’ll only be paying the price of a group tour, you’ll still enjoy the same, high-standard service as our private tours. ')?></p>

  <p><?=Yii::t('app','This page is frequently updated with new tour dates, so be sure to check back regularly. ')?></p>

  <?php foreach ($month_tours as $month => $tours) { ?>
   <h3 class="tours-month"><center><?= $month ?></center></h3>

    <div class=" file-drop-zone"> 
     <div class="file-preview-thumbnails">
      <div class="file-initial-thumbs row">

      <?php foreach ($tours as $tour) { ?>
       <div class="file-preview-frame file-preview-initial col-lg-4 col-md-4 col-sm-6 col-xs-12" >
        <a class="kv-file-content" href="<?= Url::toRoute(['join-a-group/view', 'name'=>$tour['name']]) ?>"> 
         <img src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($tour['pic_title'], 's')?>" alt="<?=  $tour['name'] ?>" class="kv-preview-data file-preview-image" /> 
          <div class="content-press"><span><?= ($tour['tour_length']==intval($tour['tour_length']))?intval($tour['tour_length']):$tour['tour_length'] ?></span> <?=Yii::t('app','Days')?> | <span><?= $tour['cities_count'] ?></span> <?=Yii::t('app','Cities')?> | <span><?= $tour['exp_num'] ?></span> <?=Yii::t('app','Experiences')?></div>
        </a>
        <div class="file-thumbnail-footer"> 
         <div class="file-footer-caption">
            <h3><?= $tour['name'] ?> </h3>
            <div><?= date('F d, Y', strtotime($tour['begin_date'])) ?> - <?= date('F d, Y', strtotime($tour['end_date'])) ?></div>
            <div class="tourlist-price">
              <a type="button" class="btn btn-info pull-right btn-sm" href="<?= Url::toRoute(['join-a-group/view', 'name'=>$tour['name']]) ?>"><?=Yii::t('app','View')?></a>
            </div>
         </div> 
        </div> 
       </div>

      <?php } ?> 
       
     </div> 
     <div class="clearfix"></div> 
    </div>

    </div>

  <?php } ?>
</div>

<?php
$js = <<<JS
JS;
$this->registerJs($js);
?>