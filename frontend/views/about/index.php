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

$this->title = $sub_title . ' - ' . Yii::t('app', 'About us');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
  <div class="row">
    <div class="cities-banner hidden-md hidden-lg hidden-sm">
      <div class="banner-text">ABOUT US</div>
      <?= Html::img('@web/statics/images/aboutus-bg.jpg', ['alt'=>'About us', 'width'=>"100%"]) ?>
    </div>
    <div class="cities-banner hidden-xs">
      <h2 class="banner-text-d">ABOUT US</h2>
    </div>
  </div>
</div>

<div class="btn-group dest-title">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?= $sub_title ?>
    <i class="glyphicon glyphicon-chevron-down"></i>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="<?= Url::toRoute(['about/index']) ?>">Who Are We</a></li>
    <li><a href="<?= Url::toRoute(['about/why-book-with-us']) ?>">Why Book With Us?</a></li>
    <li><a href="<?= Url::toRoute(['about/meet-our-team']) ?>">Meet Our Team</a></li>
    <li><a href="<?= Url::toRoute(['about/contact-us']) ?>">Contact Us</a></li>
  </ul>
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