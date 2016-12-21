<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\FormInfo */

$this->title = 'Information Form';

$fields = Yii::$app->params['form_fields'][$model->type];
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
