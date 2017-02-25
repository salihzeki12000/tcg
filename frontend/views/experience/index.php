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

$this->title = Yii::t('app', 'China Experiences');
$this->description = Yii::t('app', 'China experiences, China tours, private China tours, customized China tours');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container title-bar">
  <div class="row">
    <div class="cities-banner" style="margin-bottom: 0;">
      <?= Html::img('@web/statics/images/experiences-bg' . ((Yii::$app->params['is_mobile'])?'':'-pc') . '.jpg', ['alt'=>Yii::t('app','EXPERIENCES'), 'width'=>"100%"]) ?>
      <div class="banner-text"><?=Yii::t('app','EXPERIENCES')?></div>
    </div>
  </div>
</div>
<div class="container exp-tab">
  <div class="tabs">
    <div class="tab active">Filter</div>
    <div class="tab"><a href="<?= Url::toRoute(['experience/search']) ?>">Search</a></div>
  </div>
</div>

<div class="tour-index container">
    <!-- Single button -->
    <div class="input-group type-menu col-lg-6 col-md-6 col-xs-10">
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
        <?= \common\models\Tools::wordcut($theme_name, 20) ?>
        <i class="glyphicon glyphicon-chevron-down"></i>
      </button>
      <ul class="dropdown-menu" role="menu">
        <?php foreach ($themes as $theme) { ?>
          <li <?= ($theme_id==$theme['id'])?'class="active"':'' ?>><a href="<?= Url::toRoute(['experience/index', 'theme'=>$theme['name']]) ?>"><?= $theme['name'] ?></a></li>
        <?php } ?>
      </ul>
    </div>

    <div class=" file-drop-zone"> 
     <div class="file-preview-thumbnails">
      <div class="file-initial-thumbs row">

      <?php foreach ($tours as $tour) { ?>

       <div class="file-preview-frame file-preview-initial col-lg-4 col-md-4 col-sm-6 col-xs-12" >
        <a class="kv-file-content" href="<?= Url::toRoute(['experience/view', 'url_id'=>$tour['url_id']]) ?>"> 
         <img src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($tour['pic_title'], 's')?>" alt="<?=  $tour['name'] ?>" class="kv-preview-data file-preview-image" /> 
          <div class="content-press"><span><?= ($tour['tour_length']==intval($tour['tour_length']))?intval($tour['tour_length']):$tour['tour_length'] ?></span> <?=Yii::t('app','Days')?> | <span><?= $tour['cities_count'] ?></span> <?=Yii::t('app','Destinations')?> | <span><?= $tour['exp_num'] ?></span> <?=Yii::t('app','Experiences')?></div>
        </a>
        <div class="file-thumbnail-footer"> 
         <div class="file-footer-caption">
            <h3><?= $tour['name'] ?> </h3>
            <div><?= Html::encode(\common\models\Tools::wordcut(strip_tags($tour['overview']), 120)) ?></div>
            <div class="tourlist-price">
              <?php if(!empty($tour['price_cny'])) { ?>
                From <span><?= Yii::$app->params['currency_name'][Yii::$app->params['currency']]['sign'] ?><?= number_format(common\models\ExchangeUsd::convertCurrency(Yii::$app->params['currency'], $tour['price_cny']),0) ?></span> <?= Yii::$app->params['currency_name'][Yii::$app->params['currency']]['name'] ?>
              <?php } ?>
              <a type="button" class="btn btn-info pull-right btn-sm" href="<?= Url::toRoute(['experience/view', 'url_id'=>$tour['url_id']]) ?>"><?=Yii::t('app','View')?></a>
            </div>
         </div> 
        </div> 
       </div>

      <?php } ?> 
       
     </div> 
     <div class="clearfix"></div> 
    </div>

    <?php
    //显示分页页码
    echo LinkPager::widget([
        'pagination' => $pages,
        'maxButtonCount' => 5,
    ])
    ?>

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

    <div class="form-info-bottom"><?=Yii::t('app','We will get back to you by email within 24 hours.')?></div>
  </div>
</div>

<?php
$js = <<<JS
JS;
$this->registerJs($js);
?>