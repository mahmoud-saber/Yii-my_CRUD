<?php

namespace app\controllers;


use Yii;
use app\models\Posts;
use yii\web\Response;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
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
    public function actionIndex()
    {
        return $this->render('index');
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
    //////////////////action home page

    public function actionHome()
    {
        $posts = Posts::find()->all();
        return $this->render('home', ['posts' => $posts]);
    }

    public function actionCreate()
    {
        $post = new Posts();
        $data = Yii::$app->request->post();
        if ($post->load($data)) {
            if ($post->save()) {
                Yii::$app->getSession()->setFlash('message', 'created successful');
                return $this->redirect('home');
            } else {
                Yii::$app->getSession()->setFlash('message', 'Failed');
            }
        }
        return $this->render('create', ['post' => $post]);
    }

    // cteate render view page
    public function actionView($id)
    {
        $post = Posts::findOne($id);
        return $this->render('view', ['post' => $post]);
    }

    public function actionUpdate($id)
    {
        $post = Posts::findOne($id);

        if ($post->load(Yii::$app->request->post()) && $post->save()) {
            Yii::$app->getSession()->setFlash('message', 'Updated successfully');
            return $this->redirect(['home', 'id' => $post->id]);
        } else {
            return $this->render('update', ['post' => $post]);
        }
    }

    public function actionDelete($id)
    {
        $post = Posts::findOne($id)->delete();
        if ($post) {
            Yii::$app->getSession()->setFlash('message', 'Deleted successfully');
            return $this->redirect(['home']);
        }
    }
}