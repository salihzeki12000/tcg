<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OaInquiry */

$this->title = Yii::t('app', 'Create Inquiry');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inquiries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-inquiry-create">

    <?= $this->render('_form', [
        'model' => $model,
        'permission' => $permission,
    ]) ?>

</div>
