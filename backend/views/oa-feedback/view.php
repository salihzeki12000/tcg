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

	<?php if($permission['isAdmin']): ?>
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
    <?php endif; ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
            	'attribute' => 'tour_id',
            	'format' => 'raw'
            ],
            'create_time',
            [
            	'attribute' => 'comment_itinerary',
            	'label' => 'Comment itinerary'
            ],
            [
            	'attribute' => 'comment_meals',
            	'label' => 'Comment meals'
            ],
            [
            	'attribute' => 'comment_service_guide_driver',
            	'label' => 'Comment guide & driver'
            ],
            [
            	'attribute' => 'comment_service_agent',
            	'label' => 'Comment agent'
            ],
            [
            	'attribute' => 'rate',
            	'label' => 'Overall rate'
            ],
            [
            	'attribute' => 'why_chose_us',
            	'label' => 'Why chose us'
            ],
            [
            	'attribute' => 'suggestions',
            	'label' => 'Suggestions'
            ]
        ],
    ]) ?>

</div>
