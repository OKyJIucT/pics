<?php

require_once 'protected/vendor/autoload.php';

class SiteController extends Controller
{
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'error', 'login', 'reg'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('logout'),
                'users' => array('@'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('test'),
                'roles' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $array = array(
            'criteria' => array(
                'order' => 'date DESC'
            ),
            'pagination' => array(
                'pageSize' => 18,
            )
        );

        $dataProvider = new CActiveDataProvider('Image', $array);
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }


    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    public function actionReg()
    {
        $model = new Users;
        $model->scenario = 'reg';

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'users-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['Users'])) {

            $model->attributes = $_POST['Users'];
            $model->password = Users::cryptPass($_POST['Users']['password']);

            if ($model->save() && $model->validate()) {

                $auth = new LoginForm;
                $auth->attributes = $_POST['Users'];

                if ($auth->validate() && $auth->login())
                    $this->redirect('/');
            }

            $model->password = $_POST['Users']['password'];
        }

        $this->render('reg', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionTest()
    {
        $criteria = new CDbCriteria();
        $data = Image::model()->findAll($criteria);

        $i = 0;
        foreach ($data as $item) {
            $file = Y::md5Dir($item->date) . $item->file;

            $sub = md5($item->category->slug);
            $dirWallpappers = 'static/wallpapers/' . $sub;
            if (!is_dir($dirWallpappers)) mkdir($dirWallpappers, 0755, true);

            $newfile = $dirWallpappers . '/' . $item->file;

            if (@copy($file, $newfile)) {
                unlink($file);
                $i++;
            }
        }

        echo "\nВсего перемещено файлов " . $i;

        $this->render('test');
    }

    public function actionUploads()
    {
        $thumbs = CUploadedFile::getInstancesByName('files');
        $result = Image::saveImage($thumbs, $category_id);

        echo $result;
    }

}