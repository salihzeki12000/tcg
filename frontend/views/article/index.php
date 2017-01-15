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

$this->title = Yii::t('app', 'China travel blogs');
$this->description = Yii::t('app', 'China travel blog, China travel article');
$this->params['breadcrumbs'][] = Yii::t('app','Blogs');
?>
<div class="container title-bar">
  <div class="row">
    <div class="cities-banner">
      <?= Html::img('@web/statics/images/title-bg' . ((Yii::$app->params['is_mobile'])?'':'-pc') . '.jpg', ['alt'=>'BLOGS', 'width'=>"100%"]) ?>
      <div class="banner-text"><?=Yii::t('app','BLOGS')?></div>
    </div>
  </div>
</div>

<div class="tour-view">
  <div class="container tour-left col-lg-8 col-md-12 col-sm-12 col-xs-12">

    <div class="article-index blog">

      <?php foreach ($articles as $article) { ?>

      <article class="entry teaser first">
        <header class="entry-header">
          <h2 class="entry-title" itemprop="headline">
            <a href="<?= Url::toRoute(['article/view', 'title'=>$article['title']]) ?>" rel="bookmark"><?= $article['title'] ?></a>
          </h2>
        </header>
        <div class="entry-content" itemprop="text">
          <a class="entry-image-link" href="<?= Url::toRoute(['article/view', 'title'=>$article['title']]) ?>" aria-hidden="true">
            <img width="335" height="200" src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($article['pic_s'], 's')?>" class="alignright post-image entry-image" alt="<?= $article['title'] ?>" itemprop="image">
          </a>
          <p><?= Html::encode(\common\models\Tools::wordcut(strip_tags($article['content']), 275)) ?></p>
        </div>
        <a href="<?= Url::toRoute(['article/view', 'title'=>$article['title']]) ?>" class="btn btn-info pull-right btn-sm more-link" title="<?=Yii::t('app','Read More')?>"><?=Yii::t('app','Read More')?></a>
        <p class="entry-meta">
          <time class="entry-time" itemprop="datePublished" datetime="<?= date(DATE_ATOM, strtotime($article['create_time'])) ?>"><?= date('F d, Y', strtotime($article['create_time'])) ?></time>
        </p>
      </article>

      <?php } ?>


      <center>
        <?php
        //显示分页页码
        echo LinkPager::widget([
            'pagination' => $pages,
            'maxButtonCount' => 5,
        ])
        ?>
      </center>

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