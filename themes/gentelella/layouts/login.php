<?php

/**
 * @company PT. Bank BRISyariah
 * @author bintang
 * @date Apr 22, 2016
 */
use yii\helpers\Html;
use app\assets\LoginAsset;

LoginAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE HTML>
<html>
    <head>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title . ' | ' . Yii::$app->name) ?></title>
        <?php $this->head() ?>
        
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
    <?php $this->beginBody() ?>
        <div class="head">
            <div class="logo">
                <div class="logo-bottom">
                    <section class="sky-form">									
                        <?php echo Html::img('@web/images/logo.png') ?>
                    </section>
                </div>
            </div>		
            <div class="login">
                <div class="sap_tabs">
                    <div id="horizontalTab" style="width: 100%; margin: 0px;">
                        <ul class="resp-tabs-list">
                            <li class="resp-tab-item resp-tab-active" aria-controls="tab_item-0" role="tab"><span>Login</span></li>
                            <div class="clearfix"></div>
                        </ul>				  	 
                        <div class="resp-tabs-container">
                            <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
                                <div class="login-top">
                                    <?=$content?>
<!--                                    <form>
                                        <input type="text" class="email" placeholder="Email" required=""/>
                                        <input type="password" class="password" placeholder="Password" required=""/>		
                                    </form>
                                    <div class="login-bottom login-bottom1">
                                        <div class="submit">
                                            <input type="submit" value="LOGIN"/>
                                        </div>
                                        <div class="clear"></div>
                                    </div>	-->
                                </div>
                            </div>							
                        </div>	
                    </div>
                </div>	
            </div>	
            <div class="clear"></div>
        </div>	

        <div class="footer">
            <p>Copyright &copy; <?= date('Y') ?> <a target="_blank" href="http://www.brisyariah.co.id/">PT. Bank BRISyariah</a>. All Rights Reserved. </p>
        </div>
    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>