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
        <?php if($permission['canDel']) { ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?php } ?>
        <?php if($permission['canAddTour']) { ?>
        <?= Html::a(Yii::t('app', 'Add Tour'), ['oa-tour/create', 'inquiry_id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php } ?>
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
            'organization:html',
            'country',
            'number_of_travelers',
            'traveler_info:html',
            'tour_start_date',
            'tour_end_date',
            'cities',
            'contact',
            'email:email',
            'other_contact_info:html',
            'original_inquiry:html',
            'follow_up_record:html',
            'tour_schedule_note:html',
            'other_note:html',
            'estimated_cny_amount',
            'probability',
            'inquiry_status',
            'close',
            'close_report:html',
        ],
    ]) ?>

</div>
