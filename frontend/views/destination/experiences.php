<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\UploadedFiles;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $model common\models\city */

$this->title = Yii::t('app','Private tours') . ' - ' . $city_info['name'] . ' ' . Yii::t('app','Travel Guide');
$this->description = Html::encode(\common\models\Tools::limit_words(strip_tags($city_info['introduction']), 30)) . '...';
$this->keywords = Html::encode($city_info['keywords']);
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
		                	from <span id="price-number"><?= Yii::$app->params['currency_name'][Yii::$app->params['currency']]['sign'] ?><?= number_format(common\models\ExchangeUsd::convertCurrency(Yii::$app->params['currency'], $tour['price_cny']),0) ?></span> <?= Yii::$app->params['currency_name'][Yii::$app->params['currency']]['name'] ?>
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

    </div>
</div>

<div class="form-info container">
  <div class="text-before-inquiry-form col-lg-8 col-md-8 col-xs-12">
  	<h2><?=Yii::t('app',"Customize a tour that includes a visit to this destination")?></h2>
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
        'current_city_name' => $city_info['name'],
    ]) ?>

    <div class="form-info-bottom"><?=Yii::t('app','We will respond to your inquiry by email within one working day')?></div>
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