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

$this->title = Yii::t('app', 'About us');
$this->description = Yii::t('app', 'The China Guide create private, customized China tours. With our Western-style travel sense and passion for Chinese culture and history, let us send you on a journey you will never forget.');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container title-bar">
  <div class="row">
    <div class="cities-banner">
      <h2 class="banner-text"><?=Yii::t('app','ABOUT US')?></h2>
      <?= Html::img('@web/statics/images/aboutus-bg' . ((Yii::$app->params['is_mobile'])?'':'-pc') . '.jpg', ['alt'=>'About us', 'width'=>"100%"]) ?>
    </div>
  </div>
</div>

<div class="article-view">

    <div class="input-group type-menu col-lg-6 col-md-6 col-xs-10">
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
        <?= $sub_title ?>
        <i class="glyphicon glyphicon-chevron-down"></i>
      </button>
      <ul class="dropdown-menu sub-menu" role="menu">
        <li <?= (Yii::$app->controller->action->id=='index')? 'class="active"':'' ?>><a href="<?= Url::toRoute(['about/index']) ?>"><?=Yii::t('app','Our Mission')?></a></li>
        <li <?= (Yii::$app->controller->action->id=='meet-our-team')? 'class="active"':'' ?>><a href="<?= Url::toRoute(['about/meet-our-team']) ?>"><?=Yii::t('app','Meet Our Team')?></a></li>
        <li <?= (Yii::$app->controller->action->id=='our-guides')? 'class="active"':'' ?>><a href="<?= Url::toRoute(['about/our-guides']) ?>"><?=Yii::t('app','Our Guides')?></a></li>
        <li <?= (Yii::$app->controller->action->id=='drivers-and-vehicles')? 'class="active"':'' ?>><a href="<?= Url::toRoute(['about/drivers-and-vehicles']) ?>"><?=Yii::t('app','Drivers &amp; Vehicles')?></a></li>
        <li <?= (Yii::$app->controller->action->id=='contact-us')? 'class="active"':'' ?>><a href="<?= Url::toRoute(['about/contact-us']) ?>"><?=Yii::t('app','Contact Us')?></a></li>
      </ul>
    </div>

    <div class="container">
        <div class="overview">
          <?= $article['content'] ?>
        </div>
    </div>

</div>



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

$css = <<<CSS

  /*Meet Our Team*/
  .us-face-row>div{
    height: 530px;
  }
CSS;
$this->registerCss($css); 

?>