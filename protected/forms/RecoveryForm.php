<?php

class RecoveryForm extends CFormModel {

    public $email;

    public $_user;

    public function rules()
    {
        return array(
            array('email', 'required'),
            array('email', 'email', 'checkPort'=>true),
            array('email', 'exists')
        );
    }

    public function exists($attribute, $params=array())
    {
        $value = $this->$attribute;

        $this->_user = Users::model()->findByAttributes(array('email'=>$value));
        if($this->_user===null)
            $this->addError($attribute, 'Такой Email не существует');
    }

    public function attributeLabels()
    {
        return array(
            'email'=>'Ваш Email'
        );
    }

    public function sendMail()
    {
        $model = Recovery::model()->findByAttributes(array('user_id'=>$this->_user->id));
        if($model===null){
            $model = new Recovery;
            $model->user_id = $this->_user->id;
            $model->hash = sha1(microtime().'_'.$this->_user->id);
            $model->save();
        }

        $url = Yii::app()->getBaseUrl(true).'/password?' . http_build_query(array('hash'=>$model->hash, 'email'=>$this->email));

        $email = Yii::app()->params['adminEmail'];

        $message = new YiiMailMessage;
        $message->setBody('<h3>Восстановление пароля</h3><p>Вы запросили восстановление пароля для вашего аккаунта.</p>Для восстановления пароля перейдите по <a href="'.$url.'">этой ссылке</a>', 'text/html');
        $message->subject = 'Восстановление пароля';
        $message->addTo($this->email);
        $message->setFrom(array($email=>''));

        Yii::app()->mail->send($message);
    }
}