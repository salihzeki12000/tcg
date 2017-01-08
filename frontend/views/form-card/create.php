<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\FormCard */

$this->title = Yii::t('app', 'Secure Credit Card Form');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Form Cards'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="form-info container" id="form-info-page">
  <h2><?=Yii::t('app',"Please inform your bank or credit card issuer that you will be receiving a charge from China. ")?></h2>
  <div class="form-info-create col-lg-8 col-md-8 col-xs-12">

    <div class="form-title"><?=Yii::t('app','Secure Credit Card Form')?></div>

    <?= $this->render('/form-card/_form', [
        'model' => new common\models\FormCard(),
    ]) ?>

    <div class="form-info-bottom"></div>
  </div>
</div>

