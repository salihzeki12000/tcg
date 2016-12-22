<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\UploadedFiles;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\city */

$this->title = $activity_info['name'];
$this->params['breadcrumbs'][] = ['label' => $city_info['name'], 'url'=>Url::toRoute(['destination/view', 'name'=>$city_info['name']])];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activities'), 'url'=>Url::toRoute(['destination/activities', 'name'=>$city_info['name']])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-view">

    <div id="carousel-slides-generic" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <?php for($i=0; $i<count($activity_info['images']); $i++) { ?>
            <li data-target="#carousel-slides-generic" data-slide-to="<?= $i ?>" <?= ($i==0)? 'class="active"' : '' ?> ></li>
        <?php } ?>
      </ol>
     
      <!-- Wrapper for slides -->
      <div class="carousel-inner full-w">
        <?php for($i=0; $i<count($activity_info['images']); $i++) {
            $slide=$activity_info['images'][$i];
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

    <div class="h-title"><span><?= $activity_info['name'] ?></span>
    </div>
    <div class="container">

        <div class="overview">
          <?= $activity_info['overview'] ?>
        </div>
    </div>

</div>

<?php
$js = <<<JS
    $('.carousel').carousel({
        interval: 4000
    })
    $('.carousel').hammer().on('swipeleft', function(){  
        $(this).carousel('next');  
    });  
    $('.carousel').hammer().on('swiperight', function(){  
        $(this).carousel('prev');  
    }); 
JS;
$this->registerJs($js);

$css = <<<CSS
  .breadcrumb{
    margin-bottom: 0px;
  }
CSS;
$this->registerCss($css); 
?>