<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OaFeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Feedbacks');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-feedback-index">

	<?php if(0) { ?>
    <p>
        <?= Html::a(Yii::t('app', 'Create Feedback'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>
    
	<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
			[
				'attribute' => 'id',
				'format' => 'raw',
				'value' => function($model) {
					return '<a href="' . Url::to(['oa-feedback/view', 'id'=>$model['id']]) . '" target="_blank">' . $model['id'] . '</a>';
				},
				'headerOptions' => ['width' => '100'],
			],
            [
				'attribute'=>'tour_id',
				'format' => 'raw',
				'value' => function($model) {
					if($model['tour_id']):
						return '<a href="' . Url::to(['oa-tour/view', 'id'=>$model['tour_id']]) . '" target="_blank">T' . $model['tour_id'] . '</a>';
					endif;
					
					return '-';
				},
				'headerOptions' => ['width' => '100'],
			],
			[
				'label' => 'Agent',
				'attribute'=>'username',
				'headerOptions' => ['width' => '100'],
			],
			[
				'label' => 'Tour End Date',
				'attribute'=>'tour_end_date',
				'headerOptions' => ['width' => '100'],
			],
			[
				'attribute' => 'create_time',
				'headerOptions' => ['width' => '150'],
			],
            [
	         	'attribute' => 'rate',
	         	'label' => 'Overall Rate',
                'filter'=> \common\models\Tools::getEnvironmentVariable('oa_feedback_rate'),
				'headerOptions' => ['width' => '150'],
            ],
            // 'comment_itinerary:ntext',
            // 'comment_meals:ntext',
            // 'comment_service:ntext',
            // 'why_chose_us',
            // 'suggestions:ntext',

            /*[
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        return Url::to(['oa-feedback/view', 'id'=>$model->id]);
                    }
                    if ($action === 'update') {
                        return Url::to(['oa-feedback/update', 'id'=>$model->id]);
                    }
                    if ($action === 'delete') {
                        return Url::to(['oa-feedback/delete', 'id'=>$model->id]);
                    }
                    
                },
            ],*/
        ],
    ]); ?>
</div>