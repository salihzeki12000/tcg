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

$this->title = Yii::t('app', 'Student and Educational Tours to China');
$this->description = Yii::t('app', 'With more than 10 years of experience organizing student tours, The China Guide produces educational programs that are fruitful, engaging, and exciting');
$this->keywords = Yii::t('app', 'Student tours to China, faculty-led program, academic program');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="title-bar">
  <div class="row">
    <div class="cities-banner">
      <h1 class="banner-text"><?=Yii::t('app','Educational Programs')?><br><small><?=Yii::t('app','CUSTOMIZED STUDENT PROGRAM PLANNING SERVICES')?></small></h1>
      
      <?= Html::img('@web/statics/images/educationalprograms-bg' . ((Yii::$app->params['is_mobile'])?'':'-pc') . '.jpg', ['alt'=>Yii::t('app','About us'), 'width'=>"100%"]) ?>
    </div>
  </div>
</div>

<div class="page-view container">

    <div class="full-text col-lg-9 col-md-10">
        <div class="overview">
          <?= $article['content'] ?>
        </div>
    </div>

</div>

<div class="form-info container">
  <div class="form-info-create col-lg-8 col-md-8 col-xs-12">
    <span class="placeholder" id="inquiry-form"></span>
    <h2><?=Yii::t('app',"Inquiry Form")?></h2>
    <?= $this->render('/form-info/_form', [
        'model' => new common\models\FormInfo(FORM_TYPE_EDU),
        'form_type' => FORM_TYPE_EDU,
        'tour_code' => '',
        'tour_name' => '',
    ]) ?>

    <div class="form-info-bottom"><?=Yii::t('app','We will respond to your inquiry by email within one working day')?></div>
  </div>
</div>


<?php
$js = <<<JS

JS;
$this->registerJs($js);
?>