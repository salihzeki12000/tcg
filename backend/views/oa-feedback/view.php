<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\OaFeedback */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Feedbacks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-feedback-view">

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
            'tour_id',
            'language',
            'create_time',
            [
            	'attribute'=>'comment_itinerary',
            	'label' => 'Comment itinerary'
            ],
            [
            	'attribute'=>'comment_meals',
            	'label' => 'Comment meals'
            ],
            [
            	'attribute'=>'comment_service_agent',
            	'label' => 'Comment agent'
            ],
            [
            	'attribute'=>'comment_service_guide_driver',
            	'label' => 'Comment guide & driver'
            ],
            [
            	'attribute'=>'why_chose_us',
            	'label' => 'Why chose us'
            ],
            [
            	'attribute'=>'rate',
            	'label' => 'Overall rate'
            ],
            [
            	'attribute'=>'suggestions',
            	'label' => 'Suggestions'
            ],
            [
            	'attribute'=>'client_name',
            	'label' => 'Client\'s name'
            ],
            [
            	'attribute'=>'client_email',
            	'label' => 'Client\'s email'
            ],
            [
            	'attribute'=>'agent',
            	'label' => 'Agent'
            ],
        ],
    ]) ?>

</div>
