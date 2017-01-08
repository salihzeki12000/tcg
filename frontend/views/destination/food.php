<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\UploadedFiles;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\city */

$this->title = $city_info['name'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Destinations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url'=>Url::toRoute(['destination/view', 'name'=>$city_info['name']])];
$this->params['breadcrumbs'][] = Yii::t('app','Food');
?>

<?= $this->render('_des-header', [
    'city_info' => $city_info,
]) ?>

<div class="city-view">

    <div class="btn-group dest-title">
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?=Yii::t('app','Food')?>
        <i class="glyphicon glyphicon-chevron-down"></i>
      </button>
      <ul class="dropdown-menu" role="menu">
        <li><a href="<?= Url::toRoute(['destination/view', 'name'=>$city_info['name']]) ?>"><?=Yii::t('app','Overview')?></a></li>
        <?php foreach ($menu as $key => $value) { ?>
          <li <?= (Yii::$app->controller->action->id==$key)? 'class="active"':'' ?>><a href="<?= Url::toRoute(['destination/'.$key, 'name'=>$city_info['name']]) ?>"><?= $value ?></a></li>
        <?php } ?>
      </ul>
    </div>

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