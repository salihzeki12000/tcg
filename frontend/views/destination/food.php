<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\UploadedFiles;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\city */

$this->title = $city_info['name'];
$this->description = Html::encode(\common\models\Tools::limit_words(strip_tags($city_info['introduction']), 30)) . '…';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Destinations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url'=>Url::toRoute(['destination/view', 'name'=>$city_info['name']])];
$this->params['breadcrumbs'][] = Yii::t('app','Food');
?>

<?= $this->render('_des-header', [
    'city_info' => $city_info,
    'menu' => $menu,
]) ?>

<div class="city-view">

    <div class="container">

        <div class="overview">
          <?= $city_info['food'] ?>
        </div>
    </div>

</div>

<?php
$js = <<<JS

JS;
$this->registerJs($js);

$css = <<<CSS
  .breadcrumb{
    margin-bottom: 0px;
  }
CSS;
$this->registerCss($css); 
?>