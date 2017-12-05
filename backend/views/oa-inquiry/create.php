<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OaInquiry */

$this->title = Yii::t('app', 'Create Oa Inquiry');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Oa Inquiries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-inquiry-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
