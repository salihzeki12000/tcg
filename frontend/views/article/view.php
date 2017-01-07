<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use common\models\UploadedFiles;

/* @var $this yii\web\View */
/* @var $model common\models\Tour */

$this->title = $article['title'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blogs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="tour-view">
  <div class="container tour-left col-lg-8 col-md-12 col-sm-12 col-xs-12">

    <div class="article-view col-lg-12 col-md-12 col-xs-12">

        <div class="">
            <center><h2><?= $article['title'] ?></h2></center>
            <div class="overview">
              <?= $article['content'] ?>
            </div>
        </div>

    </div>

    <div class=" home-btn">
      <div class="row btn-row">
        <a type="button" class="btn btn-mine col-lg-5 col-md-4 col-xs-10" href="<?= Url::toRoute(['experience/index']) ?>">View more tours</a>
      </div>
    </div>
  </div>

  <?php if (!Yii::$app->params['is_mobile']) { ?>
    <?= $this->render('/layouts/_exp-right', [
        'tours' => $tours,
    ]) ?>
  <?php } ?>
  
</div>



<?php
$js = <<<JS

JS;
$this->registerJs($js);
?>