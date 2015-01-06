<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    // Будем хранить id.
    protected $_id;

    // Данный метод вызывается один раз при аутентификации пользователя.
    public function authenticate()
    {
        // Производим стандартную аутентификацию, описанную в руководстве.
        $user = Users::model()->find('LOWER(username)=?', array(strtolower($this->username)));

        if (!$user)
            $user = Users::model()->find('LOWER(email)=?', array(strtolower($this->username)));

        if (crypt($this->password, $user->password) === $user->password) {
            // В качестве идентификатора будем использовать id, а не username,
            // как это определено по умолчанию. Обязательно нужно переопределить
            // метод getId(см. ниже).
            $this->_id = $user->id;

            $this->setState('username', $user->username);
            $this->setState('email', $user->email);
            $this->setState('role', $user->role);

            $this->errorCode = self::ERROR_NONE;

        } else {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }

        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }
}