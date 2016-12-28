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

$this->title = Yii::t('app', 'Blogs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container title-bar">
  <div class="row">
    <div class="cities-banner">
      <?= Html::img('@web/statics/images/blogs-bg' . ((Yii::$app->params['is_mobile'])?'':'-pc') . '.jpg', ['alt'=>'BLOGS', 'width'=>"100%"]) ?>
      <div class="banner-text"><?=Yii::t('app','BLOGS')?></div>
    </div>
  </div>
</div>

<div class="article-index container">
    <!-- Single button -->
    <div class="container">
        <div class="list-group">
            <?php foreach ($articles as $article) { ?>
            <a class="col-md-6 list-group-item" href="<?= Url::toRoute(['article/view', 'title'=>$article['title']]) ?>">
                <div class="media">
                  <div class="media-left">
                      <img width="100px" class="media-object" src="<?= Yii::$app->params['uploads_url'] . UploadedFiles::getSize($article['pic_s'], 's')?>" alt="<?= $article['title'] ?>">
                  </div>
                  <div class="media-body">
                    <h4 class="media-heading"><?= $article['title'] ?></h4>
                    <?=Yii::t('app','Posted on')?> <?= date('d F, Y', strtotime($article['create_time'])) ?>
                  </div>
                </div>
            </a>
            <?php } ?>
        </div>
    </div>


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


<?php
$js = <<<JS

JS;
$this->registerJs($js);
?>