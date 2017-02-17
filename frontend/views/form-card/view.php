<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\FormCard */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Form Cards'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-card-view container">

    <h3><?=Yii::t('app','Thank you. ')?></h3>
    <p><?=Yii::t('app','If you don\'t receive a reply within 24 hours, please check your spam folder.')?></p>
    <a href="<?= Url::toRoute(['/']) ?>"><?=Yii::t('app','back to homepage')?></a>.

</div>
