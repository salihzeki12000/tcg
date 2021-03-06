<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use common\models\UploadedFiles;

/* @var $this yii\web\View */
/* @var $model common\models\Tour */

$this->title = $article['title'];
$this->description = Html::encode(\common\models\Tools::limit_words(strip_tags($article['content']), 30)) . '...';
$this->keywords = Html::encode($article['keywords']);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blogs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="title-bar">
  <div class="row">
    <div class="cities-banner">
      <?= Html::img('@web/statics/images/blog-header' . ((Yii::$app->params['is_mobile'])?'':'-pc') . '.jpg', ['alt'=>Yii::t('app','the china guide blog'), 'width'=>"100%"]) ?>
      <h1 class="banner-text"><span><?= (\Yii::$app->controller->id=='article') ? Yii::t('app','Travel Blog') : Yii::t('app','We create private, customized China tours.') ?></span></h1>
    </div>
  </div>
</div>

<div class="tour-view">
  <div class="container tour-left col-lg-8 col-md-12 col-sm-12 col-xs-12">

    <div class="article-view col-lg-12 col-md-12 col-xs-12">

        <div class="content-body">
              <h1>
	          	<?= $article['title'] ?>
              	<small><?= date('F d, Y', strtotime($article['create_time'])) ?></small>
              </h1>
              
            <?php if($article['pic_s']) {?>
            <img src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($article['pic_s'], 'm')?>" alt="<?= $article['title'] ?>"/>
            <?php } ?>
            <div class="overview">
              <?= $article['content'] ?>
            </div>
        </div>

    </div>

    <?= $this->render('/layouts/_share_icon_links', [
      'title_image_url' => Yii::$app->params['uploads_url'] . UploadedFiles::getSize($article['pic_s'], 'l'),
    ]) ?>
  </div>

    <?= $this->render('/layouts/_exp-right', []) ?>
  
</div>



<?php
$js = <<<JS

JS;
$this->registerJs($js);
?>
