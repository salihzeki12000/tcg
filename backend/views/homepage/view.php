<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\UploadedFiles;

/* @var $this yii\web\View */
/* @var $model common\models\Homepage */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', ucfirst(Yii::$app->controller->id)), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="homepage-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type',
            'title',
            'description',
            [
              'attribute'=>'image',
              'label'=> Yii::t('app', 'Image'),
              'format' => 'raw',
              'value' => "<a href='" . Yii::$app->params['uploads_url'] . UploadedFiles::getSize($model->pic_s, 'l') . "' target='_blank'><img src='" . Yii::$app->params['uploads_url'] . UploadedFiles::getSize($model->pic_s, 's') . "' width='200px' /></a>",
            ],
            'url',
            'priority',
            'status',
            'create_time',
            'update_time',
        ],
    ]) ?>

</div>
