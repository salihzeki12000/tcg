<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OaTour */

$this->title = Yii::t('app', 'Create Tour');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tours'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-tour-create">

    <?= $this->render('_form', [
        'model' => $model,
        'permission' => $permission,
    ]) ?>

</div>
