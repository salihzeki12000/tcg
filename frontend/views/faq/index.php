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

$this->title = Yii::t('app', 'FAQ');
$this->description = Yii::t('app', 'Frequently Asked Questions');
$this->keywords = Yii::t('app', 'China travel tips, China travel FAQs, China travel preparation');
$this->params['breadcrumbs'][] = Yii::t('app', 'Preparation');
?>

<div class="container title-bar">
  <div class="row">
    <div class="cities-banner">
      <?= Html::img('@web/statics/images/title-bg' . ((Yii::$app->params['is_mobile'])?'':'-pc') . '.jpg', ['alt'=>'FAQ', 'width'=>"100%"]) ?>
      <h1 class="banner-text"><?=Yii::t('app','FAQ')?></h1>
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


<?php
$js = <<<JS

JS;
$this->registerJs($js);
?>