<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\FormCard */

$this->title = Yii::t('app', 'Secure Credit Card Form');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Form Cards'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="form-info container">
  <div class="form-info-create col-lg-8 col-md-8 col-xs-12">
  	<span class="placeholder" id="inquiry-form"></span>
    <h2><?=Yii::t('app',"Secure Credit Card Form")?></h2>
	<div class="tips"><?=Yii::t('app','Please inform your bank or credit card issuer that you will be receiving a charge from China') ?></div>

    <?= $this->render('/form-card/_form', [
        'model' => new common\models\FormCard(),
    ]) ?>

    <div class="form-info-bottom"></div>
  </div>
</div>


