<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\OaTour */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Oa Tours'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-tour-view">

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
            'inquiry_id',
            'create_time',
            'update_time',
            'inquiry_source',
            'language',
            'vip',
            'agent',
            'co-agent',
            'operator',
            'tour_type',
            'group_type',
            'country',
            'organization:ntext',
            'number_of_travelers',
            'traveler_info:ntext',
            'tour_start_date',
            'tour_end_date',
            'cities',
            'contact',
            'email:email',
            'other_contact_info:ntext',
            'itinerary_quotation_english:ntext',
            'itinerary_quotation_other_language:ntext',
            'tour_schedule_note:ntext',
            'note_for_guide:ntext',
            'other_note:ntext',
            'tour_price',
            'payment',
            'stage',
        ],
    ]) ?>

</div>
