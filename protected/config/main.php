<?php

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'HD обои для рабочего стола',
    'theme' => 'classic',
    'id' => 'wallpapper-pics',

    // preloading 'log' component
    'preload' => array('log'),

    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool
        'gii' => require(dirname(__FILE__) . '/gii.php'),
        'rbac' => array(
            'class' => 'application.modules.rbacui.RbacuiModule',
            'userClass' => 'Users',
            'userIdColumn' => 'id',
            'userNameColumn' => 'username',
            'rbacUiAdmin' => true,
            'rbacUiAssign' => true,
        ),
    ),

    // application components
    'components' => array(
        'clientScript' => array(
            'packages' => array(
                // Уникальное имя пакета
                'upload' => array(
                    // Где искать подключаемые файлы JS и CSS
                    'baseUrl' => '/static/',
                    'js' => array('js/upload.min.js'),
                    'css' => array('css/fileupload.css', 'css/fileupload-ui.css'),
                    'depends' => array('jquery'),
                ),
            )
        ),
        'user' => array(
            'class' => 'WebUser',
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'urlSuffix' => '.html',
            'rules' => array(
                '' => 'site/index',
                '<action:(login|logout|reg|test)>' => 'site/<action>',
                'category/<slug>' => 'category/view',
                'category/<slug>/<id:\d+>-<title:.*?>' => 'category/image',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            )
        ),

        'db' => require(dirname(__FILE__) . '/database.php'),

        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'authManager' => array(
            'class' => 'CDbAuthManager',
            'connectionID' => 'db',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                // uncomment the following to show log messages on web pages
                /*
                array(
                    'class'=>'CWebLogRoute',
                ),
                */
            ),
        ),

    ),

    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
    ),
);
