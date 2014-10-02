<?php
class WebUser extends CWebUser {

    /** @var $_model Users */
    private $_model;

    public function init()
    {
        parent::init();

        if($this->_model===null && !$this->isGuest)
            $this->_model = Users::model()->findByPk($this->id);
    }

    public function checkAccess($operation,$params=array(),$allowCaching=true){
        if (empty($this->id))
            return false;

        $role = $this->getState("role", 'buyer');
        if ($role === 'admin')
            return true;

        if(isset($params['id']) && $params['id']==$this->id && $operation === $role)
            return true;

        return $operation === $role;
    }

    public function isAdmin()
    {
        return $this->_model ? $this->_model->role==Users::ADMIN : false;
    }

    public function isBanned()
    {
        return $this->_model ? $this->_model->role==Users::BANNED : false;
    }

    public function getModel()
    {
        return $this->_model;
    }
}
