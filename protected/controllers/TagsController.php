<?php

class TagsController extends Controller
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

    public function actionView($slug)
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'slug=:slug';
        $criteria->params = array(':slug' => $slug);
        $tag = Tags::model()->find($criteria);

        $this->pageTitle = 'Обои по тегу "' . $tag->name . '"';

        $array = array(
            'criteria' => array(
                'condition' => 'slug = :slug',
                'params' => array(':slug' => $slug)
            ),
            'pagination' => array(
                'pageSize' => 18,
            )
        );

        $dataProvider = new CActiveDataProvider('Tags', $array);

        $this->render('view', array(
            'dataProvider' => $dataProvider,
        ));

    }
}