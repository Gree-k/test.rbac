<?php
/**
 * Created by PhpStorm.
 * User: YOBA
 * Date: 15.08.2016
 * Time: 21:27
 */

namespace frontend\models;


use common\models\User;
use yii\base\Model;

class SignUp extends Model
{
    public $username;
    public $email;
    public $password;
    public $rePassword;

    public function rules()
    {
        return [
            [['username', 'password', 'email'], 'required'],
            ['email', 'email'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['password', 'string', 'min' => 6],
            ['rePassword', 'compare', 'compareAttribute' => 'password']
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'email' => 'E-mail',
            'password' => 'Пароль',
            'rePassword' => 'Повторите пароль',

        ];
    }

    public function register()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->save();

        $auth = \Yii::$app->authManager;
        $role = $auth->getRole('user');
        $auth->assign($role, $user->getId());

        return $user || null;
    }

}