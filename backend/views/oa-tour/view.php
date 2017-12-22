<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\OaTour */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Oa Tours'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-tour-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if($permission['canDel']) { ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?php } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'inquiry_id',
            'create_time',
            'update_time',
            'inquiry_source',
            'language',
            'vip',
            'agent',
            'co_agent',
            'operator',
            'tour_type',
            'group_type',
            'country',
            'organization:html',
            'number_of_travelers',
            'traveler_info:html',
            'tour_start_date',
            'tour_end_date',
            'cities',
            'contact',
            'email:email',
            'other_contact_info:html',
            'itinerary_quotation_english:html',
            'itinerary_quotation_other_language:html',
            'tour_schedule_note:html',
            'note_for_guide:html',
            'other_note:html',
            'tour_price',
            'payment',
            'stage',
            'task_remind',
            'task_remind_date',
            'estimated_cost',
            'accounting_sales_amount',
            'accounting_total_cost',
            'accounting_hotel_flight_train_cost',
            'attachment:html',
            'close',
            'creator',
        ],
    ]) ?>

    <div class="form-group">
    <label class="control-label">Payment</label>
    <div id="itinerary_list">
        <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'tour_id',
                    'create_time',
                    'update_time',
                    'payer',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view}',
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'view') {
                                return Url::to(['oa-payment/view', 'id'=>$model->id]);
                            }
                            if ($action === 'delete') {
                                return Url::to(['oa-payment/delete', 'id'=>$model->id]);
                            }
                        },
                    ],
                ],
            ]); ?>
    </div>
    <?= (!$permission['canAdd']) ? '' : Html::button(Yii::t('app', 'Add Payment Item'), ['class' => 'btn btn-primary', 'onclick'=>'window.location=\''.Url::to(['oa-payment/create', 'tour_id'=>$model->id]).'\';']) ?>
    </div>

    <div class="form-group">
    <label class="control-label">Book Cost</label>
    <div id="book-cost_list">
        <?= GridView::widget([
                'dataProvider' => $dataProviderBC,
                'columns' => [
                    'tour_id',
                    'create_time',
                    'updat_time',
                    [
                        'attribute'=>'type',
                        'filter'=> Yii::$app->params['oa_book_cost_type'],
                        'value' => function ($data) {
                            return Yii::$app->params['oa_book_cost_type'][$data['type']];
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view}',
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'view') {
                                return Url::to(['oa-book-cost/view', 'id'=>$model->id]);
                            }
                            if ($action === 'delete') {
                                return Url::to(['oa-book-cost/delete', 'id'=>$model->id]);
                            }
                        },
                    ],
                ],
            ]); ?>
    </div>
    <?= (!$permission['canAdd']) ? '' : Html::button(Yii::t('app', 'Add Book Cost Item'), ['class' => 'btn btn-primary', 'onclick'=>'window.location=\''.Url::to(['oa-book-cost/create', 'tour_id'=>$model->id]).'\';']) ?>
    </div>

</div>
