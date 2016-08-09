<?php

namespace app\modules\kasir\controllers;

use Yii;
use yii\base\DynamicModel;

use app\components\BaseController;
use app\modules\kasir\models\Kasir;
use app\modules\master\models\search\HargaTiketSearch;
use app\modules\kasir\models\Transaksi;
use app\modules\kasir\models\Tiket;
use app\modules\master\models\HargaTiket;

class PenjualanController extends BaseController
{
    public function actionGetKasir()
    {
        $kasir = Kasir::find()->where(['user'=>  Yii::$app->user->id,'status'=>'OPEN'])->one();
        
        if (isset($kasir)) {
            return $this->redirect(['penjualan']);
        } else {
            Yii::$app->session->setFlash('error','Kasir belum dibuka.');
            return $this->render('index');
        }
        
    }
    
    public function actionPenjualan() {
        $transaction = Yii::$app->db->beginTransaction();
        
        try {

            $kasir = Kasir::find()->where(['user'=>  Yii::$app->user->id,'status'=>'OPEN'])->one();

            $searchModel = new HargaTiketSearch();
            $dataProvider = $searchModel->listItems(Yii::$app->request->queryParams);

            $model = new DynamicModel([
                'jumlah', 'uang_dibayar', 'tipe_pembayaran', 'kembalian', 'total_pembelian',
            ]);

            if (isset($_POST['DynamicModel'])) {
                $hasil = $_POST['DynamicModel'];
                
                $sql = "SELECT nextval('kasir_trx_".$kasir->kasir_id."'::regclass)";
                $seq = Yii::$app->db->createCommand($sql)->queryOne();
                $seq = substr('00000'.$seq['nextval'], -5) ;
                
                $trx = new Transaksi;
                $trx->id = $kasir->kasir_id.$seq;
                $trx->trx_date = date('Y-m-d H:i:s');
                $trx->kasir = $kasir->kasir_id;
                $trx->total_pembelian = $hasil['total_pembelian'];
                $trx->uang_dibayar = str_replace(',', '', $hasil['uang_dibayar']);
                $trx->kembalian = str_replace(',', '', $hasil['kembalian']);
                $trx->tipe_pembayaran = $hasil['tipe_pembayaran'];
                
                if ($trx->save()) {
                    foreach ($hasil as $key => $value) {
                        if ($key > 0) {
                            
                            for ($i = 1; $i <= $value['jumlah']; $i++)
                            {
                                $harga = HargaTiket::findOne($key);
                                
                                $sql = "SELECT nextval('kasir_tiket_".$kasir->kasir_id."'::regclass)";
                                $seq = Yii::$app->db->createCommand($sql)->queryOne();
                                $seq = substr('00000'.$seq['nextval'], -3) ;
                                        
                                $tiket = new Tiket;
                                $tiket->id = $kasir->kasir_id.$seq;
                                $tiket->transaksi = $trx->id;
                                $tiket->kategori_tiket = $harga->kategori_tiket;
                                $tiket->wisata = $harga->wisata;
                                $tiket->kategori_perorangan = $harga->kategori_perorangan;
                                $tiket->harga = $harga->harga;
                                $tiket->create_date = date('Y-m-d H:i:s');
                                $tiket->expired_date = date('Y-m-d');
//                                $this->debug($tiket);
                                if (!$tiket->save()) {
                                    $this->debug($tiket->getErrors());
                                }
                            }
                        }
                    }
                    
                    $kasir->transactions++;
                    $kasir->save();
                    
                    $transaction->commit();
                    $this->redirect(['view-transaksi', 'id'=>$trx->id]);
                }
            }

            return $this->render('penjualan', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model,
            ]);
            
        } catch (Exception $exc) {
            $transaction->rollBack();
            throw $exc;
        }

    }
    
    public function actionViewTransaksi($id) {
        $trx = Transaksi::findOne($id);
        $tiket = Tiket::find()->where(['transaksi'=>$id])->all();
        
        return $this->render('view', [
            'trx' => $trx,
            'tikets' => $tiket,
        ]);
    }


    public function actionPrint($id) {
        $this->layout = '@app/themes/gentelella/layouts/print.php';
        
        $trx = Transaksi::findOne($id);
        $tiket = Tiket::find()->where(['transaksi'=>$id])->all();
                
        return $this->render('print', [
            'trx' => $trx,
            'tikets' => $tiket,
        ]);
    }

}
