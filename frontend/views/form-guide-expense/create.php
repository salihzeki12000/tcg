<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OaGuideExpense */

$this->title = Yii::t('app', 'Expense Form');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Form Cards'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="form-info container">
  <div class="form-info-create col-lg-8 col-md-8 col-xs-12">
  	<span class="placeholder" id="inquiry-form"></span>
    <h2><?=Yii::t('app',"Expense Form")?></h2>
	<div class="tips"><?=Yii::t('app','Please fill in the fields below') ?></div>

    <?= $this->render('/form-guide-expense/_form', [
        'model' => new common\models\OaGuideExpense(),
    ]) ?>

    <div class="form-info-bottom"></div>
  </div>
</div>


