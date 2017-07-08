<?php
use common\models\UploadedFiles;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */

$this->title = Yii::t('app','Private China Tours | China Travel Agency');
$this->description = Yii::t('app','The China Guide, a Beijing-based travel agency run by a multilingual team of native speakers, creates private China tours & travel customization services');
$this->keywords = Yii::t('app','China tours, China private tours, China family tours, customize China tours, China travel, China travel guide, China guide, China travel tips, China travel blog, China travel agency');
?>
<div class="site-index">

    <?php if(false && !Yii::$app->params['is_mobile']) { ?>
    <div class="slide-video">
        <video width="100%" loop=1 autoplay=1 poster="https://www.thechinaguide.com/uploads/201702/23/58aee9ea9a2fe.jpg">
          <source src="/statics/videos/tcg_2017.3gp">
          Your browser doesn't support HTML5 video tag.
        </video>
        <div class="carousel-caption">
            <h3></h3>
            <span></span>
        </div>
    </div>

    <?php }else{ ?>

    <div id="carousel-slides-generic" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <?php for($i=0; $i<count($slides); $i++) { ?>
            <li data-target="#carousel-slides-generic" data-slide-to="<?= $i ?>" <?= ($i==0)? 'class="active"' : '' ?> ></li>
        <?php } ?>
      </ol>
      <!-- Wrapper for slides -->
      <div class="carousel-inner full-w">
        <?php for($i=0; $i<count($slides); $i++) {
            $slide=$slides[$i];
            $pic_type = 'l';
            if (Yii::$app->params['is_mobile']) {
                $pic_type = 'mob';
            }
        ?>
            <a class="item <?= ($i==0)? 'active' : '' ?> " href="<?= $slide['url'] ?>">
              <img src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($slide['pic_s'], $pic_type)?>" alt="<?=  $slide['title'] ?>">
              <div class="carousel-caption">
                <h3><?= $slide['title'] ?></h3>
                <span><?= $slide['description']?></span>
              </div>
            </a>
        <?php } ?>
      </div>
      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-slides-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
      </a>
      <a class="right carousel-control" href="#carousel-slides-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
      </a>

    <a  id="bt-show-video" class="video_preview" href="javascript:void(0);"  data-toggle="modal" data-target="#video-modal">
        <span class="preview_img">
            <img src="/statics/images/company-video-icon.jpg">
            <span></span>
        </span>
        <!-- <span class="preview_text vert_centre">See highlights of this destination<br></span> -->
    </a>
    </div> <!-- Carousel -->
    <?php } ?>

<?php 

Modal::begin([
    'id' => 'video-modal',
    'header' => '<h4 class="modal-title">Visit China: Enchanting Land of Contrasts | The China Guide
</h4>',
    'footer' => '',
    'size' => "modal-lg",
]); 
Modal::end();
?>

    <h1 class="container home-desc col-lg-9 col-md-10 col-sm-6 col-xs-12">
        <?=Yii::t('app','We are a Beijing-based travel agency that creates private, guided tours and travel customization services all over China. With our Western-style travel sense and passion for Chinese culture and history, let us send you on a journey you will never forget.')?>
    </h1>

    <div class="container home-whyus">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="col-lg-6 col-md-6 col-xs-6">
                    <i class="icon-whyus-service"></i>
                    <center><?=Yii::t('app','SERVICE')?></center>
                    <span><?=Yii::t('app','Our multilingual team of native speakers is there for you 24/7, from your first enquiry to the end of your trip')?></span>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-6">
                    <i class="icon-whyus-expertise"></i>
                    <center><?=Yii::t('app','EXPERTISE')?></center>
                    <span><?=Yii::t('app','With over ten years of trip planning across 40 destinations under our belts, we are China experts')?></span>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="col-lg-6 col-md-6 col-xs-6">
                    <i class="icon-whyus-flexibility"></i>
                    <center><?=Yii::t('app','FLEXIBILITY')?></center>
                    <span><?=Yii::t('app','We know that no two travel experiences are the same. Let us customize your perfect trip')?></span>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-6">
                    <i class="icon-whyus-quality"></i>
                    <center><?=Yii::t('app','QUALITY')?></center>
                    <span><?=Yii::t('app','A stress-free travel experience so you can concentrate on the most important part of your tour: you')?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="container home-btn">
        <div class="row btn-row">
            <a type="button" class="btn btn-danger col-lg-3 col-md-4 col-xs-10" href="<?= Url::toRoute(['experience/index']) .  '#inquiry-form' ?>"><?=Yii::t('app',"LET'S PLAN YOUR TRIP")?></a>
            
        </div>
    </div>

    <?php if (0<count($ads)) { ?>
    <div id="carousel-ads-generic" class="carousel slide" data-ride="carousel" style="margin-bottom: 30px;">
      <!-- Wrapper for ads -->
      <div class="carousel-inner">
        <?php for($i=0; $i<count($ads); $i++) {
            $ad=$ads[$i];
            $pic_type = 'l';
            if (Yii::$app->params['is_mobile']) {
                $pic_type = 'm';
            }
        ?>
            <a class="item <?= ($i==0)? 'active' : '' ?> " href="<?= $ad['url'] ?>">
              <img src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($ad['pic_s'], $pic_type)?>" alt="<?=  $ad['title'] ?>">
            </a>
        <?php } ?>
      </div>
    </div> <!-- Carousel -->
    <?php } ?>

    <div class="tour-index container">
        <div class="col-lg-12">
            <h1 class="page-header" style="margin-bottom: 0;margin-top: 10px;padding-bottom: 0px"><?=Yii::t('app','MOST POPULAR TOURS')?></h1>
        </div>
        <div class=" file-drop-zone"> 
         <div class="file-preview-thumbnails">
          <div class="file-initial-thumbs row">

          <?php foreach ($tours as $tour) { ?>

           <div class="file-preview-frame file-preview-initial col-lg-4 col-md-4 col-sm-6 col-xs-12" >
            <a class="kv-file-content" href="<?= Url::toRoute(['experience/view', 'url_id'=>$tour['url_id']]) ?>"> 
             <img src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($tour['pic_title'], 's')?>" alt="<?=  $tour['name'] ?>" class="kv-preview-data file-preview-image" /> 
            </a>
            <div class="file-thumbnail-footer"> 
             <div class="file-footer-caption">
                <div class="content-press"><span><?= ($tour['tour_length']==intval($tour['tour_length']))?intval($tour['tour_length']):$tour['tour_length'] ?></span> <?=($tour['tour_length']>1)?Yii::t('app','Days'):Yii::t('app','Day')?> | <span><?= $tour['cities_count'] ?></span> <?=($tour['cities_count']>1)?Yii::t('app','Destinations'):Yii::t('app','Destination')?> | <span><?= $tour['exp_num'] ?></span> <?=($tour['exp_num']>1)?Yii::t('app','Experiences'):Yii::t('app','Experience')?></div>
                <h2><a href="<?= Url::toRoute(['experience/view', 'url_id'=>$tour['url_id']]) ?>"><?= $tour['name'] ?></a></h2>
                <div class="tourlist-desc"><a href="<?= Url::toRoute(['experience/view', 'url_id'=>$tour['url_id']]) ?>"><?= Html::encode(\common\models\Tools::wordcut(strip_tags($tour['overview']), 120)) ?></a></div>
                <div class="tourlist-price">
                  <?php if(!empty($tour['price_cny'])) { ?>
                    From <span><?= Yii::$app->params['currency_name'][Yii::$app->params['currency']]['sign'] ?><?= number_format(common\models\ExchangeUsd::convertCurrency(Yii::$app->params['currency'], $tour['price_cny']),0) ?></span> <?= Yii::$app->params['currency_name'][Yii::$app->params['currency']]['name'] ?>
                  <? }else{ ?>
                        <span>&nbsp;<span>
                  <?php } ?>
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

    <div class="container home-categories">
        <div class="col-lg-12">
            <h1 class="page-header"><?=Yii::t('app','TOURS BY CATEGORY')?></h1>
        </div>
        <div class="list-group">
            <?php foreach ($themes as $theme) {  
                if (empty($theme['class_name'])) {
                    continue;
                }
            ?>
                <a class="col-lg-4 col-md-6 col-xs-12 list-group-item" href="<?= Url::toRoute(['experience/index', 'theme'=>$theme['url_id']]) ?>">
                    <i class="icon <?= $theme['class_name'] ?>"></i>
                    <span><?= $theme['name'] ?></span>
                    <i class="glyphicon glyphicon-chevron-right pull-right" /></i>
                </a>
            <?php } ?>

        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" style="margin: 38px 0 20px 0;"><?=Yii::t('app','POPULAR TRAVEL DESTINATIONS')?></h1>
            </div>
        </div>
    </div>

    <div class="map-container row">
        <div class="index-map col-lg-4 col-md-6 col-sm-6 col-xs-12 map-view">
            <div class="map-div">
                <?= Html::img('@web/statics/images/china-map.png', ['alt'=>'China Map', 'width'=>'100%']) ?>

                <a href="javascript:void(0);" class="map-poi map-poi-lasa" id="map-poi-lasa" data-cid="7">
                    <i class="glyphicon glyphicon-map-marker"></i>
                    <span class="map-span">Tibet/Lhasa</span>
                </a>
                <a href="javascript:void(0);" class="map-poi poi-right map-poi-guilin" id="map-poi-guilin" data-cid="9">
                    <i class="glyphicon glyphicon-map-marker"></i>
                    <span class="map-span">Guilin</span>
                </a>
                <a href="javascript:void(0);" class="map-poi map-poi-yangshuo" id="map-poi-yangshuo" data-cid="6">
                    <i class="glyphicon glyphicon-map-marker"></i>
                    <span class="map-span">Yangshuo</span>
                </a>
                <a href="javascript:void(0);" class="map-poi map-poi-zhangjiajie" id="map-poi-zhangjiajie" data-cid="5">
                    <i class="glyphicon glyphicon-map-marker"></i>
                    <span class="map-span">Zhangjiajie</span>
                </a>
                <a href="javascript:void(0);" class="map-poi  poi-right map-poi-shanghai" id="map-poi-shanghai" data-cid="3">
                    <i class="glyphicon glyphicon-map-marker"></i>
                    <span class="map-span">Shanghai</span>
                </a>
                <a href="javascript:void(0);" class="map-poi map-poi-xian" id="map-poi-xian" data-cid="2">
                    <i class="glyphicon glyphicon-map-marker"></i>
                    <span class="map-span">Xi'an</span>
                </a>
                <a href="javascript:void(0);" class="map-poi map-poi-beijing active" id="map-poi-beijing" data-cid="1">
                    <i class="glyphicon glyphicon-map-marker"></i>
                    <span class="map-span">Beijing</span>
                </a>
                <a href="javascript:void(0);" class="map-poi poi-right map-poi-greatwall" id="map-poi-greatwall" data-cid="20">
                    <i class="glyphicon glyphicon-map-marker"></i>
                    <span class="map-span">The Great Wall</span>
                </a>
                <a href="javascript:void(0);" class="map-poi poi-right map-poi-chengdu" id="map-poi-chengdu" data-cid="10">
                    <i class="glyphicon glyphicon-map-marker"></i>
                    <span class="map-span">Chengdu</span>
                </a>

            </div>
        </div>
        <div class="index-map col-lg-4 col-md-6 col-sm-6 col-xs-12 map-detail">
            <?php foreach ($cities_map as $city_info) { ?>
              <article class="entry teaser" id="city-map-detail-<?= $city_info['id'] ?>" <?= ($city_info['id']==1) ? '': 'style="display: none;"' ?>>
                <header class="entry-header">
                  <h2 class="entry-title" itemprop="headline">
                    <a href="<?= Url::toRoute(['destination/view', 'url_id'=>$city_info['url_id']]) ?>" rel="bookmark"><?= $city_info['name'] ?></a>
                  </h2>
                </header>
                <div class="entry-content" itemprop="text">
                  <a class="entry-image-link" href="<?= Url::toRoute(['destination/view', 'url_id'=>$city_info['url_id']]) ?>" aria-hidden="true">
                    <img style="float: right;" width="200" src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($city_info['pic_s'], 's')?>" class="post-image entry-image" alt="<?= $city_info['name'] ?>" itemprop="image">
                    <p><?= Html::encode(\common\models\Tools::wordcut(strip_tags($city_info['introduction']), 330)) ?></p>
                  </a>
                </div>
                <p class="entry-meta">
                  <time class="entry-time" itemprop="datePublished" datetime="">&nbsp;</time>
                </p>
              </article>
            <?php } ?>
        </div>
    </div>


    <div class="container clients-saying">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?=Yii::t('app','WHAT OUR CLIENTS ARE SAYING')?></h1>
            </div>
            <div class="col-lg-7 col-md-8 col-xs-12">
                <em><?=Yii::t('app','"This is the way to see China."')?></em>
                <div><?=Yii::t('app','Mark D@Tripadvisor')?></div>
                <em><?=Yii::t('app','"5 star service from beginning to end."')?></em>
                <div><?=Yii::t('app','MJMaher@Tripadvisor')?></div>
            </div>
            <div class="col-lg-5 col-md-4 col-xs-12">
                <?= Html::img('@web/statics/images/TripAdvisor-Award.png', ['alt'=>'TripAdvisor Award', 'class'=>"col-lg-6 col-md-8 col-sm-6 col-xs-8"]) ?>
            </div>
        </div>
    </div>

    <div class="container home-btn">
        <div class="row btn-row">
            <a type="button" class="btn btn-mine col-lg-3 col-md-4 col-xs-10" href="https://www.tripadvisor.com/Attraction_Review-g294212-d2658278-Reviews-The_China_Guide-Beijing.html" target="_blank"><?=Yii::t('app','More  reviews on Tripadvisor')?></a>
        </div>
    </div>


    <div class="container index-faq col-lg-6">
        <div class="list-group faq">
            <a href="<?= Url::toRoute(['preparation/index']) ?>" class="list-group-item"><center><h2><?=Yii::t('app','PREPARATION')?></h2></center></a>
            <?php foreach ($faq as $item) { ?>
            <a href="<?= Url::toRoute(['preparation/view', 'url_id'=>$item['url_id']]) ?>" class="list-group-item col-lg-12 col-md-6 col-xs-12">
                <i class="glyphicon glyphicon-chevron-right pull-right" /></i>
                <span><?= $item['title'] ?></span>
            </a>
            <?php } ?>
        </div>
    </div>


    <div class="container index-article col-lg-6 blog">
        <?php foreach ($articles as $article) { ?>
          <article class="entry teaser first">
            <header class="entry-header">
              <h2 class="entry-title" itemprop="headline">
                <a href="<?= Url::toRoute(['article/view', 'url_id'=>$article['url_id']]) ?>" rel="bookmark"><?= $article['title'] ?></a>
              </h2>
            </header>
            <div class="entry-content" itemprop="text">
              <a class="entry-image-link" href="<?= Url::toRoute(['article/view', 'url_id'=>$article['url_id']]) ?>" aria-hidden="true">
                <img width="335" height="200" src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($article['pic_s'], 's')?>" class="alignright post-image entry-image" alt="<?= $article['title'] ?>" itemprop="image">
              </a>
              <p><?= Html::encode(\common\models\Tools::wordcut(strip_tags($article['content']), 240)) ?></p>
            </div>
            <a href="<?= Url::toRoute(['article/index']) ?>" class="btn btn-info pull-right btn-sm more-link" title="<?=Yii::t('app','More Blogs')?>" style="background-color: #B33635;"><?=Yii::t('app','More Blogs')?></a>
            <p class="entry-meta">
              <time class="entry-time" itemprop="datePublished" datetime="<?= date(DATE_ATOM, strtotime($article['create_time'])) ?>"><?= date('F d, Y', strtotime($article['create_time'])) ?></time>
            </p>
          </article>
        <?php } ?>
    </div>

    <div class="container clearfix">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" style="margin-top: 10px;margin-bottom: 0px;"><?=Yii::t('app','FEATURED IN')?></h1>
            </div>
            <div id="featured-in-container">
                <a class="the-guardian" href="https://www.theguardian.com/travel/2012/aug/24/best-accessible-disabled-holidays" target="_blank"></a>
                <a class="cnn-travel" href="http://travel.cnn.com/explorations/play/asias-most-bike-friendly-cities-982373/" target="_blank"></a>
                <a class="ted-ed" href="http://ed.ted.com/on/oCg0iCyT#digdeeper" target="_blank"></a>
                <a class="fodors-travel" href="javascript:void(0);" style="cursor: default" target="_blank"></a>
                <a class="treasure-leasure" href="http://www.travelandleisure.com/attractions/great-wall-of-china-sledding" target="_blank"></a>
                <a class="traveller" href="http://www.traveller.com.au/spree-de-corps-3965h" target="_blank"></a>

            </div>
        </div>
    </div>

    <div class="subscribe-bar">
        <h3 class="col-lg-6 col-md-12 col-xs-12"><?=Yii::t('app','Subscribe to Our Newsletter')?></h3>
        <form action="//thechinaguide.us11.list-manage.com/subscribe/post?u=d995462fd30382f7e33e816d0&amp;id=a0d17736bf" id="mc-embedded-subscribe-form" method="post" class="subscribe-bar-form col-lg-6 col-md-12 col-xs-12">
          <div class="subscribe-bar-input">
            <input type="text" id="mce-EMAIL" class="form-control" name="EMAIL" placeholder="<?=Yii::t('app','Enter your email address')?>">
            <input type="submit" name="subscribe" id="mc-embedded-subscribe" value="Subscribe" class="btn btn-info btn-sm">     
          </div>
          <input type="hidden" name="b_d995462fd30382f7e33e816d0_a0d17736bf" tabindex="-1" value="">
        </form>
        <div class='subscribe-bar-desc'><?=Yii::t('app','Wanderlust-inducing content and insider tips from our China travel experts
')?></div>
    </div>


</div>

<?= $this->render('/layouts/_tawk_script', []) ?>

<?php
$requestUrl = $requestUrl = Url::toRoute('site/video');
$js = <<<JS
        $('.map-poi').click(function(){
            if(!$(this).hasClass('active'))
            {
                $('.map-poi').removeClass('active');
                $(this).addClass('active');
                var city_id = $(this).attr('data-cid');
                $('.map-detail article').hide();
                $('#city-map-detail-'+city_id).show();
            }
        });

    $(document).on('click', '#bt-show-video', function () {
        $.get('{$requestUrl}', {},
            function (data) {
                $('.modal-body').html(data);
            }  
        );
    });
    $('#video-modal').on('hidden.bs.modal', function () {
        $('.modal-body').html('');
    });
JS;
$this->registerJs($js);
?>