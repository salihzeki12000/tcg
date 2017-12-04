<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OaOtherCost */

$this->title = Yii::t('app', 'Create Oa Other Cost');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Oa Other Costs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-other-cost-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
