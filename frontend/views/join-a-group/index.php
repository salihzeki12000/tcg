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

$this->title = Yii::t('app', 'Themed Tours');
$this->description = Yii::t('app', 'Share the costs of your travel with others and meet new friends. Our most popular group tour is sleeping on the Great Wall.');
$this->keywords = Yii::t('app', 'Sleep on the wall, China group tours, great wall, China small group tours');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container title-bar">
  <div class="row">
    <div class="cities-banner">
      <?= Html::img('@web/statics/images/joinagroup-bg' . ((Yii::$app->params['is_mobile'])?'':'-pc') . '.jpg', ['alt'=>Yii::t('app', 'THEMED TOURS'), 'width'=>"100%"]) ?>
      <div class="banner-text"><?= Yii::t('app', 'Themed Tours') ?></div>
    </div>
  </div>
</div>

<div class="tour-index container">

  <p class="full-text col-lg-9 col-md-10"><?=Yii::t('app','Although we specialize in private tours, we realize that for some people, the cost of a group tour may be more approachable. That’s why we organize one-off themed tours to different destinations on fixed dates throughout the year that are designed with small groups in mind.')?></p>

  <p class="full-text col-lg-9 col-md-10"><?=Yii::t('app','Joining a group tour is a great way to share the costs of your travel with others and meet new friends with similar interests. Even though you’ll only be paying the price of a group tour, you’ll still enjoy the same, high-standard service as our private tours.')?></p>

  <?php foreach ($month_tours as $month => $tours) { ?>
   <h3 class="tours-month"><center><?= $month ?></center></h3>

    <div class=" file-drop-zone"> 
     <div class="file-preview-thumbnails">
      <div class="file-initial-thumbs row">

      <?php foreach ($tours as $tour) { ?>
       <div class="file-preview-frame file-preview-initial col-lg-4 col-md-4 col-sm-6 col-xs-12" >
        <a class="kv-file-content" href="<?= Url::toRoute(['join-a-group/view', 'url_id'=>$tour['url_id']]) ?>"> 
         <img src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($tour['pic_title'], 's')?>" alt="<?=  $tour['name'] ?>" class="kv-preview-data file-preview-image" /> 
        </a>
        <div class="file-thumbnail-footer"> 
         <div class="file-footer-caption">
            <div class="content-press"><span><?= ($tour['tour_length']==intval($tour['tour_length']))?intval($tour['tour_length']):$tour['tour_length'] ?></span> <?=($tour['tour_length']>1)?Yii::t('app','Days'):Yii::t('app','Day')?> | <span><?= $tour['cities_count'] ?></span> <?=($tour['cities_count']>1)?Yii::t('app','Destinations'):Yii::t('app','Destination')?> | <span><?= $tour['exp_num'] ?></span> <?=($tour['exp_num']>1)?Yii::t('app','Activities'):Yii::t('app','Activity')?></div>
            <h3><?= $tour['name'] ?> </h3>
            <div><?= date('F d, Y', strtotime($tour['begin_date'])) ?> - <?= date('F d, Y', strtotime($tour['end_date'])) ?></div>
            <div class="tourlist-price">
              <a type="button" class="btn btn-info pull-right btn-sm" href="<?= Url::toRoute(['join-a-group/view', 'url_id'=>$tour['url_id']]) ?>"><?=Yii::t('app','View')?></a>
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