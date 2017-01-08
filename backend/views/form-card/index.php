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
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'card_type',
            'client_name',
            'name_on_card',
            'card_number',
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
            // 'create_time',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        return Url::to(['form-card/view', 'id'=>$model->id]);
                    }
                    if ($action === 'delete') {
                        return Url::to(['form-card/delete', 'id'=>$model->id]);
                    }
                },
            ],
        ],
    ]); ?>
</div>