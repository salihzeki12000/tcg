<?php
use common\models\UploadedFiles;
use yii\helpers\Url;
use yii\helpers\Html
;/* @var $this yii\web\View */

$this->title = 'The China Guide';
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
        We create private, customized China tours. With our Western-style travel sense and passion for Chinese culture and history, let us send you on a journey you will never forget.
    </div>

    <div class="container home-whyus">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="col-lg-6 col-md-6 col-xs-6">
                    <i class="icon-whyus-service"></i>
                    <center>SERVICE</center>
                    <span>Our multilingual team of native speakers is there for you 24/7, from your first enquiry to the end of your trip</span>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-6">
                    <i class="icon-whyus-expertise"></i>
                    <center>EXPERTISE</center>
                    <span>With over ten years of trip planning across 40 destinations under our belts, we are China experts</span>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="col-lg-6 col-md-6 col-xs-6">
                    <i class="icon-whyus-flexibility"></i>
                    <center>FLEXIBILITY</center>
                    <span>We know that no two travel experiences are the same. Let us customize your perfect trip</span>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-6">
                    <i class="icon-whyus-quality"></i>
                    <center>QUALITY</center>
                    <span>A stress-free travel experience so you can concentrate on the most important part of your tour: you</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container home-btn">
        <div class="row btn-row">
            <a type="button" class="btn btn-danger col-lg-3 col-md-4 col-xs-10" href="<?= Url::toRoute(['experience/index']) .  '#form-info-page' ?>">LET'S PLAN YOUR TRIP</a>
            
        </div>
    </div>

    <div id="carousel-ads-generic" class="carousel slide" data-ride="carousel">
      <!-- Wrapper for ads -->
      <div class="carousel-inner" style="margin-bottom: 22px;">
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

    <div class="container home-categories">
        <div class="col-lg-12">
            <h1 class="page-header">TOURS BY CATEGORIES</h1>
        </div>
        <div class="list-group">
            <a class="col-lg-4 col-md-6 col-xs-12 list-group-item" href="<?= Url::toRoute(['experience/index', 'theme'=>Yii::$app->params['tour_themes'][TOUR_THEMES_MOST_POPULAR]]) ?>">
                <i class="icon icon-mostpopular"></i>
                <span>Most Popular</span>
                <i class="glyphicon glyphicon-chevron-right pull-right" /></i>
            </a>
            <a class="col-lg-4 col-md-6 col-xs-12 list-group-item" href="<?= Url::toRoute(['experience/index', 'theme'=>Yii::$app->params['tour_themes'][TOUR_THEMES_FAMILY]]) ?>">
                <i class="icon icon-familyvacation"></i>
                <span>Family Vacation</span>
                <i class="glyphicon glyphicon-chevron-right pull-right" /></i>
            </a>
            <a class="col-lg-4 col-md-6 col-xs-12 list-group-item" href="<?= Url::toRoute(['experience/index', 'theme'=>Yii::$app->params['tour_themes'][TOUR_THEMES_CULTURE]]) ?>">
                <i class="icon icon-culture"></i>
                <span>Chinese Culture</span>
                <i class="glyphicon glyphicon-chevron-right pull-right" /></i>
            </a>
            <a class="col-lg-4 col-md-6 col-xs-12 list-group-item" href="<?= Url::toRoute(['experience/index', 'theme'=>Yii::$app->params['tour_themes'][TOUR_THEMES_ADVENTUROUS]]) ?>">
                <i class="icon icon-adventurous"></i>
                <span>Adventurous</span>
                <i class="glyphicon glyphicon-chevron-right pull-right" /></i>
            </a>
            <a class="col-lg-4 col-md-6 col-xs-12 list-group-item" href="<?= Url::toRoute(['experience/index', 'theme'=>Yii::$app->params['tour_themes'][TOUR_THEMES_FOODIE]]) ?>">
                <i class="icon icon-foodie"></i>
                <span>Foodie</span>
                <i class="glyphicon glyphicon-chevron-right pull-right" /></i>
            </a>
            <a class="col-lg-4 col-md-6 col-xs-12 list-group-item" href="<?= Url::toRoute(['experience/index', 'theme'=>Yii::$app->params['tour_themes'][TOUR_THEMES_AT_A_GLANCE]]) ?>">
                <i class="icon icon-ataglance"></i>
                <span>At a Glance</span>
                <i class="glyphicon glyphicon-chevron-right pull-right" /></i>
            </a>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">POPULAR CITY TOURS</h1>
            </div>

            <?php foreach ($cities_tour as $city_tour) { ?>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="<?= Url::toRoute(['destination/experiences', 'name'=>$city_tour['name']]) ?>">
                    <img class="img-responsive" src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($city_tour['pic_s'], 's')?>" alt="<?=  $city_tour['name'] ?>">
                    <div class="carousel-caption">
                        <h3><?= $city_tour['name'] ?> Tour</h3>
                    </div>
                </a>
            </div>
            <?php } ?>

        </div>
    </div>

    <div class="container clients-saying">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">WHAT OUR CLIENTS ARE SAYING</h1>
            </div>
            <div class="col-lg-7 col-md-8 col-xs-12">
                <em>"This is the way to see China."</em>
                <div>Mark D@Tripadvisor</div>
                <em>"5 star service from beginning to end."</em>
                <div>MJMaher@Tripadvisor</div>
            </div>
            <div class="col-lg-5 col-md-4 col-xs-12">
                <center>
                    <?= Html::img('@web/statics/images/TripAdvisor-Award.png', ['alt'=>'TripAdvisor Award', 'class'=>"col-lg-6 col-md-8 col-sm-6 col-xs-8"]) ?>
                </center>
            </div>
        </div>
    </div>

    <div class="container home-btn">
        <div class="row btn-row">
            <a type="button" class="btn btn-mine col-lg-3 col-md-4 col-xs-10" href="https://www.tripadvisor.com/Attraction_Review-g294212-d2658278-Reviews-The_China_Guide-Beijing.html" target="_blank">More  reviews on Tripadvisor</a>
        </div>
    </div>


    <div class="container index-faq">
        <div class="list-group faq">
            <a href="<?= Url::toRoute(['faq/index']) ?>" class="list-group-item"><center><h2>FAQ</h2></center></a>
            <?php foreach ($faq as $item) { ?>
            <a href="<?= Url::toRoute(['faq/view', 'title'=>$item['title']]) ?>" class="list-group-item col-lg-6 col-md-6 col-xs-12">
                <i class="glyphicon glyphicon-chevron-right pull-right" /></i>
                <span><?= $item['title'] ?></span>
            </a>
            <?php } ?>
        </div>
    </div>


    <div class="container">
        <div class="list-group article">
            <a href="<?= Url::toRoute(['article/index']) ?>" class="list-group-item"><center><h2>BLOGS</h2></center></a>
            <?php foreach ($articles as $article) { ?>
            <a class="col-md-6 list-group-item" href="<?= Url::toRoute(['article/view', 'title'=>$article['title']]) ?>">
                <div class="media">
                  <div class="media-left">
                      <img width="100px" class="media-object" src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($article['pic_s'], 's')?>" alt="<?= $article['title'] ?>">
                  </div>
                  <div class="media-body">
                    <h4 class="media-heading"><?= $article['title'] ?></h4>
                    Posted on <?= date('d F, Y', strtotime($article['create_time'])) ?>
                  </div>
                </div>
            </a>
            <?php } ?>
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