<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\Cities;
use common\models\UploadedFiles;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TourSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'FAQ');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index container">

    <div class="list-group">
        <div class="list-group-item"><center><h2><?= Yii::$app->params['faq_type'][FAQ_TYPE_TRIP_PLANNING] ?></h2></center></div>
        <?php foreach ($faq as $item) { 
          if ($item['sub_type'] != FAQ_TYPE_TRIP_PLANNING) {
            continue;
          }
        ?>
        <a href="<?= Url::toRoute(['faq/view', 'title'=>$item['title']]) ?>" class="list-group-item">
            <i class="glyphicon glyphicon-chevron-right pull-right" /></i>
            <span><?= $item['title'] ?></span>
        </a>
        <?php } ?>
    </div>

    <div class="list-group">
        <div class="list-group-item"><center><h2><?= Yii::$app->params['faq_type'][FAQ_TYPE_IN_CHINA] ?></h2></center></div>
        <?php foreach ($faq as $item) { 
          if ($item['sub_type'] != FAQ_TYPE_IN_CHINA) {
            continue;
          }
        ?>
        <a href="<?= Url::toRoute(['faq/view', 'title'=>$item['title']]) ?>" class="list-group-item">
            <i class="glyphicon glyphicon-chevron-right pull-right" /></i>
            <span><?= $item['title'] ?></span>
        </a>
        <?php } ?>
    </div>

</div>


<?php
$js = <<<JS

JS;
$this->registerJs($js);
?>