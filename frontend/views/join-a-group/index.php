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

$this->title = Yii::t('app', '{0} & {1} China Guided Small Group Tour Packages', [date('Y'), date('Y', strtotime('+1 years'))]);
$this->description = Yii::t('app', 'China guided tour packages, best {0} & {1} small group tour itineraries to Beijing, Xi\'an, Shanghai, Zhangjiajie, Guilin, Yangshuo, Chengdu, Tibet, etc.', [date('Y'), date('Y', strtotime('+1 years'))]);
$this->keywords = Yii::t('app', 'China guided tours, China small group tour itineraries');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container title-bar">
  <div class="row">
    <div class="cities-banner">
      <?= Html::img('@web/statics/images/joinagroup-bg' . ((Yii::$app->params['is_mobile'])?'':'-pc') . '.jpg', ['alt'=>Yii::t('app', 'Small Group Tours'), 'width'=>"100%"]) ?>
      <h1 class="banner-text"><?= Yii::t('app', 'Small Group Tours') ?></h1>
    </div>
  </div>
</div>

<div class="tour-index container">

  <p class="full-text col-lg-9 col-md-10"><?=Yii::t('app','Join together with other like-minded travelers and discover China on one of regular small group tours. Whether you want to explore futuristic cityscapes, uncover the delicious secrets of Chinese cuisine or journey through stunning natural landscapes, our small group tours offer an insight into everything that this fascinating country has to offer.')?></p>

  <p class="full-text col-lg-9 col-md-10"><?=Yii::t('app','Although you\'ll be traveling in a group (with a minimum of 6 and a maximum of 12 people), you will still enjoy the same high standard of service as our private tours.')?></p>


    <div class=" file-drop-zone"> 
     <div class="file-preview-thumbnails">
      <div class="file-initial-thumbs row">

  <?php foreach ($month_tours as $month => $tours) { ?>
      <?php foreach ($tours as $tour) { ?>
       <div class="file-preview-frame file-preview-initial col-lg-4 col-md-4 col-sm-6 col-xs-12" >
               <a class="kv-file-content" href="<?= Url::toRoute(['join-a-group/view', 'url_id'=>$tour['url_id']]) ?>"> 
                                   <img src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($tour['pic_title'], 's')?>" alt="<?=  $tour['name'] ?>" class="kv-preview-data file-preview-image" />
                                   <h3 class="tour-name"><?php echo $tour['name']; ?></h3>
                </a>
                    
                <div class="file-thumbnail-footer"> 
                     <div class="file-footer-caption">
                        <div class="content-press">
                                <span><?= ($tour['tour_length']==intval($tour['tour_length']))?intval($tour['tour_length']):$tour['tour_length'] ?></span> <?=($tour['tour_length']>1)?Yii::t('app','days'):Yii::t('app','day')?><?php if(!empty($tour['price_cny'])): ?>
                                        &#9679; From <span><?= Yii::$app->params['currency_name'][Yii::$app->params['currency']]['sign'] ?><?= number_format(common\models\ExchangeUsd::convertCurrency(Yii::$app->params['currency'], $tour['price_cny']),0) ?></span> <?= Yii::$app->params['currency_name'][Yii::$app->params['currency']]['name'] ?><?php endif; ?><br /><span id="tour-list-cities"><?php echo Html::encode(\common\models\Tools::wordcut(strip_tags($tour['display_cities']), 40)); ?></span>
                                
                                <!-- <span><?= $tour['cities_count'] ?></span> <?=($tour['cities_count']>1)?Yii::t('app','destinations'):Yii::t('app','destination')?> &#9679; <span><?= $tour['exp_num'] ?></span> <?=($tour['exp_num']>1)?Yii::t('app','experiences'):Yii::t('app','experience')?> -->
                            </div>
                        
                        <div class="tourlist-desc">
                                <!-- <?= Html::encode(\common\models\Tools::wordcut(strip_tags($tour['overview']), 120)) ?>
                                <br /><br /> -->
                                <i class="glyphicon glyphicon-calendar"></i>
                                                <?= date('F d, Y', strtotime($tour['begin_date'])) ?> - 
                                                <?= date('F d, Y', strtotime($tour['end_date'])) ?><br>
                                                <?php if(!empty($tour['other_dates'])) {?>
                                                        <i class="glyphicon glyphicon-calendar"></i> <?=$tour['other_dates']?>
                                                <?php } ?></a>
                        </div>
                        
                        <div class="itinerary-view">
                                                <a href="<?= Url::toRoute(['join-a-group/view', 'url_id'=>$tour['url_id']]) ?>">
                                                        <span class="button">
                                                                <?=Yii::t('app','View trip')?>
                                                        </span>
                                                </a>
                                        </div>
                     </div> 
                </div> 
<!--
        <a class="kv-file-content" href="<?= Url::toRoute(['join-a-group/view', 'url_id'=>$tour['url_id']]) ?>"> 
         <img src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($tour['pic_title'], 's')?>" alt="<?=  $tour['name'] ?>" class="kv-preview-data file-preview-image" /> 
        </a>
        <div class="file-thumbnail-footer"> 
         <div class="file-footer-caption">
            <div class="content-press"><span><?= ($tour['tour_length']==intval($tour['tour_length']))?intval($tour['tour_length']):$tour['tour_length'] ?></span> <?=($tour['tour_length']>1)?Yii::t('app','Days'):Yii::t('app','Day')?> | <span><?= $tour['cities_count'] ?></span> <?=($tour['cities_count']>1)?Yii::t('app','Destinations'):Yii::t('app','Destination')?> | <span><?= $tour['exp_num'] ?></span> <?=($tour['exp_num']>1)?Yii::t('app','Experiences'):Yii::t('app','Experience')?></div>
            <h2><a href="<?= Url::toRoute(['join-a-group/view', 'url_id'=>$tour['url_id']]) ?>"><?= $tour['name'] ?></a></h2>
            <div class="tourlist-desc" style="min-height: 40px"><a href="<?= Url::toRoute(['join-a-group/view', 'url_id'=>$tour['url_id']]) ?>">
              <i class="glyphicon glyphicon-calendar"></i>
              <?= date('F d, Y', strtotime($tour['begin_date'])) ?> - 
              <?= date('F d, Y', strtotime($tour['end_date'])) ?><br>
              <?php if(!empty($tour['other_dates'])) {?>
                <i class="glyphicon glyphicon-calendar"></i> <?=$tour['other_dates']?>
              <?php } ?></a>
            </div>
            <div class="tourlist-price">
            </div>
         </div> 
        </div>
--> 
       </div>

      <?php } ?> 
  <?php } ?>
       
     </div> 
     <div class="clearfix"></div> 
    </div>

    </div>

</div>

<?php
$js = <<<JS
JS;
$this->registerJs($js);
?>