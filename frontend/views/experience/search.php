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

$this->title = Yii::t('app', 'Search') . ' - ' . Yii::t('app', 'China Tours');
$this->description = Yii::t('app', 'Find or customize a private tour to China');
$this->keywords = Yii::t('app','China tours, China private tours, China package tours, customized China tours');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="title-bar">
  <div class="row">
    <div class="cities-banner index-experiences">
      <?= Html::img('@web/statics/images/experiences-bg' . ((Yii::$app->params['is_mobile'])?'':'-pc') . '.jpg', ['alt'=>Yii::t('app','Private China Tours'), 'width'=>"100%"]) ?>
      <h1 class="banner-text"><?=Yii::t('app','Private China Tours')?></h1>
    </div>
  </div>
</div>
<div class="container exp-tab">
  <div class="tabs">
    <div class="tab"><a href="<?= Url::toRoute(['experience/index']) ?>"><?= Yii::t('app','Filter') ?></a></div>
    <div class="tab active"><?= Yii::t('app','Search') ?></div>
  </div>
</div>


<div class="tour-index container">
  <form id="tours_search" action="<?= Url::toRoute(['experience/search']) ?>#search-results"  method="post">
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

    <div class="exp-search-form col-lg-6 col-md-6 col-sm-10 col-xs-12">
      <span class="input-group-title"><?=Yii::t('app','Duration')?>:</span>
      <div class="input-group type-menu">
        <select id="formsearch-tour_length" class="short-input" name="tour_length">
          <?php 
          for ($i=1; $i <= 30; $i++) { ?>
            <option value="<?=$i?>" <?= ($tour_length==$i)?'selected':'' ?>><?=$i?></option>
          <?php } ?>
        </select>
        <span class="input-group-title days"><?=Yii::t('app','Day(s)')?></span>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="tour_cities" tabindex="-1" role="dialog" aria-labelledby="tour_citiesLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?=Yii::t('app','Close')?></span></button>
            <h4 class="modal-title" id="tour_citiesLabel"><?=Yii::t('app','Select Destinations')?></h4>
          </div>
          <div class="modal-body">
            <div class="row">
            <?php foreach ($cities as $city) { ?>
                <label class="col-lg-3 col-md-3 col-sm-4 col-xs-6"><input type="checkbox" name="tour_cities[]" value="<?=$city['id']?>" data-cityname="<?=$city['name']?>" <?= $city['sel']?'checked':'' ?>> <?=$city['name']?></label>
            <?php } ?>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" id="bt_cities_confirm"><?=Yii::t('app','Done')?></button>
          </div>
        </div>
      </div>
    </div>

    <div class="container home-btn" id="search-results">
        <div class="row btn-row">
            <button type="submit" class="btn btn-danger col-lg-3 col-md-4 col-sm-8 col-xs-11"><?=Yii::t('app',"Search")?></button>
        </div>
    </div>

  </form>
  <?php $count_tours = count($tours); ?>
  <?php if (Yii::$app->request->post()) { ?>
    <?php if ($count_tours>0) { ?>
      <span class="tours-count"><?=Yii::t('app','Found {0} itineraries', $count_tours)?></span>:
    <?php }else{ ?>
      <span class="tours-count"><?=Yii::t('app','No itinerary found matching your search criteria. Please refine your search or {0}let us customize your tour{1}.', ['<a href="#inquiry-form">', '</a>'])?></span>
    <?php } ?>
  <?php } ?>
  <?php if ($count_tours > 0) { ?>
    <div class=" file-drop-zone"> 
     <div class="file-preview-thumbnails">
      <div class="file-initial-thumbs row">

      <?php foreach ($tours as $tour) { ?>

       <div class="file-preview-frame file-preview-initial col-lg-4 col-md-4 col-sm-6 col-xs-12" >
        <a class="kv-file-content" href="<?= Url::toRoute(['experience/view', 'url_id'=>$tour['url_id']]) ?>"> 
				   <img src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($tour['pic_title'], 's')?>" alt="<?= $tour['name'] ?>" class="kv-preview-data file-preview-image" />
				   <h3 class="tour-name"><?php echo $tour['name']; ?></h3>
	            </a>
	            
	            <div class="file-thumbnail-footer"> 
	             <div class="file-footer-caption">
	                <div class="content-press">
		                <span><?= ($tour['tour_length']==intval($tour['tour_length']))?intval($tour['tour_length']):$tour['tour_length'] ?></span> <?=($tour['tour_length']>1)?Yii::t('app','days'):Yii::t('app','day')?>
		                
		                <br>
		                
		                <span id="tour-list-cities"><?php echo Html::encode(\common\models\Tools::wordcut(strip_tags($tour['display_cities']), 40)); ?></span>
		            </div>
	                
	                <div class="tourlist-desc">
		                <?= Html::encode(\common\models\Tools::wordcut(strip_tags($tour['overview']), 120)) ?>
	                </div>
	                
	                <div class="itinerary-view">
		                <?php if(!empty($tour['price_cny'])): ?>
		                <span class="price">
		                	<?= Yii::t('app','from') ?> <span id="price-number"><?= Yii::$app->params['currency_name'][Yii::$app->params['currency']]['sign'] ?><?= number_format(common\models\ExchangeUsd::convertCurrency(Yii::$app->params['currency'], $tour['price_cny']),0) ?></span> <?= Yii::$app->params['currency_name'][Yii::$app->params['currency']]['name'] ?>
		                </span>
		                <?php endif; ?>
						
						<a href="<?= Url::toRoute(['experience/view', 'url_id'=>$tour['url_id']]) ?>">
							<span class="button">
								<?=Yii::t('app','View trip')?>
							</span>
						</a>
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

<div class="form-info container">
  <div class="text-before-inquiry-form col-lg-8 col-md-8 col-xs-12">
  	<h2><?=Yii::t('app',"Can't find what you're looking for? Contact us today to customize your tour")?></h2>
  </div>
  <div class="form-info-create col-lg-8 col-md-8 col-xs-12">
    <span class="placeholder" id="inquiry-form"></span>
    <h2><?=Yii::t('app',"Inquiry Form")?></h2>
	<div class="tips"><?= Yii::t('app',"Let's get started! Fill out this form so we can start helping you plan your adventure in China") ?></div>
    <?= $this->render('/form-info/_form', [
        'model' => new common\models\FormInfo(FORM_TYPE_CUSTOM),
        'form_type' => FORM_TYPE_CUSTOM,
        'tour_code' => '',
        'tour_name' => '',
    ]) ?>

    <div class="form-info-bottom"><?=Yii::t('app','We will respond to your inquiry by email within one working day')?></div>
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
      $('#txt_cities_name').html(htmlCitiesName);
      $('#tour_cities').modal('hide');
    });
  });
JS;
$this->registerJs($js);
?>