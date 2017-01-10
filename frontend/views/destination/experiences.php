<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\UploadedFiles;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $model common\models\city */

$this->title = $city_info['name'];
$this->description = Html::encode(\common\models\Tools::limit_words(strip_tags($city_info['introduction']), 30)) . '…';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Destinations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url'=>Url::toRoute(['destination/view', 'name'=>$city_info['name']])];
$this->params['breadcrumbs'][] = Yii::t('app','Experiences');
?>

<?= $this->render('_des-header', [
    'city_info' => $city_info,
]) ?>

<div class="btn-group dest-title">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?=Yii::t('app','Experiences')?>
    <i class="glyphicon glyphicon-chevron-down"></i>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="<?= Url::toRoute(['destination/view', 'name'=>$city_info['name']]) ?>"><?=Yii::t('app','Overview')?></a></li>
    <?php foreach ($menu as $key => $value) { ?>
      <li <?= (Yii::$app->controller->action->id==$key)? 'class="active"':'' ?>><a href="<?= Url::toRoute(['destination/'.$key, 'name'=>$city_info['name']]) ?>"><?= $value ?></a></li>
    <?php } ?>
  </ul>
</div>

<div class="tour-index container">

    <div class=" file-drop-zone"> 
     <div class="file-preview-thumbnails">
      <div class="file-initial-thumbs row">

      <?php foreach ($tours as $tour) { ?>

       <div class="file-preview-frame file-preview-initial col-lg-4 col-md-6 col-xs-12" >
        <a class="kv-file-content" href="<?= Url::toRoute(['experience/view', 'name'=>$tour['name']]) ?>"> 
         <img src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($tour['pic_title'], 's')?>" alt="<?=  $tour['name'] ?>" class="kv-preview-data file-preview-image" /> 
          <div class="content-press"><span><?= ($tour['tour_length']==intval($tour['tour_length']))?intval($tour['tour_length']):$tour['tour_length'] ?></span> <?=Yii::t('app','Days')?> | <span><?= $tour['cities_count'] ?></span> <?=Yii::t('app','Cities')?> | <span><?= $tour['exp_num'] ?></span> <?=Yii::t('app','Experiences')?></div>
        </a>
        <div class="file-thumbnail-footer"> 
         <div class="file-footer-caption">
            <h3><?= $tour['name'] ?> </h3>
            <div><?= Html::encode(\common\models\Tools::wordcut(strip_tags($tour['overview']), 120)) ?></div>
            <div class="tourlist-price">
              <?php if(!empty($tour['price_cny'])) { ?>
                From <span><?= Yii::$app->params['currency_name'][Yii::$app->params['currency']]['sign'] ?><?= number_format(common\models\ExchangeUsd::convertCurrency(Yii::$app->params['currency'], $tour['price_cny']),0) ?></span> <?= Yii::$app->params['currency_name'][Yii::$app->params['currency']]['name'] ?>
              <?php } ?>
              <a type="button" class="btn btn-info pull-right btn-sm" href="<?= Url::toRoute(['experience/view', 'name'=>$tour['name']]) ?>"><?=Yii::t('app','View')?></a>
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

<div class="form-info container" id="form-info-page">
  <h2><?=Yii::t('app',"No ideal itinerary or don't bother to browse? Customize your own tour now!")?></h2>
  <div class="form-info-create col-lg-8 col-md-8 col-xs-12">

    <div class="form-title"><?=Yii::t('app','Customization Form')?></div>

    <?= $this->render('/form-info/_form', [
        'model' => new common\models\FormInfo(FORM_TYPE_CUSTOM),
        'form_type' => FORM_TYPE_CUSTOM,
        'tour_code' => '',
        'tour_name' => '',
    ]) ?>

    <div class="form-info-bottom"><?=Yii::t('app','We respond your inquiry by email within 24 hours.')?></div>
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