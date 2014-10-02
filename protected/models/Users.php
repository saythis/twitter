<?php



/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $id
 * @property string $email
 * @property string $password
 * @property string $name
  * @property string $created

 */
class Users extends CActiveRecord
{
    const SIMPLE = 0;
    const ADMIN = 1;
    const BANNED = 2;

    public $password2;

    public $new_password;
    public $new_password2;


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('name, email, password, password2', 'required', 'on'=>'register'),
			array('email, password', 'length', 'max'=>100),

            array('username', 'required'),
            array('username', 'length', 'max'=>20, 'min'=>3),
            array('username', 'username'),
            array('username', 'unique'),
            array('name', 'name'),

            array('email', 'email','checkPort'=>true),
            array('email', 'unique'),
            array('password', 'compare', 'compareAttribute'=>'password2', 'on'=>'register'),
			array('name', 'length', 'max'=>50),
            array('new_password', 'newPassword'),
            array('created, new_password2', 'safe'),

			array('id, email, password, name, created', 'safe', 'on'=>'search'),
		);
	}

    public function name($attribute,$params=array())
    {
        $value = $this->$attribute;
        if (!preg_match('/^([\w\s]+)$/u', $value))
            $this->addError($attribute, 'Недопустимые символы');
    }

    public function newPassword($attribute, $params=array())
    {
        if(!$this->new_password)
            return false;

        if(!$this->new_password2)
            $this->addError('new_password2', 'Подверждение пароля должно быть заполнено');

        if($this->new_password!==$this->new_password2)
            $this->addError('new_password2', 'Пароли должны совпадать');
    }


    public function username($attribute, $params=array())
    {
        $urls = array('site', 'users', 'news', 'rules', 'login', 'register', 'recovery', 'settings', 'logout');

        $value = $this->$attribute;
        if(preg_match('/^ref([0-9])$/', $value) && !$this->isNewRecord)
            $this->addError($attribute, 'недопустимый адрес');
        elseif(in_array($value, $urls))
            $this->addError($attribute, 'данный адрес занят');
    }

	/**
	 * @return array relational rules.
	 */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'lits' => array(self::HAS_MANY, 'Lits', 'user_id'),
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'Email',
			'password' => 'Пароль',
			'password2' => 'Повторите пароль',
			'name' => 'Имя',
			'created' => 'Создан',
            'new_password' => 'Новый пароль',
            'new_password2' => 'Подвт. пароль',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function beforeSave()
    {

        if($this->isNewRecord){
            $this->password = CPasswordHelper::hashPassword($this->password);
            $this->created = new CDbExpression('NOW()');

        }

        return parent::beforeSave();
    }


    public function checkUsername()
    {
        if(preg_match('/^ref([0-9])$/', $this->username))
            return true;
    }

}
