<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\OaFeedback */

$this->title = Yii::t('app','Success');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Form Cards'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-card-view container">

    <center><h3><?=Yii::t('app','Thank you.')?></h3></center>
    <p><?=Yii::t('app','We have received your feedback information.')?></p>
    <a href="javascript:history.go(-1);"><?=Yii::t('app','BACK TO PREVIOUS PAGE')?></a>

</div>
