<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use common\models\UploadedFiles;

/* @var $this yii\web\View */
/* @var $model common\models\Tour */

$this->title = $faq['title'];
$this->description = Html::encode(\common\models\Tools::limit_words(strip_tags($faq['content']), 30)) . '…';
$this->keywords = Html::encode($faq['keywords']);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'FAQ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container title-bar">
  <div class="row">
    <div class="cities-banner">
      <?= Html::img('@web/statics/images/title-bg' . ((Yii::$app->params['is_mobile'])?'':'-pc') . '.jpg', ['alt'=>'FAQ', 'width'=>"100%"]) ?>
      <div class="banner-text"><?=Yii::t('app','FAQ')?></div>
    </div>
  </div>
</div>

<div class="tour-view">
  <div class="container tour-left col-lg-8 col-md-12 col-sm-12 col-xs-12">

    <div class="article-view col-lg-12 col-md-12 col-xs-12">

        <div class="content-body">
            <center>
              <h2><?= $faq['title'] ?></h2>
            </center>
            <?php if($faq['pic_s']) {?>
            <img src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($faq['pic_s'], 'm')?>" alt="<?= $faq['title'] ?>"/>
            <?php } ?>
            <div class="overview">
              <?= $faq['content'] ?>
            </div>
        </div>

    </div>

  </div>

    <?= $this->render('/layouts/_exp-right', [
        'tours' => $tours,
    ]) ?>

</div>




<?php
$js = <<<JS

JS;
$this->registerJs($js);
?>