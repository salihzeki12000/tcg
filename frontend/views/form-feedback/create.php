<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OaFeedback */

$this->title = Yii::t('app', 'Feedback Form');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Feedback Form'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="form-info container">
  <div class="form-info-create col-lg-7 col-md-7 col-sm-8 col-xs-12">
  	<span class="placeholder" id="inquiry-form"></span>
    <h2><?=Yii::t('app',"Feedback Form")?></h2>
	<div class="tips"><?=Yii::t('app','Thank you for traveling with The China Guide! We would appreciate it if you could spend a few minutes giving us your feedback.') ?></div>

    <?= $this->render('/form-feedback/_form', [
        'model' => new common\models\OaFeedback(),
    ]) ?>

    <div class="form-info-bottom"></div>
  </div>
</div>


