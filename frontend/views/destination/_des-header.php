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
      
      <div class="banner-text"><?= $city_info['name'] ?></div>
    </div>
  </div>
</div>