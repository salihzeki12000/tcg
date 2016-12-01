<?php
use common\models\UploadedFiles;
/* @var $this yii\web\View */

$this->title = 'The China Guide';
?>
<div class="site-index">

    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <?php for($i=0; $i<count($tours); $i++) { ?>
            <li data-target="#carousel-example-generic" data-slide-to="<?= $i ?>" <?= ($i==0)? 'class="active"' : '' ?> ></li>
        <?php } ?>
      </ol>
     
      <!-- Wrapper for slides -->
      <div class="carousel-inner">
        <?php for($i=0; $i<count($tours); $i++) {
            $tour=$tours[$i];
            $pic_type = 'l';
            if (Yii::$app->params['is_mobile']) {
                $pic_type = 'mob';
            }
        ?>
            <div class="item <?= ($i==0)? 'active' : '' ?> ">
              <img src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($tour['pic_title'], $pic_type)?>" alt="<?=  $tour['name'] ?>">
              <div class="carousel-caption">
                <h3><?= $tour['name'] ?></h3>
                <span><?= ($tour['tour_length']==intval($tour['tour_length']))?intval($tour['tour_length']):$tour['tour_length'] ?>  Days | <?= $tour['cities']?></span>
              </div>
            </div>
        <?php } ?>
      </div>
     
      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
      </a>
    </div> <!-- Carousel -->

    <div class="container">
        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">Popular City Tours</h1>
            </div>

            <?php foreach ($cities_tour as $city_tour) { ?>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#">
                    <img class="img-responsive" src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($city_tour['pic_s'], 's')?>" alt="<?=  $city_tour['name'] ?>">
                    <div class="carousel-caption">
                        <h3><?= $city_tour['name'] ?> Tour</h3>
                    </div>
                </a>
            </div>
            <?php } ?>

        </div>

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">Popular Sights</h1>
            </div>

            <?php foreach ($sights as $sight) { ?>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#">
                    <img class="img-responsive" src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($sight['pic_s'], 's')?>" alt="<?=  $sight['name'] ?>">
                    <div class="carousel-caption">
                        <h3><?= $sight['name'] ?></h3>
                    </div>
                </a>
            </div>
            <?php } ?>

        </div>
    </div>


    <div class="container">
        <div class="list-group">
            <a href="javascript:void(0);" class="list-group-item"><center><h2>FAQ</h2></center></a>
            <?php foreach ($faq as $item) { ?>
            <a href="#" class="list-group-item">
                <i class="glyphicon glyphicon-chevron-right pull-right" /></i>
                <span><?= $item['title'] ?></span>
            </a>
            <?php } ?>
        </div>
    </div>


    <div class="container">
        <div class="list-group">
            <a href="javascript:void(0);" class="list-group-item"><center><h2>Articles</h2></center></a>
            <?php foreach ($articles as $article) { ?>
            <a class="col-md-6 list-group-item" href="javascript:void(0);">
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

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">



    </div>
</div>

<?php
$js = <<<JS
    $('.carousel').carousel({
        interval: 4000
    })
JS;
$this->registerJs($js);
?>