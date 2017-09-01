<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\UploadedFiles;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $model common\models\city */

$this->title = Yii::t('app','Tourist Activities') . ' - ' . $city_info['name'] . ' ' . Yii::t('app','Travel Guide');
// $this->description = $city_info['name'] . ' ' . Yii::t('app', ' tourist activities') . ':';
$this->keywords = $city_info['name'] . ' ' . Yii::t('app','travel guide, tourist activities');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Destinations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url'=>Url::toRoute(['destination/view', 'url_id'=>$city_info['url_id']])];
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
                <a class="thumbnail" href="<?= Url::toRoute(['activity/view', 'url_id'=>$activity['url_id']]) ?>">
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

<div class="form-info container">
  <h2><?=Yii::t('app',"Customize a tour that includes a visit to this destination.")?></h2>
  <div class="form-info-create col-lg-8 col-md-8 col-xs-12">
    <span class="placeholder" id="inquiry-form"></span>
    <div class="form-title"><?=Yii::t('app','Customization Form')?></div>

    <?= $this->render('/form-info/_form', [
        'model' => new common\models\FormInfo(FORM_TYPE_CUSTOM),
        'form_type' => FORM_TYPE_CUSTOM,
        'tour_code' => '',
        'tour_name' => '',
        'current_city_name' => $city_info['name'],
    ]) ?>

    <div class="form-info-bottom"><?=Yii::t('app','We will get back to you by email within 24 hours.')?></div>
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