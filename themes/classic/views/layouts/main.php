<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
        Yii::app()->clientScript->registerCssFile(
            Yii::app()->assetManager->publish(
                Yii::app()->request->baseUrl . 'static/css/bootstrap.min.css'
            )
        );
        Yii::app()->clientScript->registerCssFile(
            Yii::app()->assetManager->publish(
                Yii::app()->request->baseUrl . 'static/css/bootstrap-theme.css'
            )
        );

        Yii::app()->clientScript->registerPackage('jquery');
        Yii::app()->clientScript->registerPackage('jquery-ui');

        Yii::app()->clientScript->registerScriptFile(
            Yii::app()->assetManager->publish(
                Yii::app()->request->baseUrl . 'static/js/bootstrap.min.js'
            ), CClientScript::POS_END
        );
        ?>

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <title><?php echo CHtml::encode($this->pageTitle . ' - ' . Yii::app()->name); ?></title>
    </head>
    <body>

        <header>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="logo">
                            <h1><a href="/">HD <span class="color">Pics</span></a></h1>

                            <div class="hmeta">Обои для рабочего стола</div>
                        </div>
                    </div>
                    <div class="col-md-5 col-md-offset-3 col-sm-6 col-sm-offset-2">

                        <form class="form-inline" role="form">
                            <div class="form-group">
                                <input type="text" class="form-control" id="search" placeholder="Type Something...">
                            </div>
                            <button type="submit" class="btn btn-default">Search</button>
                        </form>

                    </div>
                </div>
            </div>
        </header>

        <div class="navbar bs-docs-nav" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse"
                            data-target=".bs-navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">

                    <?php

                    $this->widget('zii.widgets.CMenu', array(
                            'encodeLabel' => false,
                            'items' => array(
                                array(
                                    'label' => 'Главная',
                                    'url' => array('/site/index'),
                                    'active' => 0
                                ),

                                array(
                                    'label' => '<i class="fa fa-power-off"></i> Выход',
                                    'url' => Y::url('/site/logout'),
                                    'visible' => !Yii::app()->user->isGuest,
                                    'itemOptions' => array('class' => 'pull-right'),
                                    'active' => 0
                                ),
                                array(
                                    'label' => '<i class="fa fa-star"></i> Избранное',
                                    'url' => '#',
                                    'visible' => !Yii::app()->user->isGuest,
                                    'itemOptions' => array('class' => 'pull-right'),
                                    'active' => 0
                                ),
                                array(
                                    'label' => '<i class="fa fa-user"></i> Профиль',
                                    'url' => '#',
                                    'visible' => !Yii::app()->user->isGuest,
                                    'itemOptions' => array('class' => 'pull-right'),
                                    'active' => 0
                                ),

                                array(
                                    'label' => 'Админка <b class="caret"></b>',
                                    'url' => array('#'),
                                    'visible' => Y::checkAccess('admin'),
                                    'itemOptions' => array('class' => 'dropdown pull-right'),
                                    'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown"),
                                    'submenuOptions' => array('class' => 'dropdown-menu'),
                                    'items' => array(
                                        array(
                                            'label' => '<i class="fa fa-plus"></i> Добавить обои',
                                            'url' => Y::url('/image/create'),
                                            'visible' => Y::checkAccess('admin')
                                        ),
                                        array(
                                            'label' => '<i class="fa fa-folder"></i> Категории',
                                            'url' => Y::url('/category/admin'),
                                            'visible' => Y::checkAccess('admin')
                                        ),
                                        array(
                                            'label' => '<i class="fa fa-lock"></i> Роли',
                                            'url' => Y::url('/rbac'),
                                            'visible' => Y::checkAccess('admin')
                                        ),
                                    ),
                                    'active' => 0
                                ),

                                array(
                                    'label' => 'Регистрация',
                                    'url' => array('/site/reg'),
                                    'visible' => Yii::app()->user->isGuest,
                                    'itemOptions' => array('class' => 'pull-right'),
                                    'active' => 0
                                ),
                                array(
                                    'label' => 'Войти',
                                    'url' => array('/site/login'),
                                    'visible' => Yii::app()->user->isGuest,
                                    'itemOptions' => array('class' => 'pull-right'),
                                    'active' => 0
                                ),
                            ),
                            'htmlOptions' => array('class' => 'nav nav-pills'),
                        )
                    );
                    ?>
                </nav>
            </div>
        </div>
        <div class="container">
            <div class="text-center">
                <?php

                if (Yii::app()->controller->getId() == 'image' || (Yii::app()->controller->getId() == 'image' && $this->action->id == 'index')) {

                }
                $categories = Category::model()->findAll(array('order' => 'name ASC'));

                $categoryList = array();
                foreach ($categories as $category) {
                    $categoryList[] = array(
                        'label' => $category->name,
                        'url' => Y::url('/category/view', array('slug' => $category->slug)),
                    );
                }

                $classes = array(1 => 'btn-primary', 2 => 'btn-success', 3 => 'btn-info', 4 => 'btn-warning', 5 => 'btn-danger');
                $i = 1;
                foreach ($categoryList as $category) {
                    echo '<a class="btn ' . $classes[$i] . ' m4 pull-left" href="' . $category['url'] . '">' . $category['label'] . '</a>';
                    if ($i == 5) $i = 1;
                    else $i++;
                }
                ?>
            </div>

            <div class="clearfix"></div>
            <?php echo $content; ?>
        </div>
    </body>
</html>