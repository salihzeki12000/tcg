<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OaGuideExpense */

$this->title = Yii::t('app', 'Create Oa Guide Expense');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Oa Guide Expenses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-guide-expense-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
