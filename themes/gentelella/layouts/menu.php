<?php
use mdm\admin\components\MenuHelper;
use app\components\SideBar;

//echo '<pre>';var_dump(MenuHelper::getAssignedMenu(Yii::$app->user->id));die;
?>

<?php
//echo '<pre>';var_dump(
//SideBar::widget([
//    'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id)
//])
//);die;
?>

<!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

      <div class="menu_section">
        <?php
        echo SideBar::widget([
            'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id)
        ]);
        ?>
      </div>

    </div>
<!-- /sidebar menu -->