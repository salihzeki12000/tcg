<?php
use common\models\UploadedFiles;
use yii\helpers\Url;
use yii\helpers\Html
;/* @var $this yii\web\View */

$this->title = Yii::t('app','The China Guide') . ' - ' . Yii::t('app','A Beijing-based, Foreign-owned Travel Agency');
$this->description = Yii::t('app','The China Guide create private, customized China tours. With our Western-style travel sense and passion for Chinese culture and history, let us send you on a journey you will never forget.');
$this->keywords = Yii::t('app','China travel agency, China guide, China travel guide, China tours, private China tours, customized China tours, China travel FAQs, China travel blogs');
?>
<div class="site-index">

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
    </div> <!-- Carousel -->

    <div class="container home-desc">
        <?=Yii::t('app','We create private, customized China tours. With our Western-style travel sense and passion for Chinese culture and history, let us send you on a journey you will never forget.')?>
    </div>

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
            <a type="button" class="btn btn-danger col-lg-3 col-md-4 col-xs-10" href="<?= Url::toRoute(['experience/index']) .  '#form-info-page' ?>"><?=Yii::t('app',"LET'S PLAN YOUR TRIP")?></a>
            
        </div>
    </div>

    <div id="carousel-ads-generic" class="carousel slide" data-ride="carousel">
      <!-- Wrapper for ads -->
      <div class="carousel-inner">
        <?php for($i=0; $i<count($ads); $i++) {
            $ad=$ads[$i];
            $pic_type = 'l';
            if (Yii::$app->params['is_mobile']) {
                $pic_type = 'm';
            }
        ?>
            <a class="item <?= ($i==0)? 'active' : '' ?> " href="<?= $slide['url'] ?>">
              <img src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($ad['pic_s'], $pic_type)?>" alt="<?=  $ad['title'] ?>">
            </a>
        <?php } ?>
      </div>
    </div> <!-- Carousel -->

    <div class="tour-index container">
        <div class="col-lg-12">
            <h1 class="page-header" style="margin-bottom: 0;margin-top: 10px;"><?=Yii::t('app','MOST POPULAR TOURS')?></h1>
        </div>
        <div class=" file-drop-zone"> 
         <div class="file-preview-thumbnails">
          <div class="file-initial-thumbs row">

          <?php foreach ($tours as $tour) { ?>

           <div class="file-preview-frame file-preview-initial col-lg-4 col-md-6 col-xs-12" >
            <a class="kv-file-content" href="<?= Url::toRoute(['experience/view', 'name'=>$tour['name']]) ?>"> 
             <img src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($tour['pic_title'], 's')?>" alt="<?=  $tour['name'] ?>" class="kv-preview-data file-preview-image" /> 
              <div class="content-press"><span><?= ($tour['tour_length']==intval($tour['tour_length']))?intval($tour['tour_length']):$tour['tour_length'] ?></span> <?=Yii::t('app','Days')?> | <span><?= $tour['cities_count'] ?></span> <?=Yii::t('app','Cities')?> | <span><?= $tour['exp_num'] ?></span> <?=Yii::t('app','Experiences')?></div>
            </a>
            <div class="file-thumbnail-footer"> 
             <div class="file-footer-caption">
                <h3><?= $tour['name'] ?> </h3>
                <div><?= Html::encode(\common\models\Tools::wordcut(strip_tags($tour['overview']), 120)) ?></div>
                <div class="tourlist-price">
                  <?php if(!empty($tour['price_cny'])) { ?>
                    From <span><?= Yii::$app->params['currency_name'][Yii::$app->params['currency']]['sign'] ?><?= number_format(common\models\ExchangeUsd::convertCurrency(Yii::$app->params['currency'], $tour['price_cny']),0) ?></span> <?= Yii::$app->params['currency_name'][Yii::$app->params['currency']]['name'] ?>
                  <?php } ?>
                  <a type="button" class="btn btn-info pull-right btn-sm" href="<?= Url::toRoute(['experience/view', 'name'=>$tour['name']]) ?>"><?=Yii::t('app','View')?></a>
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
            <h1 class="page-header"><?=Yii::t('app','CHOOSE A THEME')?></h1>
        </div>
        <div class="list-group">
            <?php foreach ($themes as $theme) {  
                if (empty($theme['class_name'])) {
                    continue;
                }
            ?>
                <a class="col-lg-4 col-md-6 col-xs-12 list-group-item" href="<?= Url::toRoute(['experience/index', 'theme'=>$theme['name']]) ?>">
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
                <h1 class="page-header" style="margin: 38px 0;"><?=Yii::t('app','POPULAR DESTINATIONS')?></h1>
            </div>

            <?php foreach ($cities_tour as $city_tour) { ?>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="<?= Url::toRoute(['destination/view', 'name'=>$city_tour['name']]) ?>">
                    <img class="img-responsive" src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($city_tour['pic_s'], 's')?>" alt="<?=  $city_tour['name'] ?>">
                    <div class="carousel-caption">
                        <h3><?= $city_tour['name'] ?></h3>
                    </div>
                </a>
            </div>
            <?php } ?>

        </div>
    </div>

    <div class="container clients-saying">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?=Yii::t('app','WHAT OUR CLIENTS ARE SAYING')?></h1>
            </div>
            <div class="col-lg-8 col-md-8 col-xs-12">
                <em><?=Yii::t('app','"This is the way to see China."')?></em>
                <div><?=Yii::t('app','Mark D@Tripadvisor')?></div>
                <em><?=Yii::t('app','"5 star service from beginning to end."')?></em>
                <div><?=Yii::t('app','MJMaher@Tripadvisor')?></div>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-12">
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
            <a href="<?= Url::toRoute(['faq/index']) ?>" class="list-group-item"><center><h2><?=Yii::t('app','FAQ')?></h2></center></a>
            <?php foreach ($faq as $item) { ?>
            <a href="<?= Url::toRoute(['faq/view', 'title'=>$item['title']]) ?>" class="list-group-item col-lg-12 col-md-6 col-xs-12">
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
                <a href="<?= Url::toRoute(['article/view', 'title'=>$article['title']]) ?>" rel="bookmark"><?= $article['title'] ?></a>
              </h2>
            </header>
            <div class="entry-content" itemprop="text">
              <a class="entry-image-link" href="<?= Url::toRoute(['article/view', 'title'=>$article['title']]) ?>" aria-hidden="true">
                <img width="335" height="200" src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($article['pic_s'], 's')?>" class="alignright post-image entry-image" alt="<?= $article['title'] ?>" itemprop="image">
              </a>
              <p><?= Html::encode(\common\models\Tools::wordcut(strip_tags($article['content']), 275)) ?></p>
            </div>
            <a href="<?= Url::toRoute(['article/index']) ?>" class="btn btn-info pull-right btn-sm more-link" title="<?=Yii::t('app','More Blogs')?>" style="background-color: #B33635;"><?=Yii::t('app','More Blogs')?></a>
            <p class="entry-meta">
              <time class="entry-time" itemprop="datePublished" datetime="<?= date(DATE_ATOM, strtotime($article['create_time'])) ?>"><?= date('F d, Y', strtotime($article['create_time'])) ?></time>
            </p>
          </article>
        <?php } ?>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?=Yii::t('app','FEATURED IN')?></h1>
            </div>
            <div id="featured-in-container">
                <a class="the-guardian" href="https://www.theguardian.com/travel/2012/aug/24/best-accessible-disabled-holidays" target="_blank"></a>
                <a class="cnn-travel" href="http://travel.cnn.com/explorations/play/asias-most-bike-friendly-cities-982373/" target="_blank"></a>
                <a class="ted-ed" href="http://ed.ted.com/on/oCg0iCyT#digdeeper" target="_blank"></a>
                <a class="fodors-travel" href="http://www.fodors.com/world/asia/china/beijing/travel-tips/tours-2780308" target="_blank"></a>
            </div>
        </div>
    </div>
    <div class="body-content">



    </div>
</div>

<?php
$js = <<<JS

JS;
$this->registerJs($js);
?>