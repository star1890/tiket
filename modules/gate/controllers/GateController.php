<?php

namespace app\modules\gate\controllers;

use Yii;
use yii\base\DynamicModel;
use yii\filters\VerbFilter;
use app\components\BaseController;
use app\modules\master\models\Workstation;
use app\modules\kasir\models\Tiket;

class GateController extends BaseController {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'gateway' => ['post'],
                    'get-tiket' => ['post'],
                ],
            ],
        ];
    }

    public function actionGetWorkstation() {
        $model = new DynamicModel([
            'workstation',
        ]);

        $model->addRule(['workstation'], 'required', ['message' => '{attribute} tidak boleh kosong.']);

        return $this->render('get-workstation', [
                    'model' => $model,
        ]);
    }

    public function actionGateway() {
        if (isset($_POST['DynamicModel'])) {

            $workstation = Workstation::findOne($_POST['DynamicModel']['workstation']);
            $model = new DynamicModel([
                'tiket',
            ]);

            $model->addRule(['tiket'], 'required', ['message' => '{attribute} tidak boleh kosong.']);

            return $this->render('gateway', [
                'workstation' => $workstation,
                'model' => $model,
            ]);
        }
    }

    public function actionGetTiket() {
        if (Yii::$app->request->isAjax) {
            $model = Tiket::findOne($_POST['tiket']);

            if (isset($model)) {

                if ($model->wisata != $_POST['wisata']) {
                    echo '<div class="alert alert-warning" role="alert">
                    <strong>Gagal!</strong> Tiket tidak sesuai dengan pintu masuk</div>';
                }
                
                else if (isset($model->enter_date)) {
                    echo '<div class="alert alert-danger" role="alert">
                    <strong>Gagal!</strong> Tiket sudah digunakan pada tanggal '.  date('d-m-Y',  strtotime($model->enter_date)).' Pukul '.  date('H:i:s',  strtotime($model->enter_date)).'</div>';
                }
                
                else {
                    $model->enter_date = date('Y-m-d H:i:s');
                    $model->enter_workstation = $_POST['workstation'];
                    $model->save();
                    
                    echo '<div class="alert alert-success" role="alert">
                    <strong>Sukses!</strong> Selamat datang di Taman Wisata Candi</div>';
                }

            } else {

                echo '<div class="alert alert-danger" role="alert">
                <strong>Gagal!</strong> Tiket tidak ditemukan.</div>';
            }
        }
    }

}
