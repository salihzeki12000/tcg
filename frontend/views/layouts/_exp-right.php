<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\UploadedFiles;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
  <div class="clearfix col-lg-3"></div>

<?php if (\Yii::$app->controller->id == 'article') { ?>
  <div class="home-whyus col-lg-4">
        <center class="tour-index"><h3><?=Yii::t('app','Subscribe to our mailing list')?></h3></center>
        <div class="row tour-right subscribe-mail-form">
          <?php $form = ActiveForm::begin(['action' => '//thechinaguide.us11.list-manage.com/subscribe/post?u=d995462fd30382f7e33e816d0&amp;id=a0d17736bf', 'id'=>"mc-embedded-subscribe-form"]);
          ?>
            <div class="form-group field-mce-EMAIL">
              <label class="control-label" for="mce-EMAIL"><?=Yii::t('app','Email Address')?> *</label>
              <input type="text" id="mce-EMAIL" class="form-control" name="EMAIL">
              <div class="help-block"></div>
            </div>
            <div class="form-group field-mce-FNAME">
              <label class="control-label" for="mce-FNAME"><?=Yii::t('app','First Name')?></label>
              <input type="text" id="mce-FNAME" class="form-control" name="FNAME">
              <div class="help-block"></div>
            </div>
            <div class="form-group field-mce-LNAME">
              <label class="control-label" for="mce-LNAME"><?=Yii::t('app','Last Name')?></label>
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
        <center class="tour-index"><h3><?=Yii::t('app','Why book with us?')?></h3></center>
        <div class="row tour-right">
          <div class="col-lg-12 col-xs-12">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <i class="icon-whyus-service"></i>
                  <center><?=Yii::t('app','SERVICE')?></center>
                  <span><?=Yii::t('app','Our multilingual team of native speakers is there for you 24/7, from your first enquiry to the end of your trip')?></span>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <i class="icon-whyus-expertise"></i>
                  <center><?=Yii::t('app','EXPERTISE')?></center>
                  <span><?=Yii::t('app','With over ten years of trip planning across 40 destinations under our belts, we are China experts')?></span>
              </div>
          </div>
          <div class="col-lg-12">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <i class="icon-whyus-flexibility"></i>
                  <center><?=Yii::t('app','FLEXIBILITY')?></center>
                  <span><?=Yii::t('app','We know that no two travel experiences are the same. Let us customize your perfect trip')?></span>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <i class="icon-whyus-quality"></i>
                  <center><?=Yii::t('app','QUALITY')?></center>
                  <span><?=Yii::t('app','A stress-free travel experience so you can concentrate on the most important part of your tour: you')?></span>
              </div>
          </div>
        </div>
  </div>
<?php } ?>


  <?php if (isset($tours) || ($tours = \common\models\Tools::getMostPopularTours(3) ) ) {

    if (!empty($tours)) {  ?>

  <div class="tour-index col-lg-4">
      <center class="tour-index"><h3 class="tour-right" style="margin-top: 40px;"><?= isset($exp_title)? $exp_title:Yii::t('app','Our Popular Tours')?></h3></center>
      <div class=" file-drop-zone tour-right"> 
       <div class="file-preview-thumbnails">
        <div class="file-initial-thumbs">

        <?php foreach ($tours as $tour) { ?>

         <div class="file-preview-frame file-preview-initial col-lg-12 col-md-4 col-sm-6 col-xs-12" >
          <a class="kv-file-content" href="<?= Url::toRoute(['experience/view', 'url_id'=>$tour['url_id']]) ?>"> 
           <img src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($tour['pic_title'], 's')?>" alt="<?=  $tour['name'] ?>" class="kv-preview-data file-preview-image" /> 
          </a>
          <div class="file-thumbnail-footer"> 
           <div class="file-footer-caption">
              <div class="content-press"><span><?= ($tour['tour_length']==intval($tour['tour_length']))?intval($tour['tour_length']):$tour['tour_length'] ?></span> <?=($tour['tour_length']>1)?Yii::t('app','Days'):Yii::t('app','Day')?> | <span><?= $tour['cities_count'] ?></span> <?=($tour['cities_count']>1)?Yii::t('app','Destinations'):Yii::t('app','Destination')?> | <span><?= $tour['exp_num'] ?></span> <?=($tour['exp_num']>1)?Yii::t('app','Activities'):Yii::t('app','Activity')?></div>
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
       </div>

      </div>

      <div class=" home-btn">
        <div class="btn-row">
          <a type="button" class="btn btn-mine col-lg-10 col-md-4 col-xs-10" href="<?= Url::toRoute(['experience/index']) ?>">View more tours</a>
        </div>
      </div>

  </div>
  <?php } } ?>
