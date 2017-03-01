<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FormCardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Form Cards');
$this->params['breadcrumbs'][] = $this->title;

$action_template = [];
if (!in_array(Yii::$app->user->identity->id, [6])) {
    $action_template[] = '{view}';
    $action_template[] = '{update}';
}
if (in_array(Yii::$app->user->identity->id, [1,2,6])) {
    $action_template[] = '{delete}';
}
?>
<div class="form-card-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'amount_to_bill',
            'tour_date',
            'client_name',
            'travel_agent',

            // [
            //     'attribute'=>'Title',
            //     'value' => function ($data) {
            //         $title =  "{$data['amount_to_bill']}-{$data['tour_date']}-{$data['client_name']}-Agent:{$data['travel_agent']}";

            //         return $title;
            //     }
            // ],
            // 'name_on_card',
            // 'card_number',
            // 'card_security_code',
            // 'expiry_month',
            // 'expiry_year',
            // 'billing_address',
            // 'contact_phone',
            // 'email:email',
            // 'card_holder_email:email',
            [
                'attribute'=>'status',
                'filter'=> Yii::$app->params['card_status'],
                'value' => function ($data) {
                    return Yii::$app->params['card_status'][$data['status']];
                }
            ],
            'create_time',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => join(' ', $action_template),
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        return Url::to(['form-card/view', 'id'=>$model->id]);
                    }
                    if ($action === 'update') {
                        return Url::to(['form-card/update', 'id'=>$model->id]);
                    }
                    if ($action === 'delete') {
                        return Url::to(['form-card/delete', 'id'=>$model->id]);
                    }
                    
                },
            ],
        ],
    ]); ?>
</div>
