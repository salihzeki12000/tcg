<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OaInquirySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Inquiries');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-inquiry-index">

    <?php if($permission['canAdd']) { ?>
    <p>
        <?= Html::a(Yii::t('app', 'Create Inquiry'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>

    <?php if($permission['isAdmin']) { ?>
    <table id="w0" class="table table-striped table-bordered detail-view">
        <thead>
            <tr>
                <th>ID</th>
                <th>Creator</th>
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
                    <td><a href="<?=Url::to(['oa-inquiry/view', 'id'=>$value['id']])?>" target="_blank">Q<?=$value['id']?></a></td>
                    <td><?=$value['creator']?></td>
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
            <label style="width: 100px;">Year </label>
            <?php $thisYear=date("Y"); $lastYear=date("Y",strtotime(" -1 year")); $nextYear=date("Y",strtotime(" +1 year")); ?>
            <select name="date">
                <option value="<?=$lastYear?>" <?=($date==$lastYear)?'selected':''?>><?=$lastYear?></option>
                <option value="<?=$thisYear?>" <?=($date==$thisYear)?'selected':''?>><?=$thisYear?></option>
                <option value="<?=$nextYear?>" <?=($date==$nextYear)?'selected':''?>><?=$nextYear?></option>
            </select>
            <label><input type="radio" name="date_type" value="2" <?= ($date_type==2) ? 'checked' : ''?>> Inquiry Create Date</label>
            <label><input type="radio" name="date_type" value="1" <?= ($date_type==1) ? 'checked' : ''?>> Tour Start Date</label>
        </div>
        <div style="margin: 10px 0;">
            <label style="width: 100px;">Inquiry Source </label>
            <select name="inquiry_source" <?=$permission['isAdmin']?'':'disabled' ?>>
                <option value="">--All--</option>
              <?php foreach (common\models\Tools::getEnvironmentVariable('oa_inquiry_source') as $skey => $svalue): ?>
                <option value="<?=$skey?>" <?= ($inquiry_source==$skey) ? 'selected' : ''?>><?=$svalue?></option>
              <?php endforeach ?>
            </select>
            <label>Language </label>
            <select name="language" <?=$permission['isAdmin']?'':'disabled' ?>>
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
        <?php
	    $i=0;
	    
	    // get rid of inquiries OA_Accountant shouldn't see
	    if($permission['isAccountant']):
	    	$listInfo = array_diff_key($listInfo, ['Following' => 1, 'Inactive' => 1, 'Lost' => 1, 'Bad' => 1]);
	    endif;
	    
	    foreach ($listInfo as $listTitle => $listItem) {
        ?>
        
            <li class="li_list_view <?=($i==0)?'active':''?>"><a href="javascript:none();" data-id="list_view_<?=$i?>"><?=$listTitle?></a></li>
            
        <?php
	    $i++;
	    }
	    ?>
        </ul>
    </div>
    <?php $i=0; foreach ($listInfo as $listTitle => $listItem) { ?>
    
    	<?php
	    $lostOrBad = in_array($listTitle, array('Lost', 'Bad'));
	    $waitingOrBooked = in_array($listTitle, array('Waiting for Payment', 'Booked'));
	    ?>
    	
	        <div id="list_view_<?=$i?>" class="list_views" style="<?=($i>0)?'display: none;':''?>">
	            <table id="w0" class="table table-striped table-bordered detail-view">
	                <thead>
	                    <tr>
	                        <th>ID</th>
	                        <?php if($waitingOrBooked): ?><th>Tour ID</th><?php endif; ?>
	                        <th>Create Date</th>
	                        <th>Contact</th>
	                        <th>Travelers</th>
	                        <th>Start Date</th>
	                        <th>Priority</th>
	                        <th>Probability</th>
	                        <th>Inquiry Status</th>
	                        <th>Agent</th>
	                        <th>Co-Agent</th>
	                        <?php if(!$lostOrBad): ?><th>Task, Notice & Warning</th><?php endif; ?>
	                    </tr>
	                </thead>
	                <tbody>
	                    <?php foreach ($listItem as $value) { ?>
	                        <tr>
	                            <td><a href="<?=Url::to(['oa-inquiry/view', 'id' => $value['id']])?>" target="_blank">Q<?=$value['id']?></a></td>
								<?php
								if($waitingOrBooked):
									$tourId = \common\models\Tools::inquiryAssignedToTour($value['id']);
								?>
		                            <td>
			                            <?php if($tourId): ?>
			                            	<a href="<?=Url::to(['oa-tour/view', 'id' => $tourId])?>" target="_blank">T<?= $tourId ?></a>
			                            <?php else: ?>
			                            -
			                            <?php endif; ?>
			                            </td>
								<?php endif; ?>
	                            <td><?= date('Y-m-d', strtotime($value['create_time'])) ?></td>
	                            <td><?=$value['contact']?></td>
	                            <td><?=$value['number_of_travelers']?></td>
	                            <td><?=$value['tour_start_date']?></td>
	                            <td><?=$value['priority']?></td>
	                            <td><?=$value['probability']?></td>
	                            <td>
		                            <?php if(!empty($value['follow_up_record'])): ?>
			                        	<a tabindex="0" data-html="true" data-placement="left" data-toggle="popover" data-trigger="focus" title="Follow-up Record" data-content="<?= htmlspecialchars($value['follow_up_record']) ?>" style="text-decoration: underline; cursor:pointer;"><?= $value['inquiry_status_txt'] ?></a>
			                        <?php
				                    else:
				                       	echo $value['inquiry_status_txt'];
				                    endif;
				                    ?>
		                        </td>
	                            <td><?=$value['agent']?></td>
	                            <td><?=$value['co_agent']?></td>
	                            <?php if(!$lostOrBad): ?><td>
		                            <?php
		                            $now = time();
		                            $secondsInOneDay = 86400;
			                            
			                        // if there's a due task
		                            if($value['task_remind'] && $value['task_remind_date']):
		                            	$taskRemindDate = strtotime($value['task_remind_date']);
		                            	if($now >= $taskRemindDate):
		                            		echo '<div style="color: #28b500">Due task: ' . $value['task_remind'].'</div>';	
		                            	endif;
		                            endif;
		                            
		                            // if inquiry needs to be updated
		                            $updateTime = strtotime($value['update_time']);
		                            if($value['inquiry_status_txt'] == 'New' || ($value['inquiry_status_txt'] == 'Following up' && (($now - $updateTime) / $secondsInOneDay) >= 10)):
		                            	echo '<div style="color: #c55">Needs to be updated!</div>';
		                            endif;
	
		                            // if information is missing
		                            if(empty($value['inquiry_source']) ||
									   empty($value['language']) ||
									   empty($value['agent']) ||
									   empty($value['tour_start_date']) ||
									   empty($value['contact']) ||
									   empty($value['email']) ||
									   empty($value['original_inquiry'])):
										echo '<div style="color: #c55">Missing important info!</div>';
	                            	endif;
	                            	
	                            	// if expiring
	                            	$tourStartDate = strtotime($value['tour_start_date']);
	                            	
									$oa_inquiry_status = \common\models\Tools::getEnvironmentVariable('oa_inquiry_status');
									
	                            	if($oa_inquiry_status[$value['inquiry_status']] == 'Inactive' && (($tourStartDate - $now) / $secondsInOneDay) <= 60):
										echo '<div style="color: #c55">Expiring, contact for final try.</div>';
	                            	endif;
	                            	
	                            	// if expired
	                            	if(!empty($tourStartDate) && in_array($oa_inquiry_status[$value['inquiry_status']], array('New', 'Following up', 'Waiting for Payment', 'Inactive')) && (($tourStartDate - $now) / $secondsInOneDay) <= 0):
										echo '<div style="color: #c55">Expired, close or change date.</div>';
	                            	endif;
		                           	?>
			                    </td><?php endif; ?>
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
        $(".ul_list_view a").click(function(){
            var showId = $(this).attr('data-id');
            $(".list_views").hide();
            $("#"+showId).show();
            $(".ul_list_view li").removeClass('active');
            $(this).parent("li").addClass('active');
        });
    });
    /* To initialize BS3 tooltips set this below */
	$(function () { 
	    $("[data-toggle='tooltip']").tooltip(); 
	});;
	/* To initialize BS3 popovers set this below */
	$(function () { 
	    $("[data-toggle='popover']").popover(); 
	});
JS;
$this->registerJs($js);
?>