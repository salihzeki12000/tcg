<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OaBookCost */

$this->title = Yii::t('app', 'Create Book Cost');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Book Costs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-book-cost-create">

    <?= $this->render('_form', [
        'model' => $model,
        'permission' => $permission,
    ]) ?>

</div>
