<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\OaInquiry */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Oa Inquiries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-inquiry-view">

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
            'create_time',
            'update_time',
            'inquiry_source',
            'language',
            'priority',
            'agent',
            'co_agent',
            'tour_type',
            'group_type',
            'organization:ntext',
            'country',
            'number_of_travelers',
            'traveler_info:ntext',
            'tour_start_date',
            'tour_end_date',
            'cities',
            'contact',
            'email:email',
            'other_contact_info:ntext',
            'original_inquiry:ntext',
            'follow_up_record:ntext',
            'tour_schedule_note:ntext',
            'other_note:ntext',
            'estimated_cny_amount',
            'probability',
            'inquiry_status',
            'close',
            'close_report:ntext',
        ],
    ]) ?>

</div>
