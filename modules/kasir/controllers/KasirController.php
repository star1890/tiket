<?php

namespace app\modules\kasir\controllers;

use Yii;
use app\modules\kasir\models\Kasir;
use app\modules\kasir\models\search\KasirSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\components\BaseController;
use app\modules\kasir\models\Transaksi;

/**
 * KasirController implements the CRUD actions for Kasir model.
 */
class KasirController extends BaseController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Kasir models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KasirSearch();
        $dataProvider = $searchModel->open(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionBuka()
    {
        
        $transaction = Yii::$app->db->beginTransaction();
        
        try {
            
            $sql = "SELECT nextval('kasir_id_seq'::regclass)";
            $seq = Yii::$app->db->createCommand($sql)->queryOne();
            $seq = substr('00'.$seq['nextval'], -2) ;

            $model = new Kasir();
            $kasir_id = date('z').$seq;
            $model->kasir_id = $kasir_id;

            if ($model->load(Yii::$app->request->post())) {
                $model->kasir_id = $kasir_id;
                $model->status = 'OPEN';
                $model->open_date = date('Y-m-d H:i:s');
                $model->open_by = Yii::$app->user->id;
                $model->open_bal = str_replace(',', '', $model->open_bal);

                if ($model->save()) {
                    
                    $sql = 'DROP SEQUENCE IF EXISTS kasir_trx_'.$kasir_id;
                    Yii::$app->db->createCommand($sql)->execute();
                    $sql = 'DROP SEQUENCE IF EXISTS kasir_tiket_'.$kasir_id;
                    Yii::$app->db->createCommand($sql)->execute();
                    
                    $sql = 'CREATE SEQUENCE kasir_trx_'.$kasir_id.' INCREMENT 1 MINVALUE 1 MAXVALUE 99999 START 1';
                    Yii::$app->db->createCommand($sql)->execute();
                    $sql = 'CREATE SEQUENCE kasir_tiket_'.$kasir_id.' INCREMENT 1 MINVALUE 1 MAXVALUE 99999 START 1';
                    Yii::$app->db->createCommand($sql)->execute();
                    
                    $transaction->commit();
                    Yii::$app->session->setFlash('success','Buka kasir berhasil diproses.');
                    return $this->redirect(['index']);
                } else {
                    throw new \yii\web\HttpException(400, Json::encode($model->getErrors()));
                }
            }

            return $this->render('create', [
                'model' => $model,
            ]);
            
        } catch (Exception $exc) {
            $transaction->rollBack();
        }
    }
    
    public function actionTutup($id)
    {
        $transaction = Yii::$app->db->beginTransaction();
        
        try {
            
            $model = Kasir::findOne($id);

            $sql = 'SELECT sum(total_pembelian) total_pembelian FROM transaksi WHERE kasir = :id';
            $trx = Transaksi::findBySql($sql, ['id'=>$id])->one();

            $model->close_bal = $trx->total_pembelian + $model->open_bal;

            if (isset($_POST['Kasir'])) {
                $model->close_bal = str_replace(',', '', $_POST['Kasir']['close_bal']);
                $model->close_date = date('Y-m-d H:i:s');
                $model->close_by = Yii::$app->user->id;
                $model->status = 'CLOSE';
                
                if ($model->save()) {
                    
                    $sql = 'DROP SEQUENCE kasir_trx_'.$id;
                    Yii::$app->db->createCommand($sql)->execute();
                    $sql = 'DROP SEQUENCE kasir_tiket_'.$id;
                    Yii::$app->db->createCommand($sql)->execute();
                    
                    $transaction->commit();
                    Yii::$app->session->setFlash('success','Tutup kasir berhasil diproses.');
                    return $this->redirect(['index']);
                } else {
                    throw new \yii\web\HttpException(400, Json::encode($model->getErrors()));
                }
            }

            return $this->render('tutup', [
                'model' => $model,
            ]);
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * Displays a single Kasir model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Kasir model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Kasir();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->kasir_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Kasir model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->kasir_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Kasir model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Kasir model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Kasir the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kasir::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
