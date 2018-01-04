<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\UploadedFiles;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
  
  <div class="clearfix col-lg-3"></div>

<?php if (\Yii::$app->controller->id == 'article') { ?>

<?php $mostPopularBlogs = \common\models\Tools::getMostPopularBlogs(8);
	
if(!empty($mostPopularBlogs)): ?>

<div class="tour-index container col-lg-4" style="margin-top: 0">
	<div class="col-lg-12">
        <div class="strike" style="margin-top: 0">
			<h2>
				<?= isset($exp_title)? $exp_title:Yii::t('app','Most Read Blogs')?>
		   	</h2>
		</div>
	</div>
	
    <div class="col-lg-12">
	    <ul style="padding-left: 15px">
		<?php foreach($mostPopularBlogs as $blog): ?>
			<li><a href="<?= Url::toRoute(['article/view', 'url_id'=>$blog->url_id]) ?>" class="most-read-blogs"><?= $blog->title; ?></a></li>
		<?php endforeach; ?>
		</ul>
	</div>
</div>
<?php endif; ?>

  <div class="home-whyus col-lg-4">
        <center class="tour-index"><h3 class="tour-right-title"><?=Yii::t('app','Subscribe to our Newsletter')?></h3></center>
        <div class="row tour-right subscribe-mail-form">
          <?php $form = ActiveForm::begin(['action' => '//thechinaguide.us11.list-manage.com/subscribe/post?u=d995462fd30382f7e33e816d0&amp;id=a0d17736bf', 'id'=>"mc-embedded-subscribe-form"]);
          ?>
            <div class="form-group field-mce-EMAIL">
              <label class="control-label" for="mce-EMAIL"><?=Yii::t('app','Email address')?> *</label>
              <input type="text" id="mce-EMAIL" class="form-control" name="EMAIL">
              <div class="help-block"></div>
            </div>
            <div class="form-group field-mce-FNAME">
              <label class="control-label" for="mce-FNAME"><?=Yii::t('app','First name')?></label>
              <input type="text" id="mce-FNAME" class="form-control" name="FNAME">
              <div class="help-block"></div>
            </div>
            <div class="form-group field-mce-LNAME">
              <label class="control-label" for="mce-LNAME"><?=Yii::t('app','Last name')?></label>
              <input type="text" id="mce-LNAME" class="form-control" name="LNAME">
              <div class="help-block"></div>
            </div>

            <div class="form-group bt-submit form-info">
              <input type="hidden" name="b_d995462fd30382f7e33e816d0_a0d17736bf" tabindex="-1" value="">
              <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-success','name'=>"subscribe", 'id'=>"mc-embedded-subscribe"]) ?>
            </div>
          <?php ActiveForm::end(); ?>

        </div>
  </div>

<script type="text/javascript">
    var form_valid_msg_email = "<?=Yii::t('app','not a valid email address')?>";
</script>

<?php
$this->registerJsFile('@web/statics/js/yii.validation.js',['depends'=>['frontend\assets\AppAsset']]);
$js = <<<JS
    $(function(){
        $('#mc-embedded-subscribe-form').yiiActiveForm('add', {
            id: 'mce-EMAIL',
            name: 'EMAIL',
            container: '.field-mce-EMAIL',
            input: '#mce-EMAIL',
            error: '.help-block',
            validate:  function (attribute, value, messages, deferred, form) {
                yii.validation.email(value, messages, {message: form_valid_msg_email});
            }
        });
    });
JS;
$this->registerJs($js);
?>
<?php }else{ ?>
  <div class="home-whyus col-lg-4">
        <div class="row tour-right">
			<h2>
				<span><?= Yii::t('app','Why Book With Us?') ?></span>
			</h2>
            <div class="col-lg-12 col-xs-12">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <center class="quality-character">细</center>
                    <center><?=Yii::t('app','SERVICE')?></center>
                    <div class="quality-explanation"><?=Yii::t('app','Our travel specialists and guides are there for you 24/7, from your first inquiry to the end of your trip')?></div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <center class="quality-character">精</center>
                    <center><?=Yii::t('app','EXPERTISE')?></center>
                    <div class="quality-explanation"><?=Yii::t('app','With over ten years of trip planning experience for a wide range of travelers, we are China experts')?></div>
                </div>
            </div>
            <div class="col-lg-12 col-xs-12">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <center class="quality-character">灵</center>
                    <center><?=Yii::t('app','FLEXIBILITY')?></center>
                    <div class="quality-explanation"><?=Yii::t('app','Our itineraries are all customizable and even adjustable while on tour to reflect your travel preferences')?></div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <center class="quality-character">棒</center>
                    <center><?=Yii::t('app','QUALITY')?></center>
                    <div class="quality-explanation"><?=Yii::t('app','A stress-free travel experience so you can concentrate on the most important part of your tour: you')?></div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


  <?php if (isset($tours) || ($tours = \common\models\Tools::getMostPopularTours(3) ) ) {

    if (!empty($tours)) {  ?>

  <div class="tour-index container col-lg-4" style="margin-top: 0">
	  <div class="col-lg-12">
	        <div class="strike">
				<h2>
					<?= isset($exp_title)? $exp_title:Yii::t('app','Our Popular Tours')?>
			   	</h2>
			</div>
		</div>
		
      <div class=" file-drop-zone tour-right"> 
       <div class="file-preview-thumbnails">
        <div class="file-initial-thumbs">

        <?php foreach ($tours as $tour) { ?>

         <div class="right-column-padding file-preview-frame file-preview-initial col-lg-12 col-md-4 col-sm-6 col-xs-12" >
          <a class="kv-file-content" href="<?= Url::toRoute(['experience/view', 'url_id'=>$tour['url_id']]) ?>"> 
				   <img src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($tour['pic_title'], 's')?>" alt="<?=  $tour['name'] ?>" class="kv-preview-data file-preview-image" />
				   <span class="tour-name"><?php echo $tour['name']; ?></span>
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
       </div>

      </div> 
  
      <div class="itinerary-view view-more-tours">
          	<a href="<?= Url::toRoute(['experience/index']) ?>">
	          	<span class="button right-column"><?= Yii::t('app','VIEW MORE TOURS') ?></span>
	        </a>
      </div>
      
      <div class="clear"></div>

  </div>
  <?php } } ?>
