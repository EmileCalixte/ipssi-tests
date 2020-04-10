<?php

namespace app\controllers;

use app\models\Contact;
use app\models\forms\EditContactForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;
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
    public function actionIndex()
    {
        $contacts = Contact::find()->orderBy(['email' => SORT_ASC])->all();

        return $this->render('index', [
            'contacts' => $contacts,
        ]);
    }

    public function actionCreateContact()
    {
        $model = new EditContactForm();

        if(Yii::$app->request->isPost && $model->load($_POST) && $model->validate()) {
            $contact = new Contact();
            $contact->email = $model->email;
            $contact->firstname = $model->firstname;
            $contact->lastname = $model->lastname;
            $contact->phone_number = $model->phoneNumber;
            if($contact->save()) {
                Yii::$app->session->setFlash('success', 'Contact successfully created');
                return $this->redirect('/');
            }

            Yii::$app->session->setFlash('error', 'An error occurred while creating this contact');
        }

        return $this->render('edit-contact', [
            'model' => $model,
        ]);
    }

    public function actionEditContact($id)
    {
        $contact = Contact::findOne(['id' => $id]);

        if(is_null($contact)) {
            throw new NotFoundHttpException('Contact not found');
        }

        $model = new EditContactForm();

        $model->email = $contact->email;
        $model->firstname = $contact->firstname;
        $model->lastname = $contact->lastname;
        $model->phoneNumber = $contact->phone_number;

        if(Yii::$app->request->isPost && $model->load($_POST) && $model->validate()) {
            $contact->email = $model->email;
            $contact->firstname = $model->firstname;
            $contact->lastname = $model->lastname;
            $contact->phone_number = $model->phoneNumber;
            if($contact->save()) {
                Yii::$app->session->setFlash('success', 'Contact successfully edited');
                return $this->redirect('/');
            }

            Yii::$app->session->setFlash('error', 'An error occurred while saving this contact');
        }

        return $this->render('edit-contact', [
            'model' => $model,
            'contact' => $contact,
        ]);
    }

    public function actionDeleteContact()
    {
        if(!Yii::$app->request->isPost) {
            throw new MethodNotAllowedHttpException();
        }

        if(!isset($_POST['contactId'])) {
            throw new BadRequestHttpException();
        }

        $contact = Contact::findOne(['id' => $_POST['contactId']]);

        if(is_null($contact)) {
            throw new NotFoundHttpException('Contact not found');
        }

        if($contact->delete()) {
            Yii::$app->session->setFlash('success', 'Contact deleted');
        } else {
            Yii::$app->session->setFlash('error', 'An error occurred while deleting this contact');
        }

        return $this->redirect('/');
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
            'contact' => null,
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
