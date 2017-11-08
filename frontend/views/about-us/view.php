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

$this->title = $sub_title;
$this->description = $description;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="title-bar">
  <div class="row">
    <div class="cities-banner">
      <h1 class="banner-text"><?= $sub_title ?></h1>
      <?= Html::img('@web/statics/images/title-bg' . ((Yii::$app->params['is_mobile'])?'':'-pc') . '.jpg', ['alt'=>'About us', 'width'=>"100%"]) ?>
    </div>
  </div>
</div>

<div class="activity-view">

    <div class="container back-container">
        <div class="overview full-text col-lg-9 col-md-10">
          <?= $article['content'] ?>
        </div>
    </div>

</div>



<?php
$js = <<<JS

JS;
$this->registerJs($js);
?>