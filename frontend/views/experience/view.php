<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\UploadedFiles;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Tour */

$this->title = ($tour_info['title'] == '') ? ((($tour_info['tour_length']==intval($tour_info['tour_length']))?intval($tour_info['tour_length']):$tour_info['tour_length']) . '-' . Yii::t('app','Day') . ' ' . $tour_info['display_cities']. ' Tour - ' . $tour_info['name']) : $tour_info['title'];

$this->description = ($tour_info['description'] == '') ? ((($tour_info['tour_length']==intval($tour_info['tour_length']))?intval($tour_info['tour_length']):$tour_info['tour_length']) . ' ' . (($tour_info['tour_length']>1)?Yii::t('app','Days'):Yii::t('app','Day')) . ', ' . $tour_info['cities_count'] . ' ' . (($tour_info['cities_count']>1)?Yii::t('app','Destinations'):Yii::t('app','Destination')) . ', ' . $tour_info['exp_num'] . ' ' . (($tour_info['exp_num']>1)?Yii::t('app','Experiences'):Yii::t('app','Experience')) . '; '
  . $tour_info['display_cities'] . ' ' . Yii::t('app','tour') . '; ' . Yii::t('app','private guide') . ', ' . Yii::t('app','driver & vehicle'). '; ') : $tour_info['description'];
  
$this->keywords = Html::encode($tour_info['keywords']);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Experiences'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $tour_info['name'];
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

    <?php if ($tour_info['price_cny']) { ?>
      <div class="price col-lg-12 col-md-12 col-sm-12 col-xs-12">
           <?= Yii::t('app','from') ?> <span><?= Yii::$app->params['currency_name'][Yii::$app->params['currency']]['sign'] ?><?= number_format(common\models\ExchangeUsd::convertCurrency(Yii::$app->params['currency'], $tour_info['price_cny']),0) ?></span> <?= Yii::$app->params['currency_name'][Yii::$app->params['currency']]['name'] ?>
      </div>
    <?php } ?>

    <div class="home-btn col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="btn-row">
        <a type="button" class="btn btn-danger col-lg-6 col-md-4 col-xs-10" href="#inquiry-form"><?=Yii::t('app',"GET A FREE QUOTATION")?></a>
      </div>
    </div>

    <div class="container-overview col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="col-lg-12">
          <div class="strike">
        <h2>
          <?=Yii::t('app','Trip Summary')?>
          </h2>
      </div>
    </div>
        <div class="list-group">
            <?php
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
        <div class="overview" id="overview-body">
          <?= $tour_info['overview'] ?>
        </div>
        <center><a href="#nav-overview" id="bt_overview_more">Read More<br><i class="glyphicon glyphicon-chevron-down"></i></a></center>
    </div>

    <div class="map itinerary-swipe col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="col-lg-12">
          <div class="strike">
        <h2>
          <?=Yii::t('app','Recommended Itinerary')?>
          </h2>
      </div>
    </div>
        <div class="col-lg-12 col-md-12 col-xs-12 list-group-item">
            <img src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($tour_info['pic_map'], Yii::$app->params['is_mobile']?'m':'l')?>" alt="<?=  $tour_info['name'].' Map' ?>" class="img-responsive" />
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
          
            <div><?= $itinerary['cities_name'] ?></div>
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


<div class="row">
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
</div>

 
  <?= $this->render('/layouts/_share_icon_links', [
      'title_image_url' => Yii::$app->params['uploads_url'] . UploadedFiles::getSize($tour_info['pic_title'], 'l'),
    ]) ?>

  <!-- hack to make form narrower on larger screens -->
  <div class="col-lg-1 col-md-1 col-sm-1"></div>
  
    <div class="form-info col-lg-10 col-md-10 col-sm-10 col-xs-12">
      <div class="clearfix"></div> 
      <div class="form-info-create">
        <span class="placeholder" id="inquiry-form"></span>
        <h2><?=Yii::t('app',"Inquiry Form")?></h2>
        <div class="tips"><?= $tour_info['name'] ?> - <?= $tour_info['code'] ?></div>
        <?= $this->render('/form-info/_form', [
            'model' => new common\models\FormInfo(FORM_TYPE_QUOTATION),
            'form_type' => FORM_TYPE_QUOTATION,
            'tour_code' => $tour_info['code'],
            'tour_name' => $tour_info['name'],
            'tour_id'   => $tour_info['id'],
        ]) ?>

        <div class="form-info-bottom"><?=Yii::t('app','We will respond to your inquiry by email within one working day')?></div>
      </div>
    </div>
  </div>
  
  <!-- hack to make form narrower on larger screens -->
  <div class="col-lg-1 col-md-1 col-sm-1"></div>

  <?php /* if (!Yii::$app->params['is_mobile']) { */ ?>
    <?= $this->render('/layouts/_exp-right', [
        'tours' => $tours,
        'exp_title' => Yii::t('app','You May Also Like'),
    ]) ?>
  <?php /* } */ ?>

</div>

<?= $this->render('/layouts/_tawk_script', []) ?>

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

    var overview_height = 200;
    $(function(){
        overview_height = $('#overview-body').height();
        $('#overview-body').height(200);
    });
    $('#bt_overview_more').click(function(){
      if($('#bt_overview_more').html().indexOf("More")>=0)
      {
        $('#overview-body').height(overview_height);
        $('#bt_overview_more').html('<i class="glyphicon glyphicon-chevron-up"></i><br>Show Less');
      }
      else
      {
        $('#overview-body').height(200);
        $('#bt_overview_more').html('Read More<br><i class="glyphicon glyphicon-chevron-down"></i>');
      }
    });

JS;
$this->registerJs($js);

if (Yii::$app->params['is_mobile']) {
$js = <<<JS
    $('.itinerary-swipe').hammer().on('swiperight', function(){  
        itinerarysPaging(-1);  
    }); 
    $('.itinerary-swipe').hammer().on('swipeleft', function(){  
        itinerarysPaging(1);  
    }); 
JS;
$this->registerJs($js);
}
?>
