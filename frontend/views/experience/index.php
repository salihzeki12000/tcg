<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\Cities;
use common\models\UploadedFiles;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TourSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Experiences');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tour-index container">
    <!-- Single button -->
    <div class="input-group type-menu">
      <span class="input-group-addon">Filter:</span>
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
        <?php if ($type) {
          echo Yii::$app->params['rec_type'][$type];
        }
        else{
          echo 'Select';
        } ?>
        <span class="caret"></span>
      </button>
      <ul class="dropdown-menu" role="menu">
          <li><a href="/experiences">All</a></li>
        <?php foreach (Yii::$app->params['rec_type'] as $id => $name) { ?>
          <li><a href="/experiences/type/<?= $id ?>"><?= $name ?></a></li>
        <?php } ?>
      </ul>
    </div>

    <div class=" file-drop-zone"> 
     <div class="file-preview-thumbnails">
      <div class="file-initial-thumbs">

      <?php foreach ($tours as $tour) { ?>

       <div class="file-preview-frame file-preview-initial" >
        <a class="kv-file-content" href="#"> 
         <img src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($tour['pic_title'], 's')?>" alt="<?=  $tour['name'] ?>" class="kv-preview-data file-preview-image" /> 
          <div class="content-press">From <br />$<span><?= number_format($tour['price_usd'],0) ?></span> USD</div>
        </a>
        <div class="file-thumbnail-footer"> 
         <div class="file-footer-caption">
          <span><?= ($tour['tour_length']==intval($tour['tour_length']))?intval($tour['tour_length']):$tour['tour_length'] ?> Days | <?= $tour['cities_count'] ?> Cities | <?= $tour['exp_num'] ?> Experiences</span>
            <h3><?= $tour['name'] ?> </h3>
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

<input size="16" type="text" value="" readonly class="form_datetime">

<?php
$this->registerCssFile('@web/statics/css/bootstrap-datepicker3.min.css',['depends'=>['frontend\assets\AppAsset']]);
$this->registerJsFile('@web/statics/js/bootstrap-datepicker.min.js',['depends'=>['frontend\assets\AppAsset']]);
$js = <<<JS
    $(".form_datetime").datepicker({});
JS;
$this->registerJs($js);
?>