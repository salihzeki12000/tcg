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

	<?php if($permission['canAdd']) { ?>
    <p>
        <?= Html::a(Yii::t('app', 'Create Feedback'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>
    
	<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'create_time',
            'tour_id',
            // 'language',
            // 'comment_itinerary:ntext',
            // 'comment_meals:ntext',
            // 'comment_service:ntext',
            // 'how_found_us',
            // 'why_chose_us',
            // 'rate',
            // 'suggestions:ntext',
	        [
		        'label' => 'Agent',
	            'attribute' => 'agent'
	        ],
	        [
		        'label' => 'Client name',
	            'attribute' => 'client_name'
	        ],
	        [
		        'label' => 'Client email',
	            'attribute' => 'client_email'
	        ],

            [
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
            ],
        ],
    ]); ?>
</div>