<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Posts;

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
    public function actionIndex()
    {
        $posts = Posts::find()->all();
        return $this->render('home', compact('posts'));
    }

    /**
     * Action create post
     *
     * @return void
     */
    public function actionCreate()
    {
        $post = new Posts();
        $FormData = Yii::$app->request->post();
        if($post->load($FormData)) {
            if($post->save()) {
                Yii::$app->session->setFlash('success', 'Post Published Successfully');
                return $this->redirect(['create']);
            } else {
                Yii::$app->session->setFlash('failed', 'Failed to post');
            }
        }
        return $this->render('create', compact('post'));
        
    }


    /**
     * Action view post
     *
     * @param integer $id
     * @return void
     */
    public function actionView(int $id)
    {
        $post = Posts::findOne($id);
        return  $this->render('view', compact('post'));
    }

    /**
     * ACtion update post
     *
     * @param integer $id
     * @return void
     */
    public function actionUpdate(int $id)
    {
        $post = Posts::findOne($id);
        if($post->load(Yii::$app->request->post()) && $post->save()) {
            Yii::$app->session->setFlash('success', 'Post update successfully');
          return  $this->redirect(['update', 'id' => $post->id, compact('post')]);
        }
        return  $this->render('update', compact('post'));
    }

    /**
     * Action delete post
     *
     * @param integer $id
     * @return void
     */
    public function actionDelete(int $id)
    {
        $post = Posts::findOne($id)->delete();
        if($post) {
            Yii::$app->session->setFlash('success', 'Post successfully deleted');
            return $this->redirect(['index']);
        }
        Yii::$app->session->setFlash('failed', 'Post failed to delete');
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
}
