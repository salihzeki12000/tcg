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
    <div class="cities-banner hidden-md hidden-lg">
      <div class="banner-text">ABOUT US</div>
      <?= Html::img('@web/statics/images/aboutus-bg.jpg', ['alt'=>'About us', 'width'=>"100%"]) ?>
    </div>
    <div class="cities-banner hidden-xs hidden-sm">
      <h2 class="banner-text-d">ABOUT US</h2>
    </div>
  </div>
</div>

<div class="btn-group dest-title">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?= $sub_title ?>
    <i class="glyphicon glyphicon-chevron-down"></i>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li <?= (Yii::$app->controller->action->id=='index')? 'class="active"':'' ?>><a href="<?= Url::toRoute(['about/index']) ?>">Who Are We</a></li>
    <li <?= (Yii::$app->controller->action->id=='why-book-with-us')? 'class="active"':'' ?>><a href="<?= Url::toRoute(['about/why-book-with-us']) ?>">Why Book With Us?</a></li>
    <li <?= (Yii::$app->controller->action->id=='meet-our-team')? 'class="active"':'' ?>><a href="<?= Url::toRoute(['about/meet-our-team']) ?>">Meet Our Team</a></li>
    <li <?= (Yii::$app->controller->action->id=='contact-us')? 'class="active"':'' ?>><a href="<?= Url::toRoute(['about/contact-us']) ?>">Contact Us</a></li>
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