<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{

    // public function beforeAction($action)
    // {

    //     return true;
    // }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'pageCache' => [
                'class' => 'yii\filters\PageCache',
                'only' => ['index'],
                'duration' => 60,
                'variations' => [
                    Yii::$app->language,
                    Yii::$app->params['currency'],
                    Yii::$app->params['is_mobile'],
                ],
                'enabled' => false,
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $slides_query = \common\models\Homepage::find()->where(['type'=>HOMEPAGE_TYPE_SLIDE, 'status'=>DIS_STATUS_SHOW]);
        $slides = $slides_query
            ->orderBy('priority DESC')
            ->all();

        $slides_query = \common\models\Homepage::find()->where(['type'=>HOMEPAGE_TYPE_AD, 'status'=>DIS_STATUS_SHOW]);
        $ads = $slides_query
            ->orderBy('priority DESC')
            ->all();

        $faq_query = \common\models\Article::find()->where(['type'=>ARTICLE_TYPE_FAQ, 'status'=>DIS_STATUS_SHOW]);
        $faq_query->andWhere("FIND_IN_SET('".REC_TYPE_MUST_VISIT."', rec_type)");
        $faq = $faq_query
            ->orderBy('priority DESC, create_time DESC')
            ->all();

        $article_query = \common\models\Article::find()->where(['type'=>ARTICLE_TYPE_ARTICLE, 'status'=>DIS_STATUS_SHOW]);
        $articles = $article_query
            ->orderBy('priority DESC, create_time DESC')
            ->limit(1)
            ->all();

        $themes_query = \common\models\Theme::find()->where(['status'=>DIS_STATUS_SHOW]);
        $themes = $themes_query
            ->orderBy('priority DESC, create_time ASC')
            ->all();

        $tours = [];
        if (($mp_theme = \common\models\Theme::find()->where(['id' => TOUR_THEMES_MOST_POPULAR])->One()) !== null)
        {
            if (!empty($mp_theme['use_ids'])) {
                $tour_ids = explode(',', $mp_theme['use_ids']);
                $condition = array();
                $condition['status'] = DIS_STATUS_SHOW;
                $condition['type'] = TOUR_TYPE_NORMAL;
                $condition['id'] = $tour_ids;
                $query = \common\models\Tour::find()->where($condition);
                $tours = $query
                ->orderBy([new \yii\db\Expression('FIELD (id, ' . implode(',', $tour_ids) . ')')])
                ->limit(6)
                ->all();
            }
        }


        $cities_map = \common\models\Tools::getMostPopularCities(9);


        return $this->render('index',['slides'=>$slides, 'faq'=>$faq, 'articles'=>$articles, 'ads'=>$ads, 'themes'=>$themes, 'tours'=>$tours, 'cities_map'=>$cities_map]);
    }

    public function actionCurrency()
    {
        return $this->redirect(['/']);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionSettoursight()
    {
        $condition = array();
        $condition['type'] = ALBUM_TYPE_SIGHT;
        $condition['status'] = DIS_STATUS_SHOW;
        $query = \common\models\Album::find()->where($condition);
        $sights = $query
            ->all();

        $itineraries = \common\models\Itinerary::find()
        ->all();

        foreach ($itineraries as $itinerarie) {
            $content = $itinerarie['description'];
            foreach ($sights as $sight) {
                $to_url = '';
                if (ALBUM_TYPE_SIGHT == $sight['type']) {
                    $to_url = \yii\helpers\Url::toRoute(['sight/view', 'url_id'=>$sight['url_id']]);
                }
                elseif (ALBUM_TYPE_ACTIVITY == $sight['type']){
                    $to_url = \yii\helpers\Url::toRoute(['activity/view', 'url_id'=>$sight['url_id']]);
                }
                if (!empty($to_url)) {
                    $content = str_replace("<span style=\"color: rgb(227, 108, 9);\">{$sight['name']}</span>",
                     "<a class=\"sight\" href=\"{$to_url}\"  target=\"_blank\">{$sight['name']}</a>",
                     $content);
                }
            }
            $itinerarie->description = $content;
            $itinerarie->save();
        }
        echo "done";exit;
    }
}
