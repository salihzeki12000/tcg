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

$this->title = Yii::t('app', 'Customized Student Program Planning Services');
$this->description = Yii::t('app', 'After almost 10 years of experience organizing student travel, The China Guide knows how to make every program exceptional, engaging, and exciting. Each trip is filled with chances to learn, whether through person-to-person interaction, site visits, or cultural awakening.');
$this->keywords = Yii::t('app', 'student program planning, student tour, educational program, educational travel, educational trip');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container title-bar">
  <div class="row">
    <div class="cities-banner">
      <div class="banner-text"><?=Yii::t('app','EDUCATIONAL PROGRAMS')?></div>
      <?= Html::img('@web/statics/images/educationalprograms-bg' . ((Yii::$app->params['is_mobile'])?'':'-pc') . '.jpg', ['alt'=>'About us', 'width'=>"100%"]) ?>
    </div>
  </div>
</div>

<div class="container home-btn">
  <div class="row btn-row">
    <a type="button" class="btn btn-danger col-lg-3 col-md-4 col-xs-10" href="#form-info-page"><?=Yii::t('app','Plan An Educational Trip')?></a>
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
  <div class="form-info-create col-lg-8 col-md-8 col-xs-12">

    <div class="form-title"><?=Yii::t('app','Information Form')?></div>

    <?= $this->render('/form-info/_form', [
        'model' => new common\models\FormInfo(FORM_TYPE_EDU),
        'form_type' => FORM_TYPE_EDU,
        'tour_code' => '',
        'tour_name' => '',
    ]) ?>

    <div class="form-info-bottom"><?=Yii::t('app','We respond your inquiry by email within 24 hours.')?></div>
  </div>
</div>


<?php
$js = <<<JS

JS;
$this->registerJs($js);
?>