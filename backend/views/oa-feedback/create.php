<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OaFeedback */

$this->title = Yii::t('app', 'Create Oa Feedback');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Oa Feedbacks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-feedback-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
