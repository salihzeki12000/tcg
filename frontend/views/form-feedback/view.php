<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\OaFeedback */

$this->title = Yii::t('app','Success');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Feedback Form'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-card-view container">

    <center>
    	<h4 style="margin-top: 50px"><?= Yii::t('app','Thank you for your feedback!') ?> <?= !empty($email) ? Yii::t('app',"A voucher has been sent to your email address")." $email." : '' ?></h4>
    </center>

</div>
