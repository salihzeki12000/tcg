<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OaTourSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tours');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oa-tour-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if($permission['isAdmin']) { ?>
    <p>
        <?= Html::a(Yii::t('app', 'Create Tour'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>
    
    <form method="get" action="<?=Url::to(['oa-tour/view'])?>" target="_blank">
        <div style="margin: 30px 0 10px;">
            <label style="width: 100px;">View tour T</label>
	    	<input name="id" type="text" size="10" style="margin-right: 10px" placeholder="Tour ID" />
			<input class="btn btn-primary" type="submit" name="" value="Go">
	    </div>
	</form>
	
	<div><hr style="border-top-color: #dee3e6"></div>

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
            <label style="width: 100px;">Date </label>
            <select name="month">
	            <option value='' <?= empty($month) ? 'selected' : '' ?>>--All--</option>
	            <?php for($i=1; $i<13; $i++): ?>
                <option value="<?= ($i<=9) ? '0'.$i : $i; ?>" <?= ($month == $i) ? 'selected' : '' ?>><?= DateTime::createFromFormat('!m', $i)->format('F'); ?></option>
                <?php endfor; ?>
            </select>
            
            <?php $thisYear=date("Y"); $lastYear=date("Y",strtotime(" -1 year")); $nextYear=date("Y",strtotime(" +1 year")); ?>
            <select name="year" style="margin-right: 20px">
                <option value="<?=$lastYear?>" <?=($year==$lastYear)?'selected':''?>><?=$lastYear?></option>
                <option value="<?=$thisYear?>" <?=($year==$thisYear)?'selected':''?>><?=$thisYear?></option>
                <option value="<?=$nextYear?>" <?=($year==$nextYear)?'selected':''?>><?=$nextYear?></option>
            </select>
            
            <label><input type="radio" name="date_type" value="1" <?= ($date_type==1) ? 'checked' : ''?>> Tour End Date</label>
            <label><input type="radio" name="date_type" value="2" <?= ($date_type==2) ? 'checked' : ''?>> Tour Create Date</label>
        </div>
        
        <div style="margin: 10px 0;">
	        <?php if($permission['isAdmin'] || $permission['isAccountant']): ?>
	            <label style="width: 100px;">Inquiry Source </label>
	            <select name="inquiry_source" <?= ($permission['isAdmin'] || $permission['isAccountant']) ? '' : 'disabled' ?>>
	                <option value="">--All--</option>
	              <?php foreach (common\models\Tools::getEnvironmentVariable('oa_inquiry_source') as $skey => $svalue): ?>
	                <option value="<?=$skey?>" <?= ($inquiry_source==$skey) ? 'selected' : ''?>><?=$svalue?></option>
	              <?php endforeach ?>
            </select>
			<?php endif; ?>
            
            <?php if($permission['isAdmin']): ?>
	            <label>Language </label>
	            <select name="language">
	                <option value="">--All--</option>
	              <?php foreach (common\models\Tools::getEnvironmentVariable('oa_language') as $lkey => $lvalue): ?>
	                <option value="<?=$lkey?>" <?= ($language==$lkey) ? 'selected' : ''?>><?=$lvalue?></option>
	              <?php endforeach ?>
	            </select>
			<?php endif; ?>
        </div>
        
        <div style="margin: 10px 0;">
            <label style="width: 100px;">Name/Email</label>
	    	<input name="name_or_email" value="<?= $name_or_email?>" type="text" size="50" />
	    </div>
		
        <input class="btn btn-primary" type="submit" name="" value="Refresh" style="margin-bottom: 20px">
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
        <div id="list_view_<?=$i?>" class="grid-view" style="<?=($i>0)?'display: none;':''?>">
            <?php if ($listTitle == 'Closed Tours') { ?>
                <table id="w0" class="table table-striped table-bordered detail-view">
                    <thead>
                        <tr>
                            <th>Tour ID</th>
                            <th>Tour End</th>
                            <th>Stage</th>
                            <th>Agent</th>
                            <th>Co-Agent(s)</th>
                            <th>Operator</th>
                            <th>Sales Amount</th>
                            <th>Total Cost</th>
                            <th>Hotel, Flight & Train Cost</th>
                            <th>Gross Profit</th>
                            <th>Gross Rate</th>
                            <th>General Gross Rate</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listItem as $value) { ?>
                            <tr>
                                <td><a href="<?=Url::to(['oa-tour/view', 'id'=>$value['id']])?>" target="_blank">T<?=$value['id']?></a></td>
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
                            <th>Tour Start</th>
                            <th>Tour End</th>
                            <th>VIP</th>
                            <th>Tour Price</th>
                            <th>Estimated Cost</th>
                            <th>Payment</th>
                            <th>Stage</th>
                            <th>Agent</th>
                            <th>Co-Agent(s)</th>
                            <th>Operator</th>
                            <th>Task, Notice & Warning</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listItem as $value) { ?>
                            <tr>
                                <td><a href="<?=Url::to(['oa-tour/view', 'id'=>$value['id']])?>" target="_blank">T<?=$value['id']?></a></td>
                                <td><?=$value['contact']?></td>
                                <td><?=$value['tour_start_date']?></td>
                                <td><?=$value['tour_end_date']?></td>
                                <td><?=$value['vip']?></td>
                                <td><?=$value['tour_price']?></td>
                                <td><?=$value['estimated_cost']?></td>
                                <td><?=$value['payment']?></td>
                                <td><?=$value['stage']?></td>
                                <td><?=$value['agent']?></td>
                                <td><?=$value['co_agent']?></td>
                                <td><?=$value['operator']?></td>
                                <td>
	                                <?php
		                            $now = time();
		                            $secondsInOneDay = 86400;
		                            
		                            // if task is overdue
		                            if($value['task_remind'] && $value['task_remind_date']):
		                            	$taskRemindDate = strtotime($value['task_remind_date']);
		                            	if($now >= $taskRemindDate):
		                            		echo '<div class="due-task-notice">Due task: ' . $value['task_remind'].'</div>';
		                            	endif;
		                            endif;
		                            
		                            // if information is missing
									if(empty($value['language']) ||
									   empty($value['agent']) ||
									   empty($value['tour_price']) ||
									   $value['tour_price'] == '0.00' ||
									   empty($value['estimated_cost']) ||
									   $value['estimated_cost'] == '0.00' ||
									   empty($value['tour_type']) ||
									   empty($value['tour_start_date']) ||
									   empty($value['tour_end_date']) ||
									   empty($value['cities']) ||
									   empty($value['number_of_travelers']) ||
									   empty($value['contact']) ||
									   empty($value['email'])):
										echo '<div class="other-notice">Missing important info!</div>';
	                            	endif;
		                            
		                            // if tour hasn't been closed after 3 months
	                            	if($permission['isAdmin'] || $permission['isAccountant']):
		                            	$tourEndDate = $value['tour_end_date'];
		                            	$thirdMonth = date('Y-m-01', strtotime("$tourEndDate +3 month"));
		                            	$dateThirdMonth = strtotime(date($thirdMonth));
		                            	if($now >= $dateThirdMonth && !$value['close']):
		                            		echo '<div class="other-notice">Needs to be closed!</div>';
		                            	endif;
									endif;
	                            	
		                            // needs pre-tour confirmation OR tour has ended and stage hasn't been changed
	                            	if($permission['isAdmin'] || $permission['isAgent'] || $permission['isOperator']):
		                            	$tourStartDate = strtotime($value['tour_start_date']);
		                            	$tourEndDate = strtotime($value['tour_end_date']);
		                            	if(
		                            		((($tourStartDate - $now) / $secondsInOneDay) <= 15 && $value['stage'] == 'Need to Schedule')
											||
											((($tourStartDate - $now)/$secondsInOneDay) <= 7 && $value['stage'] == 'All Scheduled & Need Pre-Tour Confirm')
											||
											((($now - $tourEndDate)/$secondsInOneDay) >= 3 && $value['stage'] == 'Pre-Tour Confirmed & Ready to Go')
										):
		                            		echo '<div class="other-notice">Abnormal tour stage!</div>';
		                            	endif;
	                            	endif;
	                            	
	                            	// if payments missing
									if($value['tour_price'] != $value['total_payments']):
										echo '<div class="other-notice">Tour price != total payments!</div>';
	                            	endif;
	                            	
	                            	// if payment(s) overdue
									if($value['payment_overdue'] == 1):
										echo '<div class="other-notice">Payment(s) overdue!</div>';
	                            	endif;
	                            	
	                            	// if no confirmed payments
									if($value['no_confirmed_payments'] == 1):
										echo '<div class="other-notice">No confirmed payment!</div>';
	                            	endif;
	                            	
	                            	// if low profit risk
	                            	if(!empty($value['tour_price'])):
										if(!$value['close'] && (($value['tour_price'] - $value['estimated_cost'])/$value['tour_price']) < 0.15):
											echo '<div class="other-notice">Low profit risk!</div>';
		                            	endif;
	                            	endif;
	                            	
		                            // if Accounting Profit != Confirmed Profit!
	                            	if($permission['isAdmin'] || $permission['isAccountant']):
	                            		// number_format here avoids a situation where the comparison returns false when the result of both subtractions is actually the same
										if(number_format($value['pay_confirmed_amount'] - $value['cost_confirmed_amount'], 2) != number_format($value['pay_accounting_amount'] - $value['cost_accounting_amount'], 2)):
											echo '<div  class="other-notice">Accounting Profit != Confirmed Profit</div>';
		                            	endif;
	                            	endif;
		                           	?>
	                            </td>
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
            $(".grid-view").hide();
            $("#"+showId).show();
            $(".ul_list_view li").removeClass('active');
            $(this).parent("li").addClass('active');
        });
    });
JS;
$this->registerJs($js);
?>