<?php

namespace app\modules\dashboard\controllers;

use Yii;
use yii\filters\VerbFilter;
use app\components\BaseController;
use app\modules\master\models\Wisata;
use app\modules\kasir\models\Tiket;
use yii\helpers\Json;

class PengunjungController extends BaseController {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'get-pengunjung' => ['post'],
                    'today' => ['post'],
                    'week' => ['post'],
                    'month' => ['post'],
                    'jam' => ['post'],
                    'perorangan' => ['post'],
                    'estimasi' => ['post'],
                    'pintu-masuk' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $wisata = Wisata::find()->orderBy('id')->all();

        return $this->render('index', [
            'wisatas' => $wisata,
        ]);
    }

    public function actionGetPengunjung() {
        if (Yii::$app->request->isAjax) {
            $sql = "SELECT nextval('tes'::regclass)";
            $seq = Yii::$app->db->createCommand($sql)->queryOne();
            $seq = $seq['nextval'];

            if ($_POST['tipe'] == 'satu') {
                $html = '<div class="count green">' . number_format($seq) . '</div><span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> dari minggu kemarin</span>';
            } else {
                $html = '<div class="count">' . number_format(2000000) . '</div><span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> dari minggu kemarin</span>';
            }

            echo $html;
        }
    }

    public function actionToday() {
        if (Yii::$app->request->isAjax) {
            $sql = 'SELECT count(id) FROM tiket WHERE wisata = :wisata and enter_date::date = :date';
            $model = Tiket::findBySql($sql)->params([
                        'wisata' => $_POST['wisata'],
                        'date' => date('Y-m-d')
                    ])->one();

            echo $model->count;
        }
    }

    public function actionWeek() {
        if (Yii::$app->request->isAjax) {
            $sql = 'SELECT count(id) FROM tiket WHERE wisata = :wisata and enter_date::date >= :date1 and enter_date::date <= :date2';
            $model = Tiket::findBySql($sql)->params([
                        'wisata' => $_POST['wisata'],
                        'date1' => date('Y-m-d', strtotime('monday this week')),
                        'date2' => date('Y-m-d')
                    ])->one();

            echo $model->count;
        }
    }

    public function actionMonth() {
        if (Yii::$app->request->isAjax) {
            $sql = 'SELECT count(id) FROM tiket WHERE wisata = :wisata and Extract(month from enter_date) = :month';
            $model = Tiket::findBySql($sql)->params([
                        'wisata' => $_POST['wisata'],
                        'month' => date('n')
                    ])->one();

            echo $model->count;
        }
    }

    public function actionYear() {
        if (Yii::$app->request->isAjax) {
            $sql = 'SELECT count(id) FROM tiket WHERE wisata = :wisata and Extract(year from enter_date) = :year';
            $model = Tiket::findBySql($sql)->params([
                        'wisata' => $_POST['wisata'],
                        'year' => date('Y')
                    ])->one();

            echo $model->count;
        }
    }

    public function actionJam() {
        if (Yii::$app->request->isAjax) {
            $this->layout = '@app/themes/gentelella/layouts/blank.php';

            $sql = "SELECT  hour , hour  || ':00' as pukul, COUNT(id) as count
                FROM
                (
                SELECT EXTRACT(hour from enter_date) as hour, id FROM tiket
                WHERE enter_date::date = :tanggal and wisata = :wisata
                GROUP BY EXTRACT(hour from enter_date),id
                )subquery
                GROUP BY hour ORDER BY hour";

            $models = Yii::$app->db->createCommand($sql)
                    ->bindValue(':tanggal', date('Y-m-d'))
                    ->bindValue(':wisata', $_POST['wisata'])
                    ->queryAll();

            $pukul = [];
            $jumlah = [];

            foreach ($models as $model) {
                $pukul[] = $model['pukul'];
                $jumlah[] = $model['count'];
            }

            $result['pukul'] = $pukul;
            $result['jumlah'] = $jumlah;

            echo Json::encode($result);
        }
    }

    public function actionPerorangan() {
        if (Yii::$app->request->isAjax) {

            $result = [];

            $sql = "SELECT p.kategori, count(t.kategori_perorangan)
            FROM tiket as t
            INNER JOIN kategori_perorangan as p on t.kategori_perorangan = p.id
            WHERE t.enter_date::date = :tanggal
            AND t.wisata = :wisata
            GROUP BY p.kategori";

            $models = Yii::$app->db->createCommand($sql)
                    ->bindValue(':tanggal', date('Y-m-d'))
                    ->bindValue(':wisata', $_POST['wisata'])
                    ->queryAll();

            foreach ($models as $model) {
                $result[] = ['name' => $model['kategori'], 'y' => $model['count']];
            }

            echo Json::encode($result);
        }
    }

    public function actionEstimasi() {
        if (Yii::$app->request->isAjax) {
            $sql = "SELECT count(id), sum(harga)
            FROM tiket
            WHERE create_date::date = :tanggal and wisata = :wisata;";

            $model = Yii::$app->db->createCommand($sql)
                    ->bindValue(':tanggal', date('Y-m-d'))
                    ->bindValue(':wisata', $_POST['wisata'])
                    ->queryOne();

            $result['pengunjung'] = [$model['count']];
            $result['pendapatan'] = [(integer) $model['sum']];

            echo Json::encode($result);
        }
    }

    public function actionPintuMasuk() {
        if (Yii::$app->request->isAjax) {
            $sql = "SELECT p.workstation, count(t.enter_workstation)
            FROM tiket as t
            INNER JOIN workstation as p on t.enter_workstation = p.id
            WHERE t.enter_date::date = :tanggal
            AND t.wisata = :wisata
            GROUP BY p.workstation";

            $models = Yii::$app->db->createCommand($sql)
                    ->bindValue(':tanggal', date('Y-m-d'))
                    ->bindValue(':wisata', $_POST['wisata'])
                    ->queryAll();

            $gate = [];
            $jumlah = [];

            foreach ($models as $model) {
                $gate[] = $model['workstation'];
                $jumlah[] = $model['count'];
            }

            $result['gate'] = $gate;
            $result['jumlah'] = $jumlah;

            echo Json::encode($result);
        }
    }

}
