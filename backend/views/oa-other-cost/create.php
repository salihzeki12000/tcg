<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OaOtherCost */

$this->title = Yii::t('app', 'Create Other Cost');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Other Costs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-other-cost-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
