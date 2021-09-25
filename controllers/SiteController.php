<?php

namespace app\controllers;

use DateTime;
use Yii;
use yii\filters\AccessControl;
use yii\rest\IndexAction;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
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
     * {@inheritdoc}
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
     * @return string
     */
    public function actionIndex($action = 'week')
    {
        $today = date("Y-m-d");
        $date = new DateTime($today);

        if ($action === 'week') {

            $date->modify('-1 week');
            $date_before = $date->format('Y-m-d');
            return $this->render('index', [

                'date_before' => $date_before,
                'today' => $today,
                'name' => 'Неделя',
            ]);
        }
        elseif ($action === 'weeks2') {

            $date->modify('-2 week');
            $date_before = $date->format('Y-m-d');
            return $this->render('index', [
                'date_before' => $date_before,
                'today' => $today,
                'name' => '2 Недели',
            ]);
        }
        elseif ($action === 'month') {

            $date->modify('-1 month');
            $date_before = $date->format('Y-m-d');
            return $this->render('index', [
                'date_before' => $date_before,
                'today' => $today,
                'name' => 'Месяц',
            ]);
        }
        else {

            $date->modify('-2 month');
            $date_before = $date->format('Y-m-d');
            return $this->render('index', [
                'date_before' => $date_before,
                'today' => $today,
                'name' => '2 месяца',
            ]);
        }
    }


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
