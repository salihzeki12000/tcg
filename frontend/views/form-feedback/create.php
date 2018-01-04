<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OaFeedback */

$this->title = Yii::t('app', 'Feedback Form');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Form Cards'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="form-info container">
  <div class="form-info-create col-lg-8 col-md-8 col-xs-12">
  	<span class="placeholder" id="inquiry-form"></span>
    <h2><?=Yii::t('app',"Feedback Form")?></h2>
	<div class="tips"><?=Yii::t('app','Your feedback is very important to us') ?></div>

    <?= $this->render('/form-feedback/_form', [
        'model' => new common\models\OaFeedback(),
    ]) ?>

    <div class="form-info-bottom"></div>
  </div>
</div>


