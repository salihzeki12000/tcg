<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\UploadedFiles;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $model common\models\city */

$this->title = $city_info['name'];
$this->description = Html::encode(\common\models\Tools::limit_words(strip_tags($city_info['introduction']), 30)) . '…';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Destinations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url'=>Url::toRoute(['destination/view', 'name'=>$city_info['name']])];
$this->params['breadcrumbs'][] = Yii::t('app','Activities');
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

            <?php foreach ($activities as $activity) { ?>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="<?= Url::toRoute(['activity/view', 'name'=>$activity['name']]) ?>">
                    <img class="img-responsive" src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($activity['pic_s'], 's')?>" alt="<?=  $activity['name'] ?>">
                    <div class="carousel-caption s-text">
                        <h3><?= $activity['name'] ?></h3>
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