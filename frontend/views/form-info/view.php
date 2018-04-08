<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\FormInfo */

$this->title = Yii::t('app','Success');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Form Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-info-view container">

    <h3><?=Yii::t('app','Thank you for your inquiry. ')?></h3>
    <p><?=Yii::t('app','If you don\'t receive a reply within 24 hours, please check your spam folder or email us at <a href="mailto:book@thechinaguide.com">book@thechinaguide.com</a>.')?></p>
    <a href="javascript:history.go(-1);"><?=Yii::t('app','BACK TO PREVIOUS PAGE')?></a>

</div>
