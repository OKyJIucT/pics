<?php

/**
 * Created by PhpStorm.
 * User: Kohone
 * Date: 31.01.2015
 * Time: 14:43
 */
class ColorsController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl'
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
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions' => array('view'),
                'users' => array('*'),
            ),
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'update', 'create', 'admin', 'delete'),
                'roles' => array('admin'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionView($color)
    {
        $this->pageTitle = 'Обои по цвету #' . $color;

        $array = array(
            'criteria' => array(
                'condition' => 'color = :color',
                'params' => array(':color' => $color)
            ),
            'pagination' => array(
                'pageSize' => 18,
            )
        );

        $dataProvider = new CActiveDataProvider('Colors', $array);

        $this->render('view', array(
            'dataProvider' => $dataProvider,
            'color' => $color
        ));

    }
}