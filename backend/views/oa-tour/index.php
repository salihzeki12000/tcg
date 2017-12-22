<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OaTourSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Oa Tours');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-tour-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if($permission['canAdd']) { ?>
    <p>
        <?= Html::a(Yii::t('app', 'Create Oa Tour'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>

    <?php /*= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'inquiry_id',
            'create_time',
            'update_time',
            [
                'attribute'=>'inquiry_source',
                'filter'=> \common\models\Tools::getEnvironmentVariable('oa_inquiry_source'),
                'value' => function ($data) {
                    $oa_inquiry_source = \common\models\Tools::getEnvironmentVariable('oa_inquiry_source');
                    return $oa_inquiry_source[$data['inquiry_source']];
                }
            ],
            // 'language',
            // 'vip',
            // 'agent',
            // 'co_agent',
            // 'operator',
            // 'tour_type',
            // 'group_type',
            // 'country',
            // 'organization:ntext',
            // 'number_of_travelers',
            // 'traveler_info:ntext',
            // 'tour_start_date',
            // 'tour_end_date',
            [
                'attribute'=>'cities',
                'filter'=>ArrayHelper::map(\common\models\OaCity::find()->asArray()->all(), 'id', 'name'),
                'value' => function ($data) {
                    $cities = ArrayHelper::map(\common\models\OaCity::find()->where(['id' => explode(',', $data['cities'])])->all(), 'id', 'name');
                    $show_cities = join(',', array_values($cities));
                    if (strlen($show_cities)>30) {
                        $show_cities = substr($show_cities,0, 30) . '...';
                    }
                    return $show_cities;
                }
            ],
            // 'contact',
            // 'email:email',
            // 'other_contact_info:ntext',
            // 'itinerary_quotation_english:ntext',
            // 'itinerary_quotation_other_language:ntext',
            // 'tour_schedule_note:ntext',
            // 'note_for_guide:ntext',
            // 'other_note:ntext',
            // 'tour_price',
            // 'payment',
            // 'stage',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        return Url::to(['oa-tour/view', 'id'=>$model->id]);
                    }
                    if ($action === 'update') {
                        return Url::to(['oa-tour/update', 'id'=>$model->id]);
                    }
                    if ($action === 'delete') {
                        return Url::to(['oa-tour/delete', 'id'=>$model->id]);
                    }
                    
                },
            ],
        ],
    ]); */?>

    <form method="get" action="<?=Url::to(['oa-tour/index'])?>">
        <div style="margin: 10px 0;">
            <label style="width: 100px;">User </label>
            <select name="user_id">
              <?php foreach ($userList as $uid => $username): ?>
                <option value="<?=$uid?>" <?= ($uid==$user_id) ? 'selected' : ''?>><?=$username?></option>
              <?php endforeach ?>
            </select>
            <label><input type="radio" name="user_type" value="1" <?= ($user_type==1) ? 'checked' : ''?>> As Agent</label>
            <label><input type="radio" name="user_type" value="2" <?= ($user_type==2) ? 'checked' : ''?>> As Co-Agent</label>
            <label><input type="radio" name="user_type" value="3" <?= ($user_type==3) ? 'checked' : ''?>> As Operator</label>
        </div>
        <div style="margin: 10px 0;">
            <label style="width: 100px;">Year </label>
            <?php $thisYear=date("Y"); $lastYear=date("Y",strtotime(" -1 year")); $nextYear=date("Y",strtotime(" +1 year")); ?>
            <select name="date">
                <option value="<?=$lastYear?>" <?=($date==$lastYear)?'selected':''?>><?=$lastYear?></option>
                <option value="<?=$thisYear?>" <?=($date==$thisYear)?'selected':''?>><?=$thisYear?></option>
                <option value="<?=$nextYear?>" <?=($date==$nextYear)?'selected':''?>><?=$nextYear?></option>
            </select>
            <label><input type="radio" name="date_type" value="1" <?= ($date_type==1) ? 'checked' : ''?>> Tour End Date</label>
            <label><input type="radio" name="date_type" value="2" <?= ($date_type==2) ? 'checked' : ''?>> Tour Create Date</label>
        </div>
        <div style="margin: 10px 0;">
            <label style="width: 100px;">Inquiry Source </label>
            <select name="inquiry_source">
                <option value="">--All--</option>
              <?php foreach (common\models\Tools::getEnvironmentVariable('oa_inquiry_source') as $skey => $svalue): ?>
                <option value="<?=$skey?>" <?= ($inquiry_source==$skey) ? 'selected' : ''?>><?=$svalue?></option>
              <?php endforeach ?>
            </select>
            <label>Language </label>
            <select name="language">
                <option value="">--All--</option>
              <?php foreach (common\models\Tools::getEnvironmentVariable('oa_language') as $lkey => $lvalue): ?>
                <option value="<?=$lkey?>" <?= ($language==$lkey) ? 'selected' : ''?>><?=$lvalue?></option>
              <?php endforeach ?>
            </select>
        </div>
        <input class="btn btn-primary" type="submit" name="" value="Refresh">
    </form>

    <div>
        <table id="w0" class="table table-striped table-bordered detail-view">
            <thead>
                <tr>
                  <?php foreach ($summaryInfo as $key => $value): ?>
                    <th><?=$key?></th>
                  <?php endforeach ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                  <?php foreach ($summaryInfo as $key => $value): ?>
                    <td><?=$value?></td>
                  <?php endforeach ?>
                </tr>
            </tbody>
        </table>
        
    </div>

    <div>
        <ul class="ul_list_view">
        <?php $i=0; foreach ($listInfo as $listTitle => $listItem) { ?>
            <li class="li_list_view <?=($i==0)?'active':''?>"><a href="javascript:none();" data-id="list_view_<?=$i?>"><?=$listTitle?></a></li>
        <?php $i++; } ?>
        </ul>
    </div>
    <?php $i=0; foreach ($listInfo as $listTitle => $listItem) { ?>
        <div id="list_view_<?=$i?>" class="list_views" style="<?=($i>0)?'display: none;':''?>">
            <?php if ($listTitle == 'Closed Tours') { ?>
                <table id="w0" class="table table-striped table-bordered detail-view">
                    <thead>
                        <tr>
                            <th>Tour ID</th>
                            <th>Tour End Date</th>
                            <th>Stage</th>
                            <th>Agent</th>
                            <th>Co-Agent</th>
                            <th>Operator</th>
                            <th>Accounting Sales Amount</th>
                            <th>Accounting Total Cost</th>
                            <th>Accounting Hotel, Flight & Train Cost</th>
                            <th>Gross Profit</th>
                            <th>Gross Rate</th>
                            <th>General Gross Rate</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listItem as $value) { ?>
                            <tr>
                                <td><a href="<?=Url::to(['oa-tour/view', 'id'=>$value['id']])?>"><?=$value['id']?></a></td>
                                <td><?=$value['tour_end_date']?></td>
                                <td><?=$value['stage']?></td>
                                <td><?=$value['agent']?></td>
                                <td><?=$value['co_agent']?></td>
                                <td><?=$value['operator']?></td>
                                <td><?=$value['accounting_sales_amount']?></td>
                                <td><?=$value['accounting_total_cost']?></td>
                                <td><?=$value['accounting_hotel_flight_train_cost']?></td>
                                <td><?=$value['gross_profit']?></td>
                                <td><?=$value['gross_rate']?></td>
                                <td><?=$value['general_gross_rate']?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <table id="w0" class="table table-striped table-bordered detail-view">
                    <thead>
                        <tr>
                            <th>Tour ID</th>
                            <th>Contact</th>
                            <th>Tour Start Date</th>
                            <th>Tour End Date</th>
                            <th>VIP</th>
                            <th>Tour Price</th>
                            <th>Payment</th>
                            <th>Stage</th>
                            <th>Agent</th>
                            <th>Co-Agent</th>
                            <th>Operator</th>
                            <th>Task, Notice & Warning</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listItem as $value) { ?>
                            <tr>
                                <td><a href="<?=Url::to(['oa-tour/view', 'id'=>$value['id']])?>"><?=$value['id']?></a></td>
                                <td><?=$value['contact']?></td>
                                <td><?=$value['tour_start_date']?></td>
                                <td><?=$value['tour_end_date']?></td>
                                <td><?=$value['vip']?></td>
                                <td><?=$value['tour_price']?></td>
                                <td><?=$value['payment']?></td>
                                <td><?=$value['stage']?></td>
                                <td><?=$value['agent']?></td>
                                <td><?=$value['co_agent']?></td>
                                <td><?=$value['operator']?></td>
                                <td>&nbsp;</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
    <?php $i++; } ?>



</div>

<?php
$css = <<<CSS
.ul_list_view{
    padding-left: 0;
}
.ul_list_view li{
    display: inline-block;
    margin: 10px 10px;
    font-size: 20px;
}
.ul_list_view li.active a{
    font-size: 24px;
    color: #ff7800;
}
CSS;
$this->registerCss($css);
?>

<?php
$this->registerCssFile('@web/statics/css/bootstrap-datepicker3.min.css',['depends'=>['backend\assets\AppAsset']]);
$this->registerJsFile('@web/statics/js/bootstrap-datepicker.min.js',['depends'=>['backend\assets\AppAsset']]);
$js = <<<JS
    $(function(){
        $("#from_date, #end_date").attr("readonly","readonly").datepicker({ format: 'yyyy-mm-dd' });
        $(".ul_list_view a").click(function(){
            var showId = $(this).attr('data-id');
            $(".list_views").hide();
            $("#"+showId).show();
            $(".ul_list_view li").removeClass('active');
            $(this).parent("li").addClass('active');
        });
    });
JS;
$this->registerJs($js);
?>