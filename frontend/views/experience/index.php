<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\Cities;
use common\models\UploadedFiles;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TourSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Experiences');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tour-index container">

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
     <div class="file-preview-status text-center text-success"></div> 
     <div class="kv-fileinput-error file-error-message" style="display: none;"></div> 
    </div>


</div>
