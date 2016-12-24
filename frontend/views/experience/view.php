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


  <div class="container tour-left col-lg-8 col-md-12 col-sm-12 col-xs-12">
    
    <div class="tour-info">
        <div class="tour-info-row">
          <div class="item-s col-lg-3 col-md-3 col-xs-3">
              <span><?= ($tour_info['tour_length']==intval($tour_info['tour_length']))?intval($tour_info['tour_length']):$tour_info['tour_length'] ?></span>
              Days
          </div>
          <div class="item-s col-lg-4 col-md-4 col-xs-4">
               <span><?= $tour_info['cities_count'] ?></span>
               Destinations
          </div>
          <div class="col-lg-5 col-md-5 col-xs-5">
               <span><?= $tour_info['exp_num'] ?></span>
               Experiences
          </div>
        </div>
    </div>
    <div class="price col-lg-12 col-md-12 col-sm-12 col-xs-12">
         From <span>$<?= number_format($tour_info['price_usd'],0) ?></span> USD Per Person
    </div>

    <div class="home-btn col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="btn-row">
        <a type="button" class="btn btn-danger col-lg-4 col-md-4 col-xs-10" href="#form-info-page">Get a Free Quotation</a>
      </div>
    </div>

    <div class="themes-info col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="list-group">
            <?php foreach (explode(',', $tour_info['themes']) as $theme_id) { ?>
            <div class="col-lg-4 col-md-4 col-xs-6 list-group-item">
                <i class="icon-menu-ok"></i><?= Yii::$app->params['tour_themes'][$theme_id] ?>
            </div>
            <?php } ?>
        </div>
    </div>

    <div class="container-overview col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <center><h2>Overview</h2></center>
        <div class="overview">
          <?= $tour_info['overview'] ?>
        </div>
        <center><div id="bt_overview_more" style="display: block;">More<br><i class="glyphicon glyphicon-chevron-down"></i></div></center>
    </div>

    <div class="map itinerary-swipe col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <center><h2>Recommended Itinerary</h2></center>
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


    <div class="inclusion col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <center><h2>Inclusions</h2></center>
        <div>
          <?= $tour_info['inclusion'] ?>
        </div>
    </div>

    <div class="exclusion col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <center><h2>Exclusions</h2></center>
        <div>
          <?= $tour_info['exclusion'] ?>
        </div>
    </div>

    <div class="tips col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <center><h2>Tips</h2></center>
        <div>
          <?= $tour_info['tips'] ?>
        </div>
    </div>

    <div class="form-info col-lg-12 col-md-12 col-sm-12 col-xs-12" id="form-info-page">
      <div class="clearfix"></div> 
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
  </div>

  <div class="home-whyus col-lg-4 hidden-xs hidden-md hidden-sm">
        <center class="tour-index"><h3>Why book with us?</h3></center>
        <div class="col-lg-12">
            <div class="col-lg-6">
                <i class="icon-whyus-service"></i>
                <center>SERVICE</center>
                <span>Our multilingual team of native speakers is there for you 24/7, from your first enquiry to the end of your trip</span>
            </div>
            <div class="col-lg-6">
                <i class="icon-whyus-expertise"></i>
                <center>EXPERTISE</center>
                <span>With over ten years of trip planning across 40 destinations under our belts, we are China experts</span>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="col-lg-6">
                <i class="icon-whyus-flexibility"></i>
                <center>FLEXIBILITY</center>
                <span>We know that no two travel experiences are the same. Let us customize your perfect trip</span>
            </div>
            <div class="col-lg-6">
                <i class="icon-whyus-quality"></i>
                <center>QUALITY</center>
                <span>A stress-free travel experience so you can concentrate on the most important part of your tour: you</span>
            </div>
        </div>
  </div>

  <div class="tour-index col-lg-4 hidden-xs hidden-md hidden-sm">
      <center><h3>Popular Tours</h3></center>
      <div class=" file-drop-zone"> 
       <div class="file-preview-thumbnails">
        <div class="file-initial-thumbs">

        <?php foreach ($tours as $tour) { ?>

         <div class="file-preview-frame file-preview-initial col-lg-12" >
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

      </div>
  </div>
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