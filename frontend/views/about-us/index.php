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
$this->description = Yii::t('app', 'Private and guided package tours to China from a Beijing-based travel agency run by a multilingual team of native speakers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="title-bar">
  <div class="row">
    <div class="cities-banner">
      <h1 class="banner-text"><span><?=Yii::t('app','About Us')?></span></h1>
      <?= Html::img('@web/statics/images/aboutus-bg' . ((Yii::$app->params['is_mobile'])?'':'-pc') . '.jpg', ['alt'=>Yii::t('app','About us'), 'width'=>"100%"]) ?>
    </div>
  </div>
</div>
<div class="activity-view">

    <div class="input-group type-menu col-lg-6 col-md-6 col-xs-10">
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
        <h1><?= $sub_title ?></h1>
        <i class="glyphicon glyphicon-chevron-down"></i>
      </button>
      <ul class="dropdown-menu sub-menu" role="menu">
        <li <?= (Yii::$app->controller->action->id=='index')? 'class="active"':'' ?>><a href="<?= Url::toRoute(['about-us/index']) ?>"><?=Yii::t('app','Who we are')?></a></li>
        <li <?= (Yii::$app->controller->action->id=='meet-our-team')? 'class="active"':'' ?>><a href="<?= Url::toRoute(['about-us/meet-our-team']) ?>"><?=Yii::t('app','Meet our team')?></a></li>
        <li <?= (Yii::$app->controller->action->id=='our-guides')? 'class="active"':'' ?>><a href="<?= Url::toRoute(['about-us/our-guides']) ?>"><?=Yii::t('app','Our guides')?></a></li>
        <li <?= (Yii::$app->controller->action->id=='drivers-and-vehicles')? 'class="active"':'' ?>><a href="<?= Url::toRoute(['about-us/drivers-and-vehicles']) ?>"><?=Yii::t('app','Drivers and vehicles')?></a></li>
        <li <?= (Yii::$app->controller->action->id=='contact-us')? 'class="active"':'' ?>><a href="<?= Url::toRoute(['about-us/contact-us']) ?>"><?=Yii::t('app','Contact us')?></a></li>
      </ul>
    </div>

    <br>
    <div class="container back-container">
        <?php if (Yii::$app->controller->action->id == 'meet-our-team') { ?>
          <div class="overview">
        <?php } else { ?>
          <div class="overview full-text col-lg-9 col-md-10">
        <?php } ?>
          <?= $article['content'] ?>
        </div>
    </div>

</div>

<?= Yii::$app->controller->action->id=='contact-us'?$this->render('/layouts/_tawk_script', []):'' ?>

<?php
$js = <<<JS

//Meet Our Team
$('.us-face').mouseover(function(){
  $(this).attr("src",$(this).attr('data-img2'));
});
$('.us-face').mouseout(function(){
  $(this).attr("src",$(this).attr('data-img1'));
});
$('.us-face').hammer().on('tap', function(){
  if($(this).attr("src") == $(this).attr('data-img1')){
    $(this).attr("src", $(this).attr('data-img2'));
  }
  else{
    $(this).attr("src",$(this).attr('data-img1'));
  }
});

JS;
$this->registerJs($js);

/* $css = <<<CSS

  // Meet Our Team
  .us-face-row>div{
    height: 530px;
  }
CSS;
$this->registerCss($css); */

?>