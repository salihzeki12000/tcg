<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use common\models\UploadedFiles;

/* @var $this yii\web\View */
/* @var $model common\models\Tour */

$this->title = $article['title'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blogs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">

    <div class="container">
        <center><h2><?= $article['title'] ?></h2></center>
        <center><?= date('d F, Y', strtotime($article['create_time'])) ?></center>
        <div class="overview">
          <?= $article['content'] ?>
        </div>
    </div>

</div>

<div class="tour-index container">
    <center><h3>Popular Tours</h3></center>
    <div class=" file-drop-zone"> 
     <div class="file-preview-thumbnails">
      <div class="file-initial-thumbs">

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
            <div>
              <?php if(!empty($tour['price_usd'])) { ?>
                From <span>$<?= number_format($tour['price_usd'],0) ?></span> USD
              <?php } ?>
              <a type="button" class="btn btn-info pull-right btn-sm" href="<?= Url::toRoute(['experience/view', 'name'=>$tour['name']]) ?>">View</a>
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

<div class="container home-btn">
  <div class="row btn-row">
    <a type="button" class="btn btn-mine col-lg-3 col-md-4 col-xs-10" href="<?= Url::toRoute(['experience/index']) ?>">View more tours</a>
  </div>
</div>

<?php
$js = <<<JS

JS;
$this->registerJs($js);
?>