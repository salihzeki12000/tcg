<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OaFeedback */

$this->title = Yii::t('app', 'Feedback Form');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Form Cards'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="form-info container">
  <div class="form-info-create col-lg-6 col-md-6 col-sm-8 col-xs-12">
  	<span class="placeholder" id="inquiry-form"></span>
    <h2><?=Yii::t('app',"Feedback")?></h2>
	<div class="tips"><?=Yii::t('app','Thank you for sharing your feelings about our services. They are valuable to us in developing our services further.') ?></div>

    <?= $this->render('/form-feedback/_form', [
        'model' => new common\models\OaFeedback(),
    ]) ?>

    <div class="form-info-bottom"></div>
  </div>
</div>


