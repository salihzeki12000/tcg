<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Tour;

/* @var $this yii\web\View */
/* @var $model common\models\FormInfo */

$this->title = 'Information Form';

$fields = Yii::$app->params['form_fields'][$model->type];

$url_prefix = 'experience';
if ($model->tour_id > 0) {
  $tour_item = Tour::find()->where(['id' => $model->tour_id])->One();
  $url_param = $tour_item->url_id;
  if($tour_item->type == TOUR_TYPE_GROUP)
  {
    $url_prefix = 'small-group-tours';
  }
}
foreach ($fields as &$field) {
    if (is_string($field) && $field=='tour_name') {
        $field = [
          'attribute'=>'tour_name',
          'label'=> Yii::t('app', 'Tour name'),
          'format' => 'raw',
          'value' => "<a href='".SITE_BASE_URL."/".$url_prefix."/" . ((empty($url_param))?urlencode(str_replace(' ', '-', $model->tour_name)):$url_param) . "' target='_blank'>".$model->tour_name."</a>",
        ];
    }
}
array_unshift($fields,
            [
              'attribute'=>'type',
              'label'=> Yii::t('app', 'Type'),
              'value'=> Yii::$app->params['form_types'][$model->type],
            ]);
$fields[] = 'create_time';


?>
<div class="form-info-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => $fields,
    ]) ?>

</div>
