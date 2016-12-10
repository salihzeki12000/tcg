<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\UploadedFiles;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $model common\models\city */

$this->title = $city_info['name'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Destinations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url'=>Url::toRoute(['destination/view', 'name'=>$city_info['name']])];
$this->params['breadcrumbs'][] = 'Experiences';
?>
<div class="city-view">

    <div id="carousel-slides-generic" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <?php for($i=0; $i<count($city_info['images']); $i++) { ?>
            <li data-target="#carousel-slides-generic" data-slide-to="<?= $i ?>" <?= ($i==0)? 'class="active"' : '' ?> ></li>
        <?php } ?>
      </ol>
     
      <!-- Wrapper for slides -->
      <div class="carousel-inner">
        <?php for($i=0; $i<count($city_info['images']); $i++) {
            $slide=$city_info['images'][$i];
            $pic_type = 'l';
            if (Yii::$app->params['is_mobile']) {
                $pic_type = 'm';
            }
        ?>
            <div class="item <?= ($i==0)? 'active' : '' ?> ">
              <img src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($slide['path'], $pic_type)?>" alt="<?=  $slide['title'] ?>">
            </div>
        <?php } ?>
      </div>
     
      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-slides-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
      </a>
      <a class="right carousel-control" href="#carousel-slides-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
      </a>
    </div> <!-- Carousel -->

    <div class="h-title"><span>Experiences</span>
      <div class="btn-group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-menu-right" role="menu">
          <li><a href="<?= Url::toRoute(['destination/view', 'name'=>$city_info['name']]) ?>">Overview</a></li>
          <?php foreach ($menu as $key => $value) { ?>
            <li><a href="<?= Url::toRoute(['destination/'.$key, 'name'=>$city_info['name']]) ?>"><?= $value ?></a></li>
          <?php } ?>
        </ul>
      </div>
    </div>

    <div class="tour-index container">

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

        <?php
        //显示分页页码
        echo LinkPager::widget([
            'pagination' => $pages,
            'maxButtonCount' => 5,
        ])
        ?>

        </div>
    </div>

</div>

<?php
$js = <<<JS

JS;
$this->registerJs($js);

$css = <<<CSS
  .breadcrumb{
    margin-bottom: 0px;
  }
CSS;
$this->registerCss($css); 
?>