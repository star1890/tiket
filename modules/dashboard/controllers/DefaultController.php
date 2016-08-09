<?php

namespace app\modules\dashboard\controllers;

use Yii;
use yii\helpers\Json;
use yii\filters\VerbFilter; 

use app\components\BaseController;
use app\modules\kasir\models\Tiket;

/**
 * Default controller for the `dashboard` module
 */
class DefaultController extends BaseController {
    
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'jam' => ['post'],
                    'today' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex() {

        $this->layout = '@app/themes/gentelella/layouts/dashboard.php';

        return $this->render('index');
    }
    
    public function actionToday() {
        if (Yii::$app->request->isAjax) {
            $sql = 'SELECT count(id) FROM tiket WHERE wisata = :wisata and create_date::date = :tanggal';
            $model = Tiket::findBySql($sql)->params([
                        'wisata' => $_POST['wisata'],
//                        'tanggal' => $_POST['tanggal'],
                        'tanggal' => '2016-05-13',
                    ])->one();

            echo $model->count;
        }
    }

    public function actionJam() {
        if (Yii::$app->request->isAjax) {
            $sql = "SELECT pukul.hour, pukul.hour  || ':00' as pukul, COALESCE(borobudur.count,0) as borobudur, COALESCE(prambanan.count,0) as prambanan, COALESCE(boko.count,0) as boko, COALESCE(borobudur.harga,0) as borobudur_pendapatan, COALESCE(prambanan.harga,0) as prambanan_pendapatan, COALESCE(boko.harga,0) as boko_pendapatan
            FROM
            (
            SELECT EXTRACT(hour from create_date) as hour FROM tiket
            WHERE create_date::date = :tanggal 
            GROUP BY EXTRACT(hour from create_date)
            ) pukul
            LEFT JOIN
            (
                    SELECT  hour , COUNT(id) as count, sum(harga) as harga
                    FROM
                    (
                            SELECT EXTRACT(hour from create_date) as hour, id, harga FROM tiket
                            WHERE create_date::date = :tanggal and wisata = 1
                            GROUP BY EXTRACT(hour from create_date),id, harga
                            )subquery
                            GROUP BY hour ORDER BY hour
            ) borobudur on pukul.hour = borobudur.hour
            LEFT JOIN
            (
                    SELECT  hour , COUNT(id) as count, sum(harga) as harga
                    FROM
                    (
                    SELECT EXTRACT(hour from create_date) as hour, id, harga FROM tiket
                    WHERE create_date::date = :tanggal and wisata = 2
                    GROUP BY EXTRACT(hour from create_date),id, harga
                    )subquery
                    GROUP BY hour ORDER BY hour
            ) prambanan on pukul.hour = prambanan.hour
            LEFT JOIN
            (
                    SELECT  hour , COUNT(id) as count, sum(harga) as harga
                    FROM
                    (
                    SELECT EXTRACT(hour from create_date) as hour, id, harga FROM tiket
                    WHERE create_date::date = :tanggal and wisata = 3
                    GROUP BY EXTRACT(hour from create_date),id, harga
                    )subquery
                    GROUP BY hour ORDER BY hour
            ) boko on pukul.hour = boko.hour
            GROUP BY pukul.hour,borobudur.count, prambanan.count, boko.count, borobudur.harga, prambanan.harga, boko.harga
            ORDER BY pukul.hour;";

            $models = Yii::$app->db->createCommand($sql)
//                    ->bindValue(':tanggal', $_POST['tanggal'])
                    ->bindValue(':tanggal', '2016-05-13')
                    ->queryAll();

            $pukul = [];
            $borobudur = [];
            $prambanan = [];
            $boko = [];
            $pendapatan_borobudur = [];
            $pendapatan_prambanan = [];
            $pendapatan_boko = [];

            foreach ($models as $model) {
                $pukul[] = $model['pukul'];
                $borobudur[] = $model['borobudur'];
                $prambanan[] = $model['prambanan'];
                $boko[] = $model['boko'];
                $pendapatan_borobudur[] = (integer)$model['borobudur_pendapatan'];
                $pendapatan_prambanan[] = (integer)$model['prambanan_pendapatan'];
                $pendapatan_boko[] = (integer)$model['boko_pendapatan'];
            }

            $result['pukul'] = $pukul;
            $result['borobudur'] = $borobudur;
            $result['prambanan'] = $prambanan;
            $result['boko'] = $boko;
            $result['borobudur_pendapatan'] = $pendapatan_borobudur;
            $result['prambanan_pendapatan'] = $pendapatan_prambanan;
            $result['boko_pendapatan'] = $pendapatan_boko;

            echo Json::encode($result);
        }
    }

}
