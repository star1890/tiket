<?php

namespace app\controllers;

use app\components\BaseController;

class MainController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
