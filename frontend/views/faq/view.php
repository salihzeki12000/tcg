<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use common\models\UploadedFiles;

/* @var $this yii\web\View */
/* @var $model common\models\Tour */

$this->title = $faq['title'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'FAQ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="tour-view">
  <div class="container tour-left col-lg-8 col-md-12 col-sm-12 col-xs-12">

    <div class="article-view col-lg-12 col-md-12 col-xs-12">

        <div class="">
            <center><h2><?= $faq['title'] ?></h2></center>
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