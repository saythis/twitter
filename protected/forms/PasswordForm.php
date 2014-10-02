<?php

class PasswordForm extends CFormModel {

    public $password;
    public $password2;

    /** @var Users */
    private $_user;

    public function rules()
    {
        return array(
            array('password, password2', 'required'),
            array('password2', 'compare', 'compareAttribute'=>'password'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'password'=>'Новый пароль',
            'password2'=>'Подтвердите новый пароль'
        );
    }

    /**
     * @param $user Users
     */
    public function setUser($user)
    {
        $this->_user = $user;
    }

    public function savePassword()
    {
        $this->_user->saveAttributes(array('password'=>CPasswordHelper::hashPassword($this->password)));
    }
}