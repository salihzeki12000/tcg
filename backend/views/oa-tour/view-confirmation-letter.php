<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\OaTour */


$this->title = 'CL T' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tours'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="oa-tour-view">
	<div id="bar" style="margin-top: 30px; ">
		<?php
		$types = Yii::$app->params['oa_book_cost_type'];
		$models = $dataProviderBC->getModels();
		
		// since we want to show guides and agencies together, i replace the agency type (3) with guide type (1)...
		foreach($models as $key => $value):
			$models[$key]['type'] = ($value['type'] == 3) ? 1 : $value['type'];
		endforeach;
		
		// ... then sort the array
		array_multisort(array_column($models, 'type'), SORT_ASC, array_column($models, 'start_date'), SORT_ASC, $models);

		// initialize each type with a 0, meaning that it has not been printed
		foreach($types as $type):
			$types[$type] = 0;
		endforeach;
		
		foreach($models as $mod):

			$type = Yii::$app->params['oa_book_cost_type'][$mod['type']];
			
			if(!$types[$type]):
				$sectionTitle = ($type == 'Guide' || $type == 'Hotel') ? 'Your ' . $type . '(s)' : (($type == 'Other Cost') ? 'Other' : $type);
				
	    		echo '<div class="col-lg-12 col-md-12 col-xs-12" style="margin-top: 20px"><h3>' . $sectionTitle . '</h3></div>';
	    		
	    		$types[$type] = 1;	// flag type as printed (value 1)
	    	endif;
	    	
	    	if(!empty($mod['cl_info'])):
		    	
		    	echo '<div class="col-lg-12 col-md-12 col-xs-12">';
		    	
		    	if(empty($mod['start_date']) && empty($mod['end_date'])):
		    		$date = '-';
		    	elseif(!empty($mod['start_date']) && empty($mod['end_date'])):
		    		$date = "<b>".$mod['start_date']."</b>";
		    	elseif(empty($mod['start_date']) && !empty($mod['end_date'])):
		    		$date = "<b>".$mod['end_date']."</b>";
		    	elseif($mod['start_date'] == $mod['end_date']):
		    		$date = "<b>".$mod['start_date']."</b>";
		    	else:
		    		$date = "<b>".$mod['start_date']."</b> to <b>".$mod['end_date']."</b>";
		    	endif;
		    		
		    	echo '<div class="col-lg-2 col-md-3 col-sm-6 col-xs-7" style="text-align: right">' . $date .  '</div><div class="col-lg-10 col-md-9 col-sm-6 col-xs-5" style="text-align: left">' . nl2br($mod['cl_info']) . '</div>';
		    	
		    	echo '</div>';
		    endif;
	  	endforeach;
		?>
	</div>
	
	<div style="clear: both"></div>
	
    <div style="margin-top: 70px">
	    <button class="btn btn-primary" data-clipboard-action="copy" data-clipboard-target="#bar">Copy to clipboard</button>
	</div>
</div>

<?php
$this->registerJsFile('@web/statics/js/clipboard.min.js',['depends'=>['backend\assets\AppAsset']]);
$js = <<<JS
    $(function(){
        var clipboard = new Clipboard('.btn');

	    clipboard.on('success', function(e) {
	        console.log(e);
	    });
	
	    clipboard.on('error', function(e) {
	        console.log(e);
	    });
    });
JS;
$this->registerJs($js);
?>