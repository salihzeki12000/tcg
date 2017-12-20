<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OaBookCost */

$this->title = Yii::t('app', 'Create Oa Book Cost');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Oa Book Costs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-book-cost-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'permission' => $permission,
    ]) ?>

</div>
