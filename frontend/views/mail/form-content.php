<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\FormInfo */

$this->title = Yii::t('app','Content Form');


?>
<div class="form-info-view">


  <table id="w0" class="table table-striped table-bordered detail-view">
    <tbody>
    <?php foreach ($content as $key => $value) { ?>
      <tr><th><?=$key?></th><td><?=$value?></td></tr>
    <?php } ?>
    </tbody>
  </table>

</div>
