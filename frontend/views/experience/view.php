<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\UploadedFiles;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Tour */

$this->title = $tour_info['name'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Experiences'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tour-view">

    <h1 class="title"><?= Html::encode($this->title) ?> <br /><small><?= Html::encode($tour_info['display_cities']) ?></small></h1>

    <div id="carousel-slides-generic" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <?php for($i=0; $i<count($tour_info['images']); $i++) { ?>
            <li data-target="#carousel-slides-generic" data-slide-to="<?= $i ?>" <?= ($i==0)? 'class="active"' : '' ?> ></li>
        <?php } ?>
      </ol>
     
      <!-- Wrapper for slides -->
      <div class="carousel-inner">
        <?php for($i=0; $i<count($tour_info['images']); $i++) {
            $slide=$tour_info['images'][$i];
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

    <div class="container tour-info">
        <div class="tour-info-row">
          <div class="item-s">
              <span><?= ($tour_info['tour_length']==intval($tour_info['tour_length']))?intval($tour_info['tour_length']):$tour_info['tour_length'] ?></span>
              <br />
              Days
          </div>
          <div class="item-s">
               <span><?= $tour_info['cities_count'] ?></span>
              <br />
               Cities
          </div>
          <div>
               <span><?= $tour_info['exp_num'] ?></span>
              <br />
               Experiences
          </div>
          <div>
               From <br />
               $<span class="price"><?= number_format($tour_info['price_usd'],0) ?></span> USD
          </div>
        </div>
    </div>

    <div class="container themes-info">
        <div class="list-group">
            <?php foreach (explode(',', $tour_info['themes']) as $theme_id) { ?>
            <div class="col-md-4 col-xs-6 list-group-item">
                <i class="glyphicon glyphicon-ok"></i><?= Yii::$app->params['tour_themes'][$theme_id] ?>
            </div>
            <?php } ?>
        </div>
    </div>

    <div class="container">
        <center><h2>Overview</h2></center>
        <div class="overview">
          <?= $tour_info['overview'] ?>
        </div>
        <center><button type="button" id='bt_overview_more' class="btn btn-default">View More</button></center>
    </div>

    <div class="container">
        <center><h2>Map</h2></center>
        <div class="col-md-6 col-xs-12 list-group-item">
            <img src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($tour_info['pic_map'], 'm')?>" alt="<?=  $tour_info['name'].' Map' ?>" class="img-responsive" />
        </div>
    </div>

    <div class="container itineraries">
      <?php for($j=0; $j<count($itinerary_info); $j++) { 
        $itinerary = $itinerary_info[$j];
      ?>
      <div id="itinerary-item-<?= $j ?>" class="itinerary-item" style="<?= $j>0?'display: none;':'' ?>">

        <nav>
          <ul class="pager">
            <li class="bt-pager previous <?= $j==0?'disabled':'' ?>" data-current="<?= $j ?>" data-action="-1"><a href="javascript:void(0);">&lt; Prev</a></li>
            <li class="text">Day <?= $itinerary['day'] ?>/<?= count($itinerary_info) ?>:<?= $itinerary['cities_name'] ?></li>
            <li class="bt-pager next <?= $j==(count($itinerary_info)-1)?'disabled':'' ?>" data-current="<?= $j ?>" data-action="1"><a href="javascript:void(0);">Next &gt;</a></li>
          </ul>
        </nav>
        <div>
          <?= $itinerary['description'] ?>
        </div>

        <div id="carousel-slides-itinerary-<?= $j ?>" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <?php for($i=0; $i<count($itinerary['images']); $i++) { ?>
                <li data-target="#carousel-slides-itinerary-<?= $j ?>" data-slide-to="<?= $i ?>" <?= ($i==0)? 'class="active"' : '' ?> ></li>
            <?php } ?>
          </ol>
         
          <!-- Wrapper for slides -->
          <div class="carousel-inner">
            <?php for($i=0; $i<count($itinerary['images']); $i++) {
                $slide=$itinerary['images'][$i];
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
          <a class="left carousel-control" href="#carousel-slides-itinerary-<?= $j ?>" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
          </a>
          <a class="right carousel-control" href="#carousel-slides-itinerary-<?= $j ?>" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
        </div> <!-- Carousel -->

      </div>

      <?php } ?>
    </div>


    <div class="container">
        <center><h2>Inclusions</h2></center>
        <div>
          <?= $tour_info['inclusion'] ?>
        </div>
    </div>

    <div class="container">
        <center><h2>Exclusions</h2></center>
        <div>
          <?= $tour_info['exclusion'] ?>
        </div>
    </div>

    <div class="container">
        <center><h2>Tips</h2></center>
        <div>
          <?= $tour_info['tips'] ?>
        </div>
    </div>

</div>

<?php
$js = <<<JS
    $('.carousel').carousel({
        interval: 4000
    })

    $('.bt-pager').click(function(){
      if($(this).hasClass("disabled")){
        return;
      }
      var current_id = $(this).attr('data-current');
      var action = $(this).attr('data-action');
      $(".itineraries").children(".itinerary-item").hide();
      $("#itinerary-item-"+(parseInt(current_id)+parseInt(action))).show();
    });

    var overview_height = 100;
    $(function(){
        overview_height = $('.overview').height();
        $('.overview').height(100);
    });
    $('#bt_overview_more').click(function(){
      if($('#bt_overview_more').text() == 'View More')
      {
        $('.overview').height(overview_height);
        $('#bt_overview_more').text('View Fold');
      }
      else
      {
        $('.overview').height(100);
        $('#bt_overview_more').text('View More');
      }
    });

JS;
$this->registerJs($js);
?>