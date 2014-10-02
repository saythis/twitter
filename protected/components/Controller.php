<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	public $layout='//layouts/user';

	public $menu=array();

	public $breadcrumbs=array();

    public $item;

    public $title;

    public function setTitle($title)
    {
        $this->title = $title;
    }


    public function exception($message, $error = 403)
    {
        if(Yii::app()->request->isAjaxRequest){
            echo json_encode(array(
                'success'=>false,
                'message'=>$message
            ));
            Yii::app()->end();
        } else
            throw new CHttpException($error, $message);
    }


    public function view($view, $data=NULL, $return=false, $processOutput=false)
    {
        if(Yii::app()->request->isAjaxRequest){
            $this->renderPartial($view, $data, $return, $processOutput);
        } else
            $this->render($view, $data, $return);
    }

    protected function performAjaxValidation($model, $form)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']===$form)
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    protected function notificateadmin($entity_type,$entity_id=0)
    {
        if(!Yii::app()->params['sendNoteToAdmin']) return false;

        $message='';
        switch($entity_type)
        {
            case 1:
                $message='Пользователь зарегистрировался. Его страница /user'.$entity_id;
                break;
            case 2:
                $message='Добавлена запись. Посмотреть /lit/view/'.$entity_id;
                break;
            default:
                $message='Чтото произошло';
        }

        $email = Yii::app()->params['adminEmail'];

        $message = new YiiMailMessage;
        $message->setBody($message, 'text/html');
        $message->subject = 'Событие на сайте';
        $message->addTo($email);
        $message->setFrom(array($email=>''));

        Yii::app()->mail->send($message);
    }
}
