<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\FormInfo */

$this->title = Yii::t('app','Secure Credit Card Form');

?>
<div class="form-info-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'card_type',
            'client_name',
            'name_on_card',
            'card_number',
            'card_security_code',
            'expiry_month',
            'expiry_year',
            'amount_to_bill',
            'donation',
            'billing_address',
            'contact_phone',
            'email',
            'travel_agent',
            'tour_date',
            'create_time',
            [
              'attribute'=>'status',
              'label'=> Yii::t('app', 'Status'),
              'format' => 'raw',
              'value' => Yii::$app->params['card_status'][$model->status],
            ],
            'note',
        ],
    ]) ?>

</div>
