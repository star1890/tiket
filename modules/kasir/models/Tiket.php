<?php

namespace app\modules\kasir\models;

use Yii;
use app\modules\master\models\KategoriTiket;
use app\modules\master\models\KategoriPerorangan;
use app\modules\master\models\Wisata;

/**
 * This is the model class for table "tiket".
 *
 * @property string $id
 * @property string $transaksi
 * @property string $kategori_tiket
 * @property string $wisata
 * @property string $kategori_perorangan
 * @property integer $harga
 * @property string $create_date
 * @property string $enter_date
 * @property string $expired_date
 */
class Tiket extends \yii\db\ActiveRecord
{
    public $count;
    public $sum;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tiket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'transaksi', 'kategori_tiket', 'wisata', 'harga', 'create_date', 'expired_date'], 'required'],
            [['harga','kategori_tiket', 'wisata', 'kategori_perorangan'], 'integer'],
            [['create_date', 'enter_date', 'expired_date'], 'safe'],
            [['id'], 'string', 'max' => 15],
            [['transaksi'], 'string', 'max' => 18],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'transaksi' => 'Transaksi',
            'kategori_tiket' => 'Kategori Tiket',
            'wisata' => 'Wisata',
            'kategori_perorangan' => 'Kategori Perorangan',
            'harga' => 'Harga',
            'create_date' => 'Create Date',
            'enter_date' => 'Enter Date',
            'expired_date' => 'Expired Date',
        ];
    }
    
    public function getKategoritiket()
    {
        return $this->hasOne(KategoriTiket::className(), ['id' => 'kategori_tiket']);
    }
    
    public function getKategoriperorangan()
    {
        return $this->hasOne(KategoriPerorangan::className(), ['id' => 'kategori_perorangan']);
    }
    
    public function getWisatadesc()
    {
        return $this->hasOne(Wisata::className(), ['id' => 'wisata']);
    }
}
