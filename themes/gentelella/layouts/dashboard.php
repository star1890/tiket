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

                    <!-- page content -->
                    <div class="right_col" role="main">

                        <?= $content ?>

                    </div>
                    <!-- /page content -->

                </div>

            </div>

            <?php $this->endBody() ?>
        </body>

    </html>

    <?php $this->endPage() ?>
<?php } ?>