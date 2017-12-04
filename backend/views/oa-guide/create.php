<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OaGuide */

$this->title = Yii::t('app', 'Create Oa Guide');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Oa Guides'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-guide-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
