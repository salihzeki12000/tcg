<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Tour */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tours'), 'url' => ['index']];
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
            'price_usd',
            'overview:ntext',
            'best_season',
            'pic_map',
            'pic_title',
            'inclusion:ntext',
            'exclusion:ntext',
            'tips:ntext',
            'keywords',
            'link_tour',
            'rec_type',
            'create_time',
            'update_time',
        ],
    ]) ?>

</div>
