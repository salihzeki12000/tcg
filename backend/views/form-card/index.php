<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FormCardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Form Cards');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-card-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute'=>'Title',
                'value' => function ($data) {
                    $title =  "{$data['amount_to_bill']}-{$data['tour_date']}-{$data['client_name']}-Agent:{$data['travel_agent']}";

                    return $title;
                }
            ],
            // 'name_on_card',
            // 'card_number',
            // 'card_security_code',
            // 'expiry_month',
            // 'expiry_year',
            // 'amount_to_bill',
            // 'billing_address',
            // 'contact_phone',
            // 'email:email',
            // 'card_holder_email:email',
            // 'travel_agent',
            // 'tour_date',
            'status',
            'create_time',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        return Url::to(['form-card/view', 'id'=>$model->id]);
                    }
                    if ($action === 'update') {
                        return Url::to(['form-card/update', 'id'=>$model->id]);
                    }
                },
            ],
        ],
    ]); ?>
</div>
