<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\UploadedFiles;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Tour */
$this->title = (($tour_info['tour_length']==intval($tour_info['tour_length']))?intval($tour_info['tour_length']):$tour_info['tour_length']) . '-' . Yii::t('app','Day') . ' ' . Yii::t('app','China Guided') . ' ' . Yii::t('app','Small Group Tour') . ': ' . $tour_info['display_cities'] . ' ' . Yii::t('app','Itinerary');

$this->description = (($tour_info['tour_length']==intval($tour_info['tour_length']))?intval($tour_info['tour_length']):$tour_info['tour_length']) . ' ' . (($tour_info['tour_length']>1)?Yii::t('app','Days'):Yii::t('app','Day')) . ', ' . $tour_info['cities_count'] . ' ' . (($tour_info['cities_count']>1)?Yii::t('app','Destinations'):Yii::t('app','Destination')) . ', ' . $tour_info['exp_num'] . ' ' . (($tour_info['exp_num']>1)?Yii::t('app','Experiences'):Yii::t('app','Experience')) . '; '
  . $tour_info['display_cities'] . ' ' . Yii::t('app','Itinerary; ');
  
$this->keywords = Html::encode($tour_info['keywords']);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Experiences'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tour-view">

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
    </div>


  <div class="container tour-left col-lg-8 col-md-12 col-sm-12 col-xs-12">
    <div class="tour-info">
      <div class="col-lg-12 col-md-12 col-xs-12">
          <h1 class="title"><?= Html::encode($tour_info['name']) ?><small><?= $tour_info['display_cities'] ?> <?=Yii::t('app','Tour')?></small></h1>
      </div>
        <div class="tour-info-row row">
          <div class="col-lg-4 col-md-4 col-xs-4">
              <?=($tour_info['tour_length']>1)?Yii::t('app','Days'):Yii::t('app','Day')?>
              <span><?= ($tour_info['tour_length']==intval($tour_info['tour_length']))?intval($tour_info['tour_length']):$tour_info['tour_length'] ?></span>
          </div>
          <div class="col-lg-4 col-md-4 col-xs-4">
               <?=($tour_info['cities_count']>1)?Yii::t('app','Destinations'):Yii::t('app','Destination')?>
               <span><?= $tour_info['cities_count'] ?></span>
          </div>
          <div class="col-lg-4 col-md-4 col-xs-4">
               <?=($tour_info['exp_num']>1)?Yii::t('app','Experiences'):Yii::t('app','Experience')?>
               <span><?= $tour_info['exp_num'] ?></span>
          </div>
        </div>
    </div>
    
    <div class="home-btn hidden-lg col-md-12 col-sm-12 col-xs-12">
      <div class="btn-row">
        <a type="button" class="btn btn-danger col-lg-6 col-md-4 col-xs-10" href="#inquiry-form"><?=Yii::t('app','Join This Group Tour')?></a>
      </div>
    </div>
    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="col-lg-12">
        <div class="strike">
        <h2>
          <?=Yii::t('app','Dates & Prices')?>
        </h2>
      </div>
    </div>
        <div class="overview">
          <?= date('F d, Y', strtotime($tour_info['begin_date'])) ?> - 
          <?= date('F d, Y', strtotime($tour_info['end_date'])) ?>
          <?php if(!empty($tour_info['other_dates'])) {?>
             / <?=$tour_info['other_dates']?>
          <?php } ?>
        </div>
        <div class="overview">
        </div>
    </div>

    <div class="group-overview col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="col-lg-12">
        <div class="strike">
        <h2>
          <?=Yii::t('app','Trip Summary')?>
        </h2>
      </div>
    </div>
    <div class="list-group">
            <?php 
            $this->description .= Yii::t('app','Small Group Tour, ');
            echo '<span class="theme">' . Yii::t('app','Small Group Tour') . '</span>';
            $i = 0;
            foreach (explode(',', $tour_info['themes']) as $theme_id) { 
              if (!array_key_exists($theme_id, Yii::$app->params['tour_themes'])) {
                continue;
              }
              if ($i !== 0) {
                $this->description .= ', ';
              }
              $this->description .= Yii::$app->params['tour_themes'][$theme_id];
              $i++;
              ?><span class="theme"><?= Yii::$app->params['tour_themes'][$theme_id] ?></span><?php } ?>
        </div>
        <div class="overview">
          <?= $tour_info['overview'] ?>
        </div>
    </div>

    <div class="map itinerary-swipe col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="col-lg-12">
          <div class="strike">
        <h2>
          <?=Yii::t('app','Itinerary')?>
          </h2>
      </div>
    </div>
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
            <span class="bt-pager previous <?= $j==0?'disabled':'' ?>" data-current="<?= $j ?>" data-action="-1">
              <a href="javascript:void(0);">
                <span class="glyphicon glyphicon-menu-left"></span> <?=Yii::t('app','Prev')?>
              </a>
          </span>
          
            <span class="text"><?=Yii::t('app','Day')?> <?= $itinerary['day'] ?>/<?= count($itinerary_info) ?></span><span class="bt-pager next <?= $j==(count($itinerary_info)-1)?'disabled':'' ?>" data-current="<?= $j ?>" data-action="1">
              <a href="javascript:void(0);">
                <?=Yii::t('app','Next')?> <span class="glyphicon glyphicon-menu-right"></span>
              </a>
          </span>
          
            <div style="margin-top: 3px"><?= $itinerary['cities_name'] ?></div>
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
          </div>

        <?php } ?>


      </div>

      <?php } ?>
    </div>


    <div class="inclusion col-lg-12 col-md-12 col-sm-12 col-xs-12">
	    <div class="col-lg-12">
        	<div class="strike">
				<h2>
					<?=Yii::t('app',"What's Included")?>
        		</h2>
    		</div>
    	</div>
		
		<div class="clear"></div>
        
        <div class="overview">
        	<?= $tour_info['inclusion'] ?>
        </div>
    </div>

    <div class="exclusion col-lg-12 col-md-12 col-sm-12 col-xs-12">
    	<div class="col-lg-12">
        	<div class="strike">
				<h2>
					<?=Yii::t('app',"What's Not Included")?>
        		</h2>
      		</div>
    	</div>
		
		<div class="clear"></div>
        
        <div class="overview">
        	<?= $tour_info['exclusion'] ?>
        </div>
    </div>

    <div class="tips col-lg-12 col-md-12 col-sm-12 col-xs-12">
    	<div class="col-lg-12">
        	<div class="strike">
				<h2>
					<?=Yii::t('app',"Notes")?>
        		</h2>
			</div>
    	</div>
		
		<div class="clear"></div>
        
        <div class="overview">
        	<?= $tour_info['tips'] ?>
        </div>
    </div>
    
    <?= $this->render('/layouts/_share_icon_links', [
  'title_image_url' => Yii::$app->params['uploads_url'] . UploadedFiles::getSize($tour_info['pic_title'], 'l'),
]) ?>
  </div>

  <div class="form-info small-group-tour-form col-lg-4 col-md-12 col-sm-12 col-xs-12" style="margin-top: 15px">
    <div class="clearfix"></div> 
    <div class="form-info-create group-view">
      <span class="placeholder" id="inquiry-form"></span>

      <h2 class="small-group-tour">Inquiry Form</h2>
      <div class="tips"><?= $tour_info['code'] ?></div>
      <?= $this->render('/form-info/_form', [
          'model' => new common\models\FormInfo(FORM_TYPE_GROUP),
          'form_type' => FORM_TYPE_GROUP,
          'tour_code' => $tour_info['code'],
          'tour_name' => $tour_info['name'],
          'tour_id'   => $tour_info['id'],
          'bt_submit_txt' => Yii::t('app', 'Submit') ,
      ]) ?>

      <div class="form-info-bottom"><?=Yii::t('app','We will respond to your inquiry by email within one working day')?></div>
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