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

<div class="container title-bar">
  <div class="row">
    <div class="cities-banner">
      <h2 class="banner-text"><?= mb_strtoupper($sub_title, 'UTF-8') ?></h2>
      <?= Html::img('@web/statics/images/title-bg' . ((Yii::$app->params['is_mobile'])?'':'-pc') . '.jpg', ['alt'=>'About us', 'width'=>"100%"]) ?>
    </div>
  </div>
</div>

<div class="article-view">

    <div class="container">
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