<?php

class UserIdentity extends CBaseUserIdentity
{
    public $email;
    public $password;

    private $_id;

    public function __construct($email,$password)
    {
        $this->email=$email;
        $this->password=$password;
    }

	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
        $model = Users::model()->findByAttributes(array('email'=>$this->email));
        if($model===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        elseif(!CPasswordHelper::verifyPassword($this->password, $model->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else {
            $this->_id = $model->id;
            $this->setState('name', $model->name);
            $this->errorCode=self::ERROR_NONE;
        }
		return !$this->errorCode;
	}

    public function getId()
    {
        return $this->_id;
    }
}