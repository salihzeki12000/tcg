<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\FormInfo */

$this->title = 'Information Form';

$fields = Yii::$app->params['form_fields'][$model->type];
foreach ($fields as &$field) {
    if (is_string($field) && $field=='tour_name') {
        $field = [
          'attribute'=>'tour_name',
          'label'=> Yii::t('app', 'Tour name'),
          'format' => 'raw',
          'value' => "<a href='//thechinaguide.com/experience/" . urlencode(str_replace(' ', '-', $model->tour_name)) . "' target='_blank'>".$model->tour_name."</a>",
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
