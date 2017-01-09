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
                $pic_type = 'mob';
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


  <div class="container tour-left col-lg-8 col-md-12 col-sm-12 col-xs-12">
    
    <div class="tour-info">
        <div class="tour-info-row">
          <div class="item-s col-lg-4 col-md-3 col-xs-4">
              <span><?= ($tour_info['tour_length']==intval($tour_info['tour_length']))?intval($tour_info['tour_length']):$tour_info['tour_length'] ?></span>
              Days
          </div>
          <div class="item-s col-lg-4 col-md-4 col-xs-4">
               <span><?= $tour_info['cities_count'] ?></span>
               Destinations
          </div>
          <div class="col-lg-4 col-md-5 col-xs-4">
               <span><?= $tour_info['exp_num'] ?></span>
               Experiences
          </div>
        </div>
    </div>
    <div class="price col-lg-12 col-md-12 col-sm-12 col-xs-12">
         From <span><?= Yii::$app->params['currency_name'][Yii::$app->params['currency']]['sign'] ?><?= number_format(common\models\ExchangeUsd::convertCurrency(Yii::$app->params['currency'], $tour_info['price_cny']),0) ?></span> <?= Yii::$app->params['currency_name'][Yii::$app->params['currency']]['name'] ?> Per Person
    </div>

    <div class="home-btn col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="btn-row">
        <a type="button" class="btn btn-danger col-lg-6 col-md-4 col-xs-10" href="#form-info-page"><?=Yii::t('app','Get a Free Quotation')?></a>
      </div>
    </div>

    <div class="themes-info col-lg-12 col-md-12 col-sm-12 col-xs-12" id="nav-overview">
        <div class="list-group">
            <?php foreach (explode(',', $tour_info['themes']) as $theme_id) { ?>
            <div class="col-lg-6 col-md-6 col-xs-6 list-group-item">
                <i class="icon-menu-ok"></i><?= Yii::$app->params['tour_themes'][$theme_id] ?>
            </div>
            <?php } ?>
        </div>
    </div>

    <div class="container-overview col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <center><h2 id="nav-overview"><?=Yii::t('app','Overview')?></h2></center>
        <div class="overview" id="overview-body">
          <?= $tour_info['overview'] ?>
        </div>
        <center><a href="#nav-overview" id="bt_overview_more" style="display: block;">More<br><i class="glyphicon glyphicon-chevron-down"></i></a></center>
    </div>

    <div class="map itinerary-swipe col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <center><h2><?=Yii::t('app','Recommended Itinerary')?></h2></center>
        <div class="col-lg-12 col-md-12 col-xs-12 list-group-item">
            <img src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($tour_info['pic_map'], 'm')?>" alt="<?=  $tour_info['name'].' Map' ?>" class="img-responsive" />
        </div>
    </div>

    <div class="itineraries col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <?php for($j=0; $j<count($itinerary_info); $j++) { 
        $itinerary = $itinerary_info[$j];
      ?>
      <div id="itinerary-item-<?= $j ?>" class="itinerary-item" data-current="<?= $j ?>" style="<?= $j>0?'display: none;':'' ?>">

        <nav class="itinerary-swipe">
          <ul class="pager">
            <li class="bt-pager previous <?= $j==0?'disabled':'' ?>" data-current="<?= $j ?>" data-action="-1"><a href="javascript:void(0);">&lt; <?=Yii::t('app','Prev')?></a></li>
            <li class="text col-xs-7"><?=Yii::t('app','Day')?> <?= $itinerary['day'] ?>/<?= count($itinerary_info) ?>: <?= $itinerary['cities_name'] ?></li>
            <li class="bt-pager next <?= $j==(count($itinerary_info)-1)?'disabled':'' ?>" data-current="<?= $j ?>" data-action="1"><a href="javascript:void(0);"><?=Yii::t('app','Next')?> &gt;</a></li>
          </ul>
        </nav>
        <div class="itinerary-swipe overview">
          <?= $itinerary['description'] ?>
        </div>

        <?php if (!empty($itinerary['images'])) { ?>
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
                  $pic_type = 'm';
                  if (Yii::$app->params['is_mobile']) {
                      $pic_type = 's';
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

        <?php } ?>


      </div>

      <?php } ?>
    </div>


    <div class="inclusion col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <center><h2><?=Yii::t('app','Inclusions')?></h2></center>
        <div class="overview">
          <?= $tour_info['inclusion'] ?>
        </div>
    </div>

    <div class="exclusion col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <center><h2><?=Yii::t('app','Exclusions')?></h2></center>
        <div class="overview">
          <?= $tour_info['exclusion'] ?>
        </div>
    </div>

    <div class="tips col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <center><h2><?=Yii::t('app','Tips')?></h2></center>
        <div class="overview">
          <?= $tour_info['tips'] ?>
        </div>
        <div id="form-info-page"><br><br></div>
   </div>

    <div class="form-info col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="clearfix"></div> 
      <div class="form-info-create">

        <div class="form-title"><?=Yii::t('app','Quotation Form')?></div>
        <h2 style="margin-top: 0;text-align: center;"><?= $tour_info['name'] ?></h2>
        <div class="tips"><?= ($tour_info['tour_length']==intval($tour_info['tour_length']))?intval($tour_info['tour_length']):$tour_info['tour_length'] ?> <?=Yii::t('app','Days:')?> | <?= $tour_info['display_cities'] ?></div>
        <div class="tips"><?=Yii::t('app','Tour Code:')?> <?= $tour_info['code'] ?></div>
        <hr />
        <?= $this->render('/form-info/_form', [
            'model' => new common\models\FormInfo(FORM_TYPE_QUOTATION),
            'form_type' => FORM_TYPE_QUOTATION,
            'tour_code' => $tour_info['code'],
            'tour_name' => $tour_info['name'],
        ]) ?>

        <div class="form-info-bottom"><?=Yii::t('app','We respond your inquiry by email within 24 hours.')?></div>
      </div>
    </div>
  </div>

  <?php if (!Yii::$app->params['is_mobile']) { ?>
    <?= $this->render('/layouts/_exp-right', [
        'tours' => $tours,
    ]) ?>
  <?php } ?>

</div>

<?php
$js = <<<JS

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

    var overview_height = 200;
    $(function(){
        overview_height = $('#overview-body').height();
        $('#overview-body').height(200);
    });
    $('#bt_overview_more').click(function(){
      if($('#bt_overview_more').html().indexOf("More")>=0)
      {
        $('#overview-body').height(overview_height);
        $('#bt_overview_more').html('<i class="glyphicon glyphicon-chevron-up"><br>Fold</i>');
      }
      else
      {
        $('#overview-body').height(200);
        $('#bt_overview_more').html('More<br><i class="glyphicon glyphicon-chevron-down"></i>');
      }
    });

JS;
$this->registerJs($js);
?>