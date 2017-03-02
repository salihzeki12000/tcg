<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\FormCard */

$this->title = $model->client_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Form Cards'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-card-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
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
            'email:email',
            'travel_agent',
            'tour_date',
            'create_time',
            'update_time',
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
