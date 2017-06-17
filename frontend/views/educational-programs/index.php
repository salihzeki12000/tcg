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

$this->title = Yii::t('app', 'Student Trip to China');
$this->description = Yii::t('app', 'After almost 10 years of organizing student travel, The China Guide knows how to make every educational program exceptional, engaging, and exciting.');
$this->keywords = Yii::t('app', 'Educational travel, faculty-led program, academic program, China student tour, student travel to China, student tours to China');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container title-bar">
  <div class="row">
    <div class="cities-banner">
      <h1 class="banner-text"><?=Yii::t('app','EDUCATIONAL PROGRAMS')?><br><small><?=Yii::t('app','CUSTOMIZED STUDENT PROGRAM PLANNING SERVICES')?></small></h1>
      
      <?= Html::img('@web/statics/images/educationalprograms-bg' . ((Yii::$app->params['is_mobile'])?'':'-pc') . '.jpg', ['alt'=>'About us', 'width'=>"100%"]) ?>
    </div>
  </div>
</div>

<div class="container home-btn">
  <div class="row btn-row">
    <a type="button" class="btn btn-danger col-lg-3 col-md-4 col-xs-10" href="#inquiry-form"><?=Yii::t('app','Plan An Educational Trip')?></a>
  </div>
</div>

<div class="article-view container">

    <div class="full-text col-lg-9 col-md-10">
        <div class="overview">
          <?= $article['content'] ?>
        </div>
    </div>

</div>

<div class="form-info container">
  <div class="form-info-create col-lg-8 col-md-8 col-xs-12">
    <span class="placeholder" id="inquiry-form"></span>
    <div class="form-title"><?=Yii::t('app','Information Form')?></div>

    <?= $this->render('/form-info/_form', [
        'model' => new common\models\FormInfo(FORM_TYPE_EDU),
        'form_type' => FORM_TYPE_EDU,
        'tour_code' => '',
        'tour_name' => '',
    ]) ?>

    <div class="form-info-bottom"><?=Yii::t('app','We will get back to you by email within 24 hours.')?></div>
  </div>
</div>


<?php
$js = <<<JS

JS;
$this->registerJs($js);
?>