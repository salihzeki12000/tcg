<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\UploadedFiles;

/* @var $this yii\web\View */
/* @var $model common\models\Tour */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', ucfirst(Yii::$app->controller->id)), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tour-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'name',
            'code',
            'status',
            'themes',
            'cities',
            'cities_count',
            'priority',
            'tour_length',
            'exp_num',
            'price_cny',
            'overview:ntext',
            'best_season',
            [
              'attribute'=>'image',
              'label'=> Yii::t('app', 'Title Picture'),
              'format' => 'raw',
              'value' => "<a href='" . Yii::$app->params['uploads_url'] . UploadedFiles::getSize($model->pic_title, 'l') . "' target='_blank'><img src='" . Yii::$app->params['uploads_url'] . UploadedFiles::getSize($model->pic_title, 's') . "' width='200px' /></a>",
            ],
            'inclusion:ntext',
            [
              'attribute'=>'image',
              'label'=> Yii::t('app', 'Title Picture'),
              'format' => 'raw',
              'value' => "<a href='" . Yii::$app->params['uploads_url'] . UploadedFiles::getSize($model->pic_map, 'l') . "' target='_blank'><img src='" . Yii::$app->params['uploads_url'] . UploadedFiles::getSize($model->pic_map, 's') . "' width='200px' /></a>",
            ],
            'exclusion:ntext',
            'tips:ntext',
            'title',
            'description',
            'keywords',
            'link_tour',
            'create_time',
            'update_time',
            'begin_date',
            'end_date',
        ],
    ]) ?>

</div>
