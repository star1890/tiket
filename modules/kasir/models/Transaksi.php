<?php

namespace app\modules\kasir\models;

use Yii;
use app\modules\kasir\models\Kasir;

/**
 * This is the model class for table "transaksi".
 *
 * @property string $id
 * @property string $trx_date
 * @property string $kasir
 * @property integer $total_pembelian
 * @property integer $uang_dibayar
 * @property integer $kembalian
 * @property string $tipe_pembayaran
 */
class Transaksi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaksi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'trx_date', 'kasir', 'total_pembelian', 'tipe_pembayaran'], 'required'],
            [['trx_date'], 'safe'],
            [['total_pembelian', 'uang_dibayar', 'kembalian'], 'integer'],
            [['id'], 'string', 'max' => 18],
            [['kasir'], 'string', 'max' => 5],
            [['tipe_pembayaran'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'trx_date' => 'Trx Date',
            'kasir' => 'Kasir',
            'total_pembelian' => 'Total Pembelian',
            'uang_dibayar' => 'Uang Dibayar',
            'kembalian' => 'Kembalian',
            'tipe_pembayaran' => 'Tipe Pembayaran',
        ];
    }
    
    public function getDetailkasir()
    {
        return $this->hasOne(Kasir::className(), ['kasir_id' => 'kasir']);
    }
}
