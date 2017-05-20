<?php

use yii\helpers\Html;
use common\models\UploadedFiles;
use yii\helpers\Url;
?>

<div class="container title-bar">
  <div class="row">
    <div class="cities-banner">
      <?php for($i=0; $i<count($city_info['images']); $i++) {
          $slide=$city_info['images'][$i];
          $pic_type = 'l';
          if (Yii::$app->params['is_mobile']) {
              $pic_type = 'mob';
          }
      ?>
        <?= Html::img(Yii::$app->params['uploads_url'] . UploadedFiles::getSize($slide['path'], $pic_type), ['alt'=>$slide['title'], 'width'=>"100%"]) ?>
      <?php break; } ?>
      
      <h1 class="banner-text"><?= $city_info['name'] ?></h1>
    </div>
  </div>
</div>

<div class="input-group type-menu col-lg-6 col-md-6 col-xs-10">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <?= $menu[Yii::$app->controller->action->id] ?>
    <i class="glyphicon glyphicon-chevron-down"></i>
  </button>
  <ul class="dropdown-menu" role="menu">
    <?php foreach ($menu as $key => $value) { ?>
      <li <?= (Yii::$app->controller->action->id==$key)? 'class="active"':'' ?>><a href="<?= Url::toRoute(['destination/'.$key, 'url_id'=>$city_info['url_id']]) ?>"><?= $value ?></a></li>
    <?php } ?>
  </ul>
</div>