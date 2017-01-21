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

$this->title = Yii::t('app', 'China Experiences, Search');
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
    <div class="tab"><a href="<?= Url::toRoute(['experience/index']) ?>">Filter</a></div>
    <div class="tab active">Search</div>
  </div>
</div>


<div class="tour-index container">

  <form id="tours_search" action="<?= Url::toRoute(['experience/search']) ?>"  method="post">
    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
    <div class="exp-search-form col-lg-6 col-md-6 col-sm-10 col-xs-12">
      <span class="input-group-title"><?=Yii::t('app','Destinations')?>:</span>
      <div class="input-group type-menu">
        <button type="button" class="btn btn-default dropdown-toggle"  data-toggle="modal" data-target="#tour_cities">
          <span id='txt_cities_name' class="">
            <?php 
              $show_cities_count = 3;
              if (Yii::$app->params['is_mobile']) {
                $show_cities_count = 1;
              }
              $i = 0;
              foreach ($cities as $city) {
                if (!$city['sel']) {
                  continue;
                }
                if ($i+1<=$show_cities_count) {
                  if ($i > 0) {
                    echo ', ';
                  }
                  echo $city['name'];
                }
                else{
                  echo ' ...';
                  break;
                }
              ?>
            <?php $i++; } ?>
          </span>
          <i class="glyphicon glyphicon-chevron-down"></i>
        </button>
      </div>
    </div>

    <div class="exp-search-form col-lg-6 col-md-6 col-xs-12">
      <span class="input-group-title"><?=Yii::t('app','Tour Length')?>:</span>
      <div class="input-group type-menu">
        <select id="formsearch-tour_length" class="short-input" name="tour_length">
          <?php 
          for ($i=1; $i <= 30; $i++) { ?>
            <option value="<?=$i?>" <?= ($tour_length==$i)?'selected':'' ?>><?=$i?></option>
          <?php } ?>
        </select>
        <span class="input-group-title" style="margin-left: 20px;"><?=Yii::t('app','Day(s)')?></span>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="tour_cities" tabindex="-1" role="dialog" aria-labelledby="tour_citiesLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?=Yii::t('app','Close')?></span></button>
            <h4 class="modal-title" id="tour_citiesLabel"><?=Yii::t('app','Select Cities')?></h4>
          </div>
          <div class="modal-body">
            <div class="row">
            <?php foreach ($cities as $city) { ?>
                <label class="col-lg-3 col-md-3 col-sm-4 col-xs-6"><input type="checkbox" name="tour_cities[]" value="<?=$city['id']?>" data-cityname="<?=$city['name']?>" <?= $city['sel']?'checked':'' ?>> <?=$city['name']?></label>
            <?php } ?>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?=Yii::t('app','Close')?></button>
            <button type="button" class="btn btn-primary" id="bt_cities_confirm"><?=Yii::t('app','Confirm')?></button>
          </div>
        </div>
      </div>
    </div>

    <div class="container home-btn">
        <div class="row btn-row">
            <button type="submit" class="btn btn-danger col-lg-3 col-md-4 col-xs-11"><?=Yii::t('app',"Search")?></button>
        </div>
    </div>

  </form>
  <?php $count_tours = count($tours); ?>
  <?php if (Yii::$app->request->post()) { ?>
    <span class="tours-count"><?=Yii::t('app','Found {0} tours', $count_tours)?></span>:
  <?php } ?>
  <?php if ($count_tours > 0) { ?>
    <div class=" file-drop-zone"> 
     <div class="file-preview-thumbnails">
      <div class="file-initial-thumbs row">

      <?php foreach ($tours as $tour) { ?>

       <div class="file-preview-frame file-preview-initial col-lg-4 col-md-4 col-sm-6 col-xs-12" >
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
  <?php } ?> 

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

    <div class="form-info-bottom"><?=Yii::t('app','We respond your inquiry by email within one working day.')?></div>
  </div>
</div>

<?php
$js = <<<JS
  $(function(){
    $('#bt_cities_confirm').click(function(){
      var show_count = 3;
      if(_is_mobile){
        show_count = 1;
      }
      var i = 0;
      var htmlCitiesName = '';
      jQuery("input[name='tour_cities[]']:checked").each(function(){
          var strCitiesName = jQuery(this).attr('data-cityname');
          if(i+1 <= show_count){
            if(i > 0){
              htmlCitiesName += ', ';
            }
            htmlCitiesName += strCitiesName;
          }
          else{
            htmlCitiesName += ' ...';
            return false;
          }
          i++;
      });
      if(htmlCitiesName!=''){
        $('#txt_cities_name').html(htmlCitiesName);
      }
      $('#tour_cities').modal('hide');
    });
  });
JS;
$this->registerJs($js);
?>