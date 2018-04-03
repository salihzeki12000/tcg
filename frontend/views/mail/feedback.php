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
			'comment_itinerary',
			'comment_meals',
			'comment_service_guide_driver',
			'comment_service_agent',
			'rate',
			'why_chose_us',
			'suggestions',
        ],
    ]) ?>

</div>
