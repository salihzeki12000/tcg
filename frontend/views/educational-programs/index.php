<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\Cities;
use common\models\UploadedFiles;
use yii\widgets\LinkPager;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TourSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'About us');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
  <div class="row">
    <div class="cities-banner hidden-md hidden-lg">
      <div class="banner-text">EDUCATIONAL PROGRAMS</div>
      <?= Html::img('@web/statics/images/educationalprograms-bg.jpg', ['alt'=>'About us', 'width'=>"100%"]) ?>
    </div>
    <div class="cities-banner hidden-xs hidden-sm">
      <h2 class="banner-text-d">EDUCATIONAL PROGRAMS</h2>
    </div>
  </div>
</div>

<div class="container home-btn">
  <div class="row btn-row">
    <a type="button" class="btn btn-danger col-lg-3 col-md-4 col-xs-10" href="#form-info-page">Plan An Educational Trip</a>
  </div>
</div>

<div class="article-view">

    <div class="container">
        <div class="overview">
          <?= $article['content'] ?>
        </div>
    </div>

</div>

<div class="form-info container" id="form-info-page">
  <div class="form-info-create">

    <div class="form-title">Information Form</div>

    <?= $this->render('/form-info/_form', [
        'model' => new common\models\FormInfo(FORM_TYPE_EDU),
        'form_type' => FORM_TYPE_EDU,
        'tour_code' => '',
        'tour_name' => '',
    ]) ?>

    <div class="form-info-bottom">We respond your inquiry by email within 24 hours.</div>
  </div>
</div>


<?php
$js = <<<JS

JS;
$this->registerJs($js);
?>