<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\UploadedFiles;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Tour */
$this->title = (($tour_info['tour_length']==intval($tour_info['tour_length']))?intval($tour_info['tour_length']):$tour_info['tour_length']) . ' ' . (($tour_info['tour_length']>1)?Yii::t('app','Days'):Yii::t('app','Day')) . ' ' . Yii::t('app','China Guided') . ' ' . Yii::t('app','Small Group Tour') . ' ' . $tour_info['display_cities'] . ' ' . Yii::t('app','Itinerary');
$this->description = (($tour_info['tour_length']==intval($tour_info['tour_length']))?intval($tour_info['tour_length']):$tour_info['tour_length']) . ' ' . (($tour_info['tour_length']>1)?Yii::t('app','Days'):Yii::t('app','Day')) . ', ' . $tour_info['cities_count'] . ' ' . (($tour_info['cities_count']>1)?Yii::t('app','Destinations'):Yii::t('app','Destination')) . ', ' . $tour_info['exp_num'] . ' ' . (($tour_info['exp_num']>1)?Yii::t('app','Experiences'):Yii::t('app','Experience')) . '; '
  . $tour_info['display_cities'] . ' ' . Yii::t('app','guided tour package') . '; '
  . Yii::t('app','Tour Themes') . ': ';
$this->keywords = Html::encode($tour_info['keywords']);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Experiences'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tour-view">

    <h1 class="title"><?=$tour_info['name']?><br /><small><?= ($tour_info['tour_length']==intval($tour_info['tour_length']))?intval($tour_info['tour_length']):$tour_info['tour_length'] ?> <?=($tour_info['tour_length']>1)?Yii::t('app','Days'):Yii::t('app','Day')?> | <?= $tour_info['display_cities'] ?> <?=Yii::t('app','Small Group Tour')?></small></h1>

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
        <div class="tour-info-row row">
          <div class="item-s col-lg-4 col-md-3 col-xs-4">
              <span><?= ($tour_info['tour_length']==intval($tour_info['tour_length']))?intval($tour_info['tour_length']):$tour_info['tour_length'] ?></span>
              <?=($tour_info['tour_length']>1)?Yii::t('app','Days'):Yii::t('app','Day')?>
          </div>
          <div class="item-s col-lg-4 col-md-4 col-xs-4">
               <span><?= $tour_info['cities_count'] ?></span>
               <?=($tour_info['cities_count']>1)?Yii::t('app','Destinations'):Yii::t('app','Destination')?>
          </div>
          <div class="col-lg-4 col-md-5 col-xs-4">
               <span><?= $tour_info['exp_num'] ?></span>
               <?=($tour_info['exp_num']>1)?Yii::t('app','Experiences'):Yii::t('app','Experience')?>
          </div>
        </div>
    </div>

    <div class="themes-info col-lg-12 col-md-12 col-sm-12 col-xs-12" id="nav-overview">
        <center><h2 id="nav-overview"><?=Yii::t('app','Themes')?></h2></center>
        <div class="overview list-group">
            <?php 
            $this->description .= Yii::t('app','Small Group Tour');
            echo '<span>' . Yii::t('app','Small Group Tour') . '<span>';
            $i = 0;
            foreach (explode(',', $tour_info['themes']) as $theme_id) { 
              if (!array_key_exists($theme_id, Yii::$app->params['tour_themes'])) {
                continue;
              }
              $this->description .= ', ' . Yii::$app->params['tour_themes'][$theme_id];
              $i++;
              ?>
              ,
            <span><?= Yii::$app->params['tour_themes'][$theme_id] ?></span>
                
            <?php } ?>
        </div>
    </div>

    <div class="group-date col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <center><h2 id="nav-overview"><?=Yii::t('app','Dates & Prices')?></h2></center>
        <div class="overview">
          <span class="content-color-1">Dates:</span>
          <?= date('F d, Y', strtotime($tour_info['begin_date'])) ?> - 
          <?= date('F d, Y', strtotime($tour_info['end_date'])) ?>
          <?php if(!empty($tour_info['other_dates'])) {?>
             / <?=$tour_info['other_dates']?>
          <?php } ?>
        </div>
        <div class="overview">
          <?= $tour_info['prices_detail'] ?>
        </div>
    </div>

    <div class="group-overview col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <center><h2 id="nav-overview"><?=Yii::t('app','Overview')?></h2></center>
        <div class="overview">
          <?= $tour_info['overview'] ?>
        </div>
    </div>

    <div class="home-btn hidden-lg col-md-12 col-sm-12 col-xs-12">
      <div class="btn-row">
        <a type="button" class="btn btn-danger col-lg-6 col-md-4 col-xs-10" href="#inquiry-form"><?=Yii::t('app','Join This Group Tour')?></a>
      </div>
    </div>

    <div class="map itinerary-swipe col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <center><h2><?=Yii::t('app','Itinerary')?></h2></center>
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

        <?php if (count($itinerary['images']) > 0) { ?>
          <div id="carousel-slides-itinerary-<?= $j ?>" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <?php if (count($itinerary['images']) > 1) { ?>
            <ol class="carousel-indicators">
              <?php for($i=0; $i<count($itinerary['images']); $i++) { ?>
                  <li data-target="#carousel-slides-itinerary-<?= $j ?>" data-slide-to="<?= $i ?>" <?= ($i==0)? 'class="active"' : '' ?> ></li>
              <?php } ?>
            </ol>
            <?php } ?>
           
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
                    </div>
                  </div>
              <?php } ?>
            </div>
           
           <?php if (count($itinerary['images']) > 1) { ?>
            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-slides-itinerary-<?= $j ?>" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-slides-itinerary-<?= $j ?>" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
            <?php } ?>
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
        <center><h2><?=Yii::t('app','Notes')?></h2></center>
        <div class="overview">
          <?= $tour_info['tips'] ?>
        </div>
   </div>

  </div>

  <div class="form-info col-lg-4 col-md-12 col-sm-12 col-xs-12" >
    <div class="clearfix"></div> 
    <div class="form-info-create">
      <span class="placeholder" id="inquiry-form"></span>

      <div class="form-title"><?=Yii::t('app','Application Form')?></div>
      <h2 style="margin-top: 0;text-align: center;"><?= $tour_info['name'] ?></h2>
      <div class="tips"><?=Yii::t('app','Tour Code:')?> <?= $tour_info['code'] ?></div>
      <hr />
      <?= $this->render('/form-info/_form', [
          'model' => new common\models\FormInfo(FORM_TYPE_GROUP),
          'form_type' => FORM_TYPE_GROUP,
          'tour_code' => $tour_info['code'],
          'tour_name' => $tour_info['name'],
          'bt_submit_txt' => Yii::t('app', 'Submit') ,
      ]) ?>

      <div class="form-info-bottom"><?=Yii::t('app','We will get back to you by email within 24 hours.')?></div>
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

JS;
$this->registerJs($js);
?>