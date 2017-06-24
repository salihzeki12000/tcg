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

$this->title = Yii::t('app', 'Meetings, Incentives, Conferences and Exhibitions');
$this->description = Yii::t('app', 'Professional Business Travel Planning Services');
$this->keywords = Yii::t('app', '');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container title-bar">
  <div class="row">
    <div class="cities-banner">
      <h1 class="banner-text"><?=Yii::t('app','MICE Travel')?><br><small><?=Yii::t('app','PROFESSIONAL BUSINESS TRAVEL PLANNING SERVICES')?></small></h1>
      
      <?= Html::img('@web/statics/images/mice-bg' . ((Yii::$app->params['is_mobile'])?'':'-pc') . '.jpg', ['alt'=>'About us', 'width'=>"100%"]) ?>
    </div>
  </div>
</div>

<div class="container home-btn">
  <div class="row btn-row">
    <a type="button" class="btn btn-danger col-lg-3 col-md-4 col-xs-10" href="#inquiry-form"><?=Yii::t('app','Plan an Incentive Trip')?></a>
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
    <div class="form-title"><?=Yii::t('app','Information Form')?></div>

    <?= $this->render('/form-info/_form', [
        'model' => new common\models\FormInfo(FORM_TYPE_MICE),
        'form_type' => FORM_TYPE_MICE,
        'tour_code' => '',
        'tour_name' => '',
    ]) ?>

    <div class="form-info-bottom"><?=Yii::t('app','We respond your inquiry by email within one working day.')?></div>
  </div>
</div>

<?php
$js = <<<JS

JS;
$this->registerJs($js);
?>