<?php

/**
 * @company PT. Bank BRISyariah
 * @author bintang
 * @date Apr 21, 2016
 */
use yii\helpers\Html;
use app\assets\GentelellaAsset;
use yii\widgets\Breadcrumbs;

GentelellaAsset::register($this);

if (Yii::$app->user->isGuest) {
    echo $this->render(
            'login.php', ['content' => $content]
    );
} else {
    ?>

    <?php $this->beginPage() ?>

    <!DOCTYPE html>
    <html lang="en">

        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <!-- Meta, title, CSS, favicons, etc. -->
            <meta charset="<?= Yii::$app->charset ?>"/>
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <?= Html::csrfMetaTags() ?>
            <title><?= Html::encode($this->title . ' | ' . Yii::$app->name) ?></title>
            <?php $this->head() ?>

        </head>


        <body class="nav-md">
            <?php $this->beginBody() ?>

            <div class="container body">


                <div class="main_container">

                    <div class="col-md-3 left_col">
                        <div class="left_col scroll-view">

                            <div class="navbar nav_title" style="border: 0;">
                                <?= Html::a('<span>Point of Sales</span>', Yii::$app->homeUrl, ['class' => 'site_title']) ?>
                            </div>

                            <div class="clearfix"></div>

                            <br />

                            <?=
                            $this->render(
                                'menu.php'
                            )
                            ?>

                        </div>
                    </div>

                    <!-- top navigation -->
                    <div class="top_nav">

                        <div class="nav_menu">
                            <nav class="" role="navigation">

                                <ul class="nav navbar-nav navbar-right">
                                    <li class="">
                                        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <?= Yii::$app->user->identity->name ?>
                                            <span class=" fa fa-angle-down"></span>
                                        </a>
                                        <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                            <li><?= Html::a('Profile', ['/user/user/profile','id'=>Yii::$app->user->identity->id])?>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="badge bg-red pull-right">50%</span>
                                                    <span>Settings</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">Help</a>
                                            </li>
                                            <li><?=
                                                Html::a(
                                                        '<i class="fa fa-sign-out pull-right"></i> Keluar', ['/site/logout'], ['data-method' => 'post']
                                                )
                                                ?>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                            </nav>
                        </div>

                    </div>
                    <!-- /top navigation -->


                    <!-- page content -->
                    <div class="right_col" role="main">
                        
                        <div class="page-title">
                            <div class="title_full">
                                <?= Breadcrumbs::widget([
                                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                ]) ?>
                            </div>
                        </div>

                        <?= $content ?>

                        <br />

                        <!-- footer content -->

                        <footer>
                            <div class="copyright-info">
                                <p class="pull-right">
                                    Copyright &copy; <?= date('Y') ?> <a target="_blank" href="http://www.brisyariah.co.id/">PT. Bank BRISyariah</a>. All Rights Reserved.
                                </p>
                            </div>
                            <div class="clearfix"></div>
                        </footer>
                        <!-- /footer content -->
                    </div>
                    <!-- /page content -->

                </div>

            </div>

            <div id="custom_notifications" class="custom-notifications dsp_none">
                <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
                </ul>
                <div class="clearfix"></div>
                <div id="notif-group" class="tabbed_notifications"></div>
            </div>

            <?php $this->endBody() ?>
        </body>

    </html>

    <?php $this->endPage() ?>
<?php } ?>