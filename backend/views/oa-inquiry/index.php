<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OaInquirySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Oa Inquiries');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-inquiry-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if($permission['canAdd']) { ?>
    <p>
        <?= Html::a(Yii::t('app', 'Create Oa Inquiry'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>
    <?= true ? '' : GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'create_time',
            'update_time',
            'inquiry_source',
            // 'language',
            // 'priority',
            // 'agent',
            // 'co_agent',
            // 'tour_type',
            // 'group_type',
            // 'organization:ntext',
            // 'country',
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
            // 'original_inquiry:ntext',
            // 'follow_up_record:ntext',
            // 'tour_schedule_note:ntext',
            // 'other_note:ntext',
            // 'estimated_cny_amount',
            // 'probability',
            // 'inquiry_status',
            // 'close',
            // 'close_report:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        return Url::to(['oa-inquiry/view', 'id'=>$model->id]);
                    }
                    if ($action === 'update') {
                        return Url::to(['oa-inquiry/update', 'id'=>$model->id]);
                    }
                    if ($action === 'delete') {
                        return Url::to(['oa-inquiry/delete', 'id'=>$model->id]);
                    }
                    
                },
            ],

        ],
    ]); ?>


    <?php if($permission['isAdmin']) { ?>
    <table id="w0" class="table table-striped table-bordered detail-view">
        <thead>
            <tr>
                <th>ID</th>
                <th>Create Time</th>
                <th>Name</th>
                <th>Email</th>
                <th>Email Duplicate to</th>
                <th>Agent</th>
                <th>Language</th>
                <th>Inquiry Source  </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($inquiriesToAssign as $value) { ?>
                <tr>
                    <td><a href="<?=Url::to(['oa-inquiry/view', 'id'=>$value['id']])?>"><?=$value['id']?></a></td>
                    <td><?=$value['create_time']?></td>
                    <td><?=$value['contact']?></td>
                    <td><?=$value['email']?></td>
                    <td>
                        <?php if (!empty($value['same_email_ids'] )) { 
                            foreach ($value['same_email_ids'] as $eid) { ?>
                            <a href="<?=Url::to(['oa-inquiry/view', 'id'=>$eid])?>"><?=$eid?></a>
                        <?php }} ?>
                    </td>
                    <td><?=$value['agent']?></td>
                    <td><?=$value['language']?></td>
                    <td><?=$value['inquiry_source']?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php } ?>

    <h2>Inquiries</h2>
    <form method="get" action="<?=Url::to(['oa-inquiry/index'])?>">
        <div style="margin: 10px 0;">
            <label style="width: 100px;">User </label>
            <select name="user_id">
              <?php foreach ($userList as $uid => $username): ?>
                <option value="<?=$uid?>" <?= ($uid==$user_id) ? 'selected' : ''?>><?=$username?></option>
              <?php endforeach ?>
            </select>
            <label><input type="radio" name="co" value="0" <?= !$co ? 'checked' : ''?>> As Agent</label>
            <label><input type="radio" name="co" value="1" <?= $co ? 'checked' : ''?>> As Co-Agent</label>
        </div>
        <div style="margin: 10px 0;">
            <label style="width: 100px;">From </label>
            <input type="input" id="from_date" name="from_date" value="<?=$from_date?>">
            <label>To </label>
            <input type="input" id="end_date" name="end_date" value="<?=$end_date?>">
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
            <li class="li_list_view <?=($i==0)?'active':''?>"><a href="javascript:none();" data-id="list_view_<?=$listTitle?>"><?=$listTitle?></a></li>
        <?php $i++; } ?>
        </ul>
    </div>
    <?php $i=0; foreach ($listInfo as $listTitle => $listItem) { ?>
        <div id="list_view_<?=$listTitle?>" class="list_views" style="<?=($i>0)?'display: none;':''?>">
            <table id="w0" class="table table-striped table-bordered detail-view">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Contact</th>
                        <th>Number of Travelers</th>
                        <th>Tour Start Date</th>
                        <th>Priority</th>
                        <th>Probability</th>
                        <th>Inquiry Status</th>
                        <th>Agent</th>
                        <th>Co-Agent</th>
                        <th>Task, Notice & Warning</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listItem as $value) { ?>
                        <tr>
                            <td><a href="<?=Url::to(['oa-inquiry/view', 'id'=>$value['id']])?>"><?=$value['id']?></a></td>
                            <td><?=$value['contact']?></td>
                            <td><?=$value['number_of_travelers']?></td>
                            <td><?=$value['tour_start_date']?></td>
                            <td><?=$value['priority']?></td>
                            <td><?=$value['probability']?></td>
                            <td><?=$value['inquiry_status_txt']?></td>
                            <td><?=$value['agent']?></td>
                            <td><?=$value['co_agent']?></td>
                            <td>&nbsp;</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
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