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
      <div class="carousel-inner full-w">
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
        <div class="tour-info-row row">
          <div class="item-s col-md-3 col-xs-3">
              <span><?= ($tour_info['tour_length']==intval($tour_info['tour_length']))?intval($tour_info['tour_length']):$tour_info['tour_length'] ?></span>
              Days
          </div>
          <div class="item-s col-md-4 col-xs-4">
               <span><?= $tour_info['cities_count'] ?></span>
               Destinations
          </div>
          <div class="col-md-5 col-xs-5">
               <span><?= $tour_info['exp_num'] ?></span>
               Experiences
          </div>
        </div>
    </div>
    <div class="container price">
         From <span>$<?= number_format($tour_info['price_usd'],0) ?></span> USD Per Person
    </div>

    <div class="container home-btn">
      <div class="row btn-row">
        <a type="button" class="btn btn-danger col-lg-3 col-md-4 col-xs-10" href="#form-info-page">Get a Free Quotation</a>
      </div>
    </div>

    <div class="container themes-info">
        <div class="list-group">
            <?php foreach (explode(',', $tour_info['themes']) as $theme_id) { ?>
            <div class="col-md-4 col-xs-6 list-group-item">
                <i class="icon-menu-ok"></i><?= Yii::$app->params['tour_themes'][$theme_id] ?>
            </div>
            <?php } ?>
        </div>
    </div>

    <div class="container">
        <center><h2>Overview</h2></center>
        <div class="overview">
          <?= $tour_info['overview'] ?>
        </div>
        <center><div id="bt_overview_more" style="display: block;">More<br><i class="glyphicon glyphicon-chevron-down"></i></div></center>
    </div>

    <div class="container map">
        <center><h2>Recommended Itinerary</h2></center>
        <div class="col-lg-12 col-md-12 col-xs-12 list-group-item">
            <img src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($tour_info['pic_map'], 'm')?>" alt="<?=  $tour_info['name'].' Map' ?>" class="img-responsive" />
        </div>
    </div>

    <div class="container itineraries">
      <?php for($j=0; $j<count($itinerary_info); $j++) { 
        $itinerary = $itinerary_info[$j];
      ?>
      <div id="itinerary-item-<?= $j ?>" class="itinerary-item" data-current="<?= $j ?>" style="<?= $j>0?'display: none;':'' ?>">

        <nav class="itinerary-swipe">
          <ul class="pager">
            <li class="bt-pager previous <?= $j==0?'disabled':'' ?>" data-current="<?= $j ?>" data-action="-1"><a href="javascript:void(0);">&lt; Prev</a></li>
            <li class="text">Day <?= $itinerary['day'] ?>/<?= count($itinerary_info) ?>:<?= $itinerary['cities_name'] ?></li>
            <li class="bt-pager next <?= $j==(count($itinerary_info)-1)?'disabled':'' ?>" data-current="<?= $j ?>" data-action="1"><a href="javascript:void(0);">Next &gt;</a></li>
          </ul>
        </nav>
        <div class="itinerary-swipe">
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
                  <div class="carousel-caption">
                    <span><?= $slide['title']?></span>
                  </div>
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

<div class="form-info container" id="form-info-page">
  <div class="form-info-create">

    <div class="form-title">Quotation Form</div>
    <h2 style="margin-top: 0;text-align: center;"><?= $tour_info['name'] ?></h2>
    <div class="tips"><?= ($tour_info['tour_length']==intval($tour_info['tour_length']))?intval($tour_info['tour_length']):$tour_info['tour_length'] ?> Days | <?= $tour_info['display_cities'] ?></div>
    <div class="tips">Tour Code: <?= $tour_info['code'] ?></div>
    <hr />
    <?= $this->render('/form-info/_form', [
        'model' => new common\models\FormInfo(FORM_TYPE_QUOTATION),
        'form_type' => FORM_TYPE_QUOTATION,
        'tour_code' => $tour_info['code'],
        'tour_name' => $tour_info['name'],
    ]) ?>

    <div class="form-info-bottom">We respond your inquiry by email within 24 hours.</div>
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

    $('.bt-pager').click(function(){
      if($(this).hasClass("disabled")){
        return;
      }
      var action = $(this).attr('data-action');
      itinerarysPaging(action);
    });

    function itinerarysPaging(action){
      var current_id = $(".itineraries").children(".itinerary-item:visible").attr('data-current');
      var max_id = $(".itineraries").children(".itinerary-item").length - 1;
      if((current_id <= 0 && action == -1) || (current_id >= max_id && action == 1))
      {
        return;
      }
      $(".itineraries").children(".itinerary-item").hide();
      $("#itinerary-item-"+(parseInt(current_id)+parseInt(action))).show();
    }
    $('.itinerary-swipe').hammer().on('swiperight', function(){  
        itinerarysPaging(-1);  
    }); 
    $('.itinerary-swipe').hammer().on('swipeleft', function(){  
        itinerarysPaging(1);  
    }); 

    var overview_height = 100;
    $(function(){
        overview_height = $('.overview').height();
        $('.overview').height(100);
    });
    $('#bt_overview_more').click(function(){
      if($('#bt_overview_more').html().indexOf("More")>=0)
      {
        $('.overview').height(overview_height);
        $('#bt_overview_more').html('<i class="glyphicon glyphicon-chevron-up"><br>Fold</i>');
      }
      else
      {
        $('.overview').height(100);
        $('#bt_overview_more').html('More<br><i class="glyphicon glyphicon-chevron-down"></i>');
      }
    });

JS;
$this->registerJs($js);
?>