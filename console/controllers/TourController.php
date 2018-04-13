<?php
	
namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\helpers\Console;
use common\models\OaTour;
use common\models\OaTourSearch;
use yii\helpers\ArrayHelper;

class TourController extends Controller
{
    public $tour_end_date;
    
    public function options($actionID)
    {
        return ['tour_end_date'];
    }
    
    // -date=YYY-mm-dd
    public function optionAliases()
    {
        return ['date' => 'tour_end_date'];
    }
    
    public function actionSendfeedbackform()
    { 
	    if(!empty($this->tour_end_date)):
		    $clients = ArrayHelper::toArray(OaTour::find()->where(['tour_end_date' => $this->tour_end_date])->all(), [
			    'common\models\OaTour' => [
			        'id',
			        'contact',
			        'email',
			        'language',
			        'agent'
			    ],
		    ]);
	
			foreach($clients as $client):
				if($client['language'] == 'German'):
					$language = 'de';
					$subject = "Wie war Ihre Reise mit The China Guide?";
				elseif($client['language'] == 'Spanish'):
					$language = 'es';
					$subject = "¿Cómo estuvo su viaje con The China Guide?";
				elseif($client['language'] == 'French'):
					$language = 'fr';
					$subject = "Comment s'est passé votre voyage avec The China Guide?";
				else:
					$language = 'en';
					$subject = "How was your trip with The China Guide?";
				endif;
				
				if(($agent = \common\models\User::findOne($client['agent'])) !== null) {
					$agent_mail = $agent->email;
            	} else {
	            	$agent_mail = '';
            	}
            	
            	$bcc = array('feedback@thechinaguide.com', $agent_mail);
				$code = str_replace('-','',$this->tour_end_date).$client['id'];
	
	            Yii::$app->mailer->compose("request-feedback", [
		            'contact' => explode(' ', trim($client['contact']))[0],
		            'language' => $language,
		            'code' => $code,
	            ])
					->setFrom(["emily@thechinaguide.com" => "Emily France"])
					->setReplyTo("feedback@thechinaguide.com")
	                ->setTo(trim($client['email']))
	                ->setBcc($bcc)
	                ->setSubject($subject)
	                ->send();
			endforeach;
		endif;
    }
}

?>