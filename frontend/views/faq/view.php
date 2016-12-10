<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use common\models\UploadedFiles;

/* @var $this yii\web\View */
/* @var $model common\models\Tour */

$this->title = $faq['title'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'FAQ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">

    <div class="container">
        <center><h2><?= $faq['title'] ?></h2></center>
        <div class="overview">
          <?= $faq['content'] ?>
        </div>
    </div>

</div>

<div class="tour-index container">
    <center><h2>Popular Tours</h2></center>
    <div class=" file-drop-zone"> 
     <div class="file-preview-thumbnails">
      <div class="file-initial-thumbs">

      <?php foreach ($tours as $tour) { ?>

       <div class="file-preview-frame file-preview-initial" >
        <a class="kv-file-content" href="<?= Url::toRoute(['experience/view', 'id'=>$tour['id']]) ?>"> 
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

    </div>
</div>
<?php
$js = <<<JS

JS;
$this->registerJs($js);
?>