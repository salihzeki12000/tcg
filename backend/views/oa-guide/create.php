<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OaGuide */

$this->title = Yii::t('app', 'Create Guide');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Guides'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-guide-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
