<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OaFeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Oa Feedbacks');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-feedback-index">

	<h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Oa Feedback'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>