<?php

class UsersController extends Controller
{
    public $layout = '//layouts/main';

    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('login','recovery','logout','register','captcha', 'password'),
                'users'=>array('*'),
            ),
            array('allow',
                'actions'=>array(
                    'settings',
                    'upgradelevel',
                ),
                'users'=>array('@'),
            ),
            array('allow',
                'actions'=>array('manage','update'),
                'users'=>array('@'),
                'expression'=>'Yii::app()->user->isAdmin()'
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function filters() {
        return array(
            'accessControl',
            array('StartFilter - login, register, recovery, logout, settings, captcha')
        );
    }

    public function actions(){
        return array(
            'captcha'=>array(
                'class'=>'CCaptchaAction',
            ),
        );
    }

	public function actionLogin()
	{

        $model = new LoginForm;

        $this->performAjaxValidation($model, 'login-form');

        if(isset($_POST['LoginForm'])){
            $model->attributes=$_POST['LoginForm'];
            if($model->validate() && $model->login())
                $this->redirect(array('/lits/user'));
        }

		$this->render('login', array(
            'model'=>$model
        ));
	}

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect('/');
        //$this->redirect(Yii::app()->homeUrl);
    }

	public function actionRecovery()
	{
        $model = new RecoveryForm;

        $this->performAjaxValidation($model, 'recovery-form');

        if(isset($_POST['RecoveryForm'])){
            $model->attributes=$_POST['RecoveryForm'];
            if($model->validate()){
                $model->sendMail();

                Yii::app()->user->setFlash('success', 'Сообщение отправлено');

                $this->refresh();
            }
        }

		$this->render('recovery', array(
            'model'=>$model
        ));
	}

    public function actionPassword($hash, $email)
    {


        $recovery = Recovery::model()->findByAttributes(array('hash'=>$hash));
        if($recovery===null)
            throw new CHttpException(404, 'Запрос не может быть обработан');

        $user = Users::model()->findByPk($recovery->user_id);
        if($user===null || $user->email!==$email)
            throw new CHttpException(404, 'Запрос не может быть обработан');

        $model = new PasswordForm;

        $this->performAjaxValidation($model, 'password-form');

        if(isset($_POST['PasswordForm'])){
            $model->attributes = $_POST['PasswordForm'];
            $model->setUser($user);
            if($model->validate()){
                $model->savePassword();

                $recovery->delete();

                $this->redirect(array('/'));
            }
        }

        $this->render('password', array(
            'model'=>$model
        ));
    }

	public function actionRegister($id=null)
	{
        if(!Yii::app()->user->isGuest)
            $this->redirect('/');


        $model = new Users('register');


        $this->performAjaxValidation($model, 'register-form');

        if(isset($_POST['Users'])){
            $model->attributes=$_POST['Users'];

            if($model->save(true,array('email','password','name','password2','created'))){

                $identity = new UserIdentity($_POST['Users']['email'],$_POST['Users']['password']);
                $identity->authenticate();

                if($identity->errorCode===UserIdentity::ERROR_NONE){
                    Yii::app()->user->login($identity,3600*24*30);

                    $this->notificateadmin(1,$model->id);

                    $this->redirect('/');
                } else
                    $this->redirect(array('users/login'));
            }
        }

		$this->render('register', array(
            'model'=>$model
        ));
	}

	public function actionSettings()
	{
        /** @var Users $model */
        $model = Yii::app()->user->getModel();

        $attributes = array('name', 'new_password', 'new_password2');

        if(isset($_POST['Users'])){
            $model->attributes = $_POST['Users'];

            if($model->validate($attributes)){
                if($model->new_password)
                    $model->password = CPasswordHelper::hashPassword($model->new_password);

                if($model->save(true,$attributes)){
                    Yii::app()->user->setFlash('success', 'Настройки обновлены');

                    $this->refresh();
                }
            }
        }

		$this->render('settings', array(
            'model'=>$model
        ));
	}

    public function actionManage()
    {
        $model = new Users('search');
        $model->unsetAttributes();

        if(isset($_GET['Users']))
            $model->attributes = $_GET['Users'];

        $this->render('manage', array(
            'model'=>$model
        ));
    }

    public function actionUpdate($id)
    {
        $model = Users::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404, 'Пользователь не найден');

        if(isset($_POST['Users'])){
            $model->attributes = $_POST['Users'];
            $model->save();
        }

        $this->render('update', array(
            'model'=>$model
        ));
    }

    protected function performAjaxValidation($model, $form)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']===$form)
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}