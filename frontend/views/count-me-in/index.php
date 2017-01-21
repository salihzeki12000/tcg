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

$this->title = Yii::t('app', 'China Experiences') . ', ' . Yii::t('app', 'Count Me In');
$this->description = Yii::t('app', 'China experiences, China tours, private China tours, customized China tours');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container title-bar">
  <div class="row">
    <div class="cities-banner">
      <?= Html::img('@web/statics/images/experiences-bg' . ((Yii::$app->params['is_mobile'])?'':'-pc') . '.jpg', ['alt'=>Yii::t('app', 'Count Me In'), 'width'=>"100%"]) ?>
      <div class="banner-text"><?= Yii::t('app', 'Count Me In') ?></div>
    </div>
  </div>
</div>

<div class="tour-index container">

  <div><?=Yii::t('app','Join with others on a fixed date, travel with new friends! You will find more fun! In addition, you only need to pay a group tour price but enjoy the service of private group.')?></div>
  <div style="margin-top: 20px;"><?=Yii::t('app','Here are our availble group tours(Please note that tours will be updated as time goes by):')?></div>

  <?php foreach ($month_tours as $month => $tours) { ?>
   <h3 class="tours-month"><center><?= $month ?></center></h3>

    <div class=" file-drop-zone"> 
     <div class="file-preview-thumbnails">
      <div class="file-initial-thumbs row">

      <?php foreach ($tours as $tour) { ?>
       <div class="file-preview-frame file-preview-initial col-lg-4 col-md-4 col-sm-6 col-xs-12" >
        <a class="kv-file-content" href="<?= Url::toRoute(['count-me-in/view', 'name'=>$tour['name']]) ?>"> 
         <img src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($tour['pic_title'], 's')?>" alt="<?=  $tour['name'] ?>" class="kv-preview-data file-preview-image" /> 
          <div class="content-press"><span><?= ($tour['tour_length']==intval($tour['tour_length']))?intval($tour['tour_length']):$tour['tour_length'] ?></span> <?=Yii::t('app','Days')?> | <span><?= $tour['cities_count'] ?></span> <?=Yii::t('app','Cities')?> | <span><?= $tour['exp_num'] ?></span> <?=Yii::t('app','Experiences')?></div>
        </a>
        <div class="file-thumbnail-footer"> 
         <div class="file-footer-caption">
            <h3><?= $tour['name'] ?> </h3>
            <div><?= date('F d, Y', strtotime($tour['begin_date'])) ?> - <?= date('F d, Y', strtotime($tour['end_date'])) ?></div>
            <div class="tourlist-price">
              <a type="button" class="btn btn-info pull-right btn-sm" href="<?= Url::toRoute(['count-me-in/view', 'name'=>$tour['name']]) ?>"><?=Yii::t('app','Learn more')?></a>
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