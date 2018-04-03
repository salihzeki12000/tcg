<?php

namespace frontend\controllers;

use Yii;
use common\models\OaFeedback;
use common\models\OaFeedbackSearch;
use common\models\OaVoucher;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FormFeedbackController implements the CRUD actions for OaFeedback model.
 */
class FormFeedbackController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all OaFeedback models.
     * @return mixed
     */
    // public function actionIndex()
    // {
    //     $searchModel = new OAFeedbackSearch();
    //     $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    //     return $this->render('index', [
    //         'searchModel' => $searchModel,
    //         'dataProvider' => $dataProvider,
    //     ]);
    // }

    /**
     * Displays a single OaFeedback model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionSuccess($email = '')
    {

        return $this->render('view', ['email' => $email]);
    }

    /**
     * Creates a new OaFeedback model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($cd=null)
    {
	    $tour_end_date = substr($cd, 0, 4).'-'.substr($cd, 4, 2).'-'.substr($cd, 6, 2);
	    $tour_id = substr($cd, 8);
	    
        $model = new OaFeedback();

        if($model->load(Yii::$app->request->post())) {
	        
            $model->tour_id = $tour_id;
            $tourModel = \common\models\OaTour::findOne($model->tour_id);
	        
	        if(($agent = \common\models\User::findOne($tourModel->agent)) !== null) {
				$agent_mail = $agent->email;
            }

            if($model->save()) {
	            $voucher = new OaVoucher();
	            
	            if($tourModel->tour_price < 10000):
	            	$voucher->value = 200;
	            elseif($tourModel->tour_price >= 10000 && $tourModel->tour_price < 20000):
	            	$voucher->value = 200;
	            else:
	            	$voucher->value = 200;
	            endif;
	            
	            $voucher->tour_id = $tour_id;
	            $voucher->code = $voucher->generateUniqueRandomString("code", 8);
	            $voucher->used = 0;
	            $voucher->save();
	            
	            // send voucher to client
                $mail_subject = Yii::t('app','Thank you for your feedback!');
                $clientEmail[] = $tourModel->email;
                
                if($tourModel->language == 'German'):
					$language = 'de';
				elseif($tourModel->language == 'Spanish'):
					$language = 'es';
				elseif($tourModel->language == 'French'):
					$language = 'fr';
				else:
					$language = 'en';
				endif;

                Yii::$app->mailer->compose('voucher-feedback', ['voucher' => $voucher, 'language' => $language, 'contact' => explode(' ', trim($tourModel->contact))[0]])
					->setFrom(["feedback@thechinaguide.com" => "Emily France"])
					->setReplyTo("feedback@thechinaguide.com")
                    ->setTo($clientEmail) 
                    ->setSubject($mail_subject) 
                    ->send();
	            
	            
	            // send us email about a new feedback
                $mail_subject = "Feedback from {$tourModel->contact} ({$tourModel->email})";
                $receiver[] = 'feedback@thechinaguide.com';
                if(!empty($agent_mail)) {
                    $receiver[] = $agent_mail;
                }

                Yii::$app->mailer->compose('feedback', ['model' => $model]) 
                    ->setTo($receiver) 
                    ->setSubject($mail_subject) 
                    ->send();

                return $this->redirect(['success', 'email' => $tourModel->email]);
            }
            else{
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            if(!empty($tour_id) && !empty($tour_end_date)) {
	            $model->tour_id = $tour_id;
	            
                $feedback = \common\models\OaFeedback::findOne(['tour_id' => $model->tour_id]);
                if($feedback !== null) {
	                return $this->redirect(['success']);
                }
	            
                $tourModel = \common\models\OaTour::findOne($model->tour_id);
                if($tourModel === null || $tourModel->tour_end_date != $tour_end_date) {
                    throw new NotFoundHttpException();
                }
            } else {
	            throw new NotFoundHttpException();
            }
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = OaFeedback::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
