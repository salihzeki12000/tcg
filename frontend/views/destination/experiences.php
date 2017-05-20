<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\UploadedFiles;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $model common\models\city */

$this->title = $city_info['name'] . ' ' . Yii::t('app','Tours') . ' - ' . $city_info['name'] . ' ' . Yii::t('app','Travel Guide');
$this->description = $city_info['name'] . ' ' . Yii::t('app', 'Tours') . ' & ' Yii::t('app', 'Experiences');
$this->keywords = $this->description;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Destinations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url'=>Url::toRoute(['destination/view', 'url_id'=>$city_info['url_id']])];
$this->params['breadcrumbs'][] = Yii::t('app','Experiences');
?>

<?= $this->render('_des-header', [
    'city_info' => $city_info,
    'menu' => $menu,
]) ?>

<div class="tour-index container">

    <div class=" file-drop-zone"> 
     <div class="file-preview-thumbnails">
      <div class="file-initial-thumbs row">

      <?php foreach ($tours as $tour) { ?>

       <div class="file-preview-frame file-preview-initial col-lg-4 col-md-4 col-sm-6 col-xs-12" >
        <a class="kv-file-content" href="<?= Url::toRoute(['experience/view', 'url_id'=>$tour['url_id']]) ?>"> 
         <img src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($tour['pic_title'], 's')?>" alt="<?=  $tour['name'] ?>" class="kv-preview-data file-preview-image" /> 
        </a>
        <div class="file-thumbnail-footer"> 
         <div class="file-footer-caption">
            <div class="content-press"><span><?= ($tour['tour_length']==intval($tour['tour_length']))?intval($tour['tour_length']):$tour['tour_length'] ?></span> <?=($tour['tour_length']>1)?Yii::t('app','Days'):Yii::t('app','Day')?> | <span><?= $tour['cities_count'] ?></span> <?=($tour['cities_count']>1)?Yii::t('app','Destinations'):Yii::t('app','Destination')?> | <span><?= $tour['exp_num'] ?></span> <?=($tour['exp_num']>1)?Yii::t('app','Activities'):Yii::t('app','Activity')?></div>
            <h3><a href="<?= Url::toRoute(['experience/view', 'url_id'=>$tour['url_id']]) ?>"><?= $tour['name'] ?></a></h3>
            <div class="tourlist-desc"><a href="<?= Url::toRoute(['experience/view', 'url_id'=>$tour['url_id']]) ?>"><?= Html::encode(\common\models\Tools::wordcut(strip_tags($tour['overview']), 120)) ?></a></div>
            <div class="tourlist-price">
              <?php if(!empty($tour['price_cny'])) { ?>
                From <span><?= Yii::$app->params['currency_name'][Yii::$app->params['currency']]['sign'] ?><?= number_format(common\models\ExchangeUsd::convertCurrency(Yii::$app->params['currency'], $tour['price_cny']),0) ?></span> <?= Yii::$app->params['currency_name'][Yii::$app->params['currency']]['name'] ?>
              <? }else{ ?>
                    <span>&nbsp;<span>
              <?php } ?>
            </div>
         </div> 
        </div> 
       </div>

      <?php } ?> 
       
     </div> 
     <div class="clearfix"></div> 
    </div>

    </div>
</div>

<div class="form-info container">
  <h2><?=Yii::t('app',"Can't find what you're looking for? Contact us today to customize your tour.")?></h2>
  <div class="form-info-create col-lg-8 col-md-8 col-xs-12">
    <span class="placeholder" id="inquiry-form"></span>
    <div class="form-title"><?=Yii::t('app','Customization Form')?></div>

    <?= $this->render('/form-info/_form', [
        'model' => new common\models\FormInfo(FORM_TYPE_CUSTOM),
        'form_type' => FORM_TYPE_CUSTOM,
        'tour_code' => '',
        'tour_name' => '',
    ]) ?>

    <div class="form-info-bottom"><?=Yii::t('app','We respond your inquiry by email within one working day.')?></div>
  </div>
</div>




<?php
$js = <<<JS

JS;
$this->registerJs($js);

$css = <<<CSS
  .tour-index.container{
    margin-top: 0px;
  }
CSS;
$this->registerCss($css); 
?>