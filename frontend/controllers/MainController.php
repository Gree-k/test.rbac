<?php
/**
 * Created by PhpStorm.
 * User: YOBA
 * Date: 15.08.2016
 * Time: 20:40
 */

namespace frontend\controllers;

use frontend\models\SignUp;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class MainController
    extends AbstractController
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signUp', 'login', 'reset'],
                'rules' => [
                    [
                        'actions' => ['login', 'signUp', 'reset'],
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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        return $this->render('Login');
    }

    public function actionLogout()
    {
        \Yii::$app->user->logout();
        $this->goHome();
    }

    public function actionSignUp()
    {
        $model = new SignUp();

        if ($model->load(\Yii::$app->request->post()) && $model->register()) {
            \Yii::$app->session->setFlash('success', 'Вы успешно зарегестрировались');
            $this->goHome();
        }

        return $this->render('sign-up', compact('model'));
    }

    public function actionReset()
    {
        return $this->render('reset');
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionContact()
    {
        return $this->render('contact');
    }
}