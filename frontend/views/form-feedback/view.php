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

    <center>
    	<h3><?=Yii::t('app','Thank you')?></h3>
		<p><?=Yii::t('app','We have received your feedback.')?></p>
    </center>

</div>
