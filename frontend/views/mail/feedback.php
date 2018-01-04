<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\OaFeedback */

$this->title = Yii::t('app','Feedback Form');

?>
<div class="form-info-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
			'tour_id',
			'language',
			'create_time',
			'comment_itinerary',
			'comment_meals',
			'comment_service',
			'how_found_us',
			'why_chose_us',
			'rate',
			'suggestions',
			'client_name',
			'client_email',
			'agent',
        ],
    ]) ?>

</div>
