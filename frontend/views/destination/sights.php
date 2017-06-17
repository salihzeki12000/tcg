<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\UploadedFiles;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $model common\models\city */

$this->title = Yii::t('app','Tourist Sights') . ' - ' . $city_info['name'] . ' ' . Yii::t('app','Travel Guide');
// $this->description = $city_info['name'] . ' ' . Yii::t('app', ' tourist attractions') . ':';
$this->keywords = $city_info['name'] . ' ' . Yii::t('app','travel guide, tourist attractions, tourist sights');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Destinations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url'=>Url::toRoute(['destination/view', 'url_id'=>$city_info['url_id']])];
$this->params['breadcrumbs'][] = Yii::t('app','Sights');
?>

<?= $this->render('_des-header', [
    'city_info' => $city_info,
    'menu' => $menu,
]) ?>

<div class="city-view">

    <div class="container">

        <div class="row">

            <div class="col-lg-12">&nbsp;
            </div>

            <?php foreach ($sights as $sight) { ?>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="<?= Url::toRoute(['sight/view', 'url_id'=>$sight['url_id']]) ?>">
                    <img class="img-responsive" src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($sight['pic_s'], 's')?>" alt="<?=  $sight['name'] ?>">
                    <div class="carousel-caption s-text">
                        <h3><?= $sight['name'] ?></h3>
                    </div>
                </a>
            </div>
            <?php } ?>

        </div>

        <center>
        <?php
        //显示分页页码
        echo LinkPager::widget([
            'pagination' => $pages,
            'maxButtonCount' => 5,
        ])
        ?>
        </center>

    </div>

</div>

<?php
$js = <<<JS

JS;
$this->registerJs($js);

$css = <<<CSS
  .breadcrumb{
    margin-bottom: 0px;
  }
CSS;
$this->registerCss($css); 
?>