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

$this->title = Yii::t('app', 'Meetings, Incentives, Conferences, and Exhibitions');
$this->description = Yii::t('app', 'The China Guide offers comprehensive solutions for all your business travel requirements, including meetings, incentive tours, conferences, and exhibitions');
$this->keywords = Yii::t('app', 'MICE travel, incentive tours to China, China business travel');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="title-bar">
  <div class="row">
    <div class="cities-banner">
      <h1 class="banner-text"><span><?=Yii::t('app','MICE Travel')?></span></h1>
      
      <?= Html::img('@web/statics/images/mice-bg' . ((Yii::$app->params['is_mobile'])?'':'-pc') . '.jpg', ['alt'=>'About us', 'width'=>"100%"]) ?>
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
        'model' => new common\models\FormInfo(FORM_TYPE_MICE),
        'form_type' => FORM_TYPE_MICE,
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