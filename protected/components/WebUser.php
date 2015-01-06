<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 06.01.2015
 * Time: 17:54
 */
class WebUser extends CWebUser
{
    private $_model = null;

    function getRole()
    {
        if ($user = $this->getModel()) {
            // в таблице User есть поле role
            return $user->role;
        }
    }

    function getUsername()
    {
        if ($user = $this->getModel()) {
            // в таблице User есть поле role
            return $user->username;
        }
    }

    function getEmail()
    {
        if ($user = $this->getModel()) {
            // в таблице User есть поле role
            return $user->email;
        }
    }

    private function getModel()
    {
        if (!$this->isGuest && $this->_model === null) {
            $this->_model = Users::model()->findByPk($this->id, array('select' => 'role'));
        }

        return $this->_model;
    }
}