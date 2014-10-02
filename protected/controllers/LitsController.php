<?php

class LitsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','user'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','delete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

    public function actionUser($id=null)
    {
        if(!Yii::app()->user->isGuest&&!$id)
        {
            $id=Yii::app()->user->id;
        }

        $user=Users::model()->findByPk($id);
        if($user==null)
            throw new CHttpException(403,'Unknown user');

        $dataProvider=new CActiveDataProvider('Lits',array(
            'criteria'=>array(
                'condition'=>'user_id=:user_id',
                'params'=>array(':user_id'=>$id),
                'order'=>'id desc'
            ),
        ));


        $model=new Lits;
        if(isset($_POST['Lits']))
        {
            $model->attributes=$_POST['Lits'];
            if($model->save())
                $this->redirect(array('user','id'=>$model->user_id));
        }


        $this->render('user',array(
            'dataProvider'=>$dataProvider,
            'user'=>$user,
            'model'=>$model
        ));
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Lits;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Lits']))
		{
			$model->attributes=$_POST['Lits'];
			if($model->save())
            {
                $this->notificateadmin(2,$model->id);
				$this->redirect(array('user','id'=>$model->user_id));
            }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

        if($model->user_id!==Yii::app()->user->id)
            throw new CHttpException(403,'You shall not pass.');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Lits']))
		{
			$model->attributes=$_POST['Lits'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        $model=$this->loadModel($id);

        if($model->user_id!==Yii::app()->user->id)
            throw new CHttpException(403,'You shall not pass.');

		$model->delete();

		if(!Yii::app()->request->isAjaxRequest)
            $this->redirect(array('user'));

        exit('1');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Lits',array(
            'criteria'=>array('order'=>'id desc'),
        ));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Lits('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Lits']))
			$model->attributes=$_GET['Lits'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Lits the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Lits::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Lits $model the model to be validated
	 */
	protected function performAjaxValidation($model,$form)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='lits-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
