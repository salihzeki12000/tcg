<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\Cities;
use common\models\UploadedFiles;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TourSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Experiences');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tour-index container">

    <div class="row">

        <div class="col-lg-12">
            <h1 class="page-header">Popular City Tours</h1>
        </div>

        <?php foreach ($tours as $tour) { ?>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 thumb">
            <div class="thumbnail">
                <img class="img-responsive" src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($tour['pic_title'], 's')?>" alt="<?=  $tour['name'] ?>">
                <div class="carousel-caption">
                    <span>From $<?= $tour['price_usd'] ?> USD</span>
                </div>
                <div class="caption">
                    <p class="list-info"><?= ($tour['tour_length']==intval($tour['tour_length']))?intval($tour['tour_length']):$tour['tour_length'] ?> Days | <?= $tour['cities_count'] ?> Cities | <?= $tour['exp_num'] ?> Experiences</p>
                    <h3><?= $tour['name'] ?></h3>
                </div>
            </div>
        </div>
        <?php } ?>

    </div>

</div>
