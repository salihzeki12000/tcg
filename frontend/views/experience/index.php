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

$this->title = Yii::t('app', 'Experiences');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
  <div class="row">
    <div class="cities-banner hidden-md hidden-lg hidden-sm">
      <?= Html::img('@web/statics/images/experiences-bg.jpg', ['alt'=>'EXPERIENCES', 'width'=>"100%"]) ?>
      <div class="banner-text">EXPERIENCES</div>
    </div>
  </div>
</div>

<div class="tour-index container">
    <!-- Single button -->
    <div class="input-group type-menu">
      <span class="input-group-addon">Filter:</span>
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
        <?php if ($theme_id) {
          echo Yii::$app->params['tour_themes'][$theme_id];
        }
        else{
          echo 'Select';
        } ?>
        <span class="caret"></span>
      </button>
      <ul class="dropdown-menu" role="menu">
          <li><a href="/experiences">All</a></li>
        <?php foreach (Yii::$app->params['tour_themes'] as $id => $name) { ?>
          <li><a href="<?= Url::toRoute(['experience/index', 'theme'=>$name]) ?>"><?= $name ?></a></li>
        <?php } ?>
      </ul>
    </div>

    <div class=" file-drop-zone"> 
     <div class="file-preview-thumbnails">
      <div class="file-initial-thumbs row">

      <?php foreach ($tours as $tour) { ?>

       <div class="file-preview-frame file-preview-initial col-lg-4 col-md-6 col-xs-12" >
        <a class="kv-file-content" href="<?= Url::toRoute(['experience/view', 'name'=>$tour['name']]) ?>"> 
         <img src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($tour['pic_title'], 's')?>" alt="<?=  $tour['name'] ?>" class="kv-preview-data file-preview-image" /> 
          <div class="content-press"><span><?= ($tour['tour_length']==intval($tour['tour_length']))?intval($tour['tour_length']):$tour['tour_length'] ?></span> Days | <span><?= $tour['cities_count'] ?></span> Cities | <span><?= $tour['exp_num'] ?></span> Experiences</div>
        </a>
        <div class="file-thumbnail-footer"> 
         <div class="file-footer-caption">
            <h3><?= $tour['name'] ?> </h3>
            <div><?= substr(strip_tags($tour['overview']), 0, 120)  ?>...</div>
            <div>From <span>$<?= number_format($tour['price_usd'],0) ?></span> USD <a type="button" class="btn btn-info pull-right btn-sm" href="<?= Url::toRoute(['experience/view', 'name'=>$tour['name']]) ?>">View</a></div>
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

<input size="16" type="text" value="" readonly class="form_datetime">

<?php
$this->registerCssFile('@web/statics/css/bootstrap-datepicker3.min.css',['depends'=>['frontend\assets\AppAsset']]);
$this->registerJsFile('@web/statics/js/bootstrap-datepicker.min.js',['depends'=>['frontend\assets\AppAsset']]);
$js = <<<JS
    $(".form_datetime").datepicker({});
JS;
$this->registerJs($js);
?>