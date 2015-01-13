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
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="/">Главная</a>

                        </li>
                        <!-- Refer Bootstrap navbar doc -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages #1 <b
                                    class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="landing-page.html">Landing Page</a></li>
                                <li><a href="pricing.html">Pricing Table</a></li>
                                <li><a href="service-3.html">Service</a></li>
                                <li><a href="support.html">Support</a></li>
                                <li><a href="sitemap.html">Sitemap</a></li>
                                <li><a href="timeline.html">Timeline</a></li>
                                <li><a href="404.html">404</a></li>
                                <li><a href="faq.html">FAQ</a></li>
                                <li><a href="register1.html">Register</a></li>
                                <li><a href="login1.html">Login</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages #2<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="coming-soon.html">Coming Soon</a></li>
                                <li><a href="features-4.html">Features</a></li>
                                <li><a href="statement.html">Statement</a></li>
                                <li><a href="tasks.html">Tasks</a></li>
                                <li><a href="resume.html">Resume</a></li>
                                <li><a href="projects.html">Projects</a></li>
                                <li><a href="make-post.html">Make Post</a></li>
                                <li><a href="events.html">Events</a></li>
                                <li><a href="error-log.html">Error Log</a></li>
                            </ul>
                        </li>
                        <li><a href="service.html">Service</a></li>
                        <li><a href="aboutus.html">About Us</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Blog <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="blog-2.html">Blog #1</a></li>
                                <li><a href="blog-4.html">Blog #1</a></li>
                                <li><a href="blog-single.html">Blog Single</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (Y::isGuest()) : ?>
                            <li><a href="/login">Вход</a></li>
                            <li><a href="/reg">Регистрация</a></li>
                        <?php else: ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle"
                                   data-toggle="dropdown"><?= Yii::app()->user->username; ?> <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <?php if (Y::checkAccess('admin')): ?>
                                        <li><a href="/image/create"><i class="fa fa-plus"></i> Добавить обои</a></li>
                                        <li><a href="/category/admin"><i class="fa fa-folder"></i> Категории</a></li>

                                        <li><a href="/rbac"><i class="fa fa-lock"></i> Роли</a></li>
                                    <?php endif; ?>
                                    <li><a href="#"><i class="fa fa-user"></i> Профиль</a></li>
                                    <li><a href="#"><i class="fa fa-star"></i> Избранное</a></li>
                                    <li><a href="/logout"><i class="fa fa-power-off"></i> Выход</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="container">
            <?php echo $content; ?>
        </div>
    </body>
</html>