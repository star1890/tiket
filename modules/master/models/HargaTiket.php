<?php

namespace app\modules\master\models;

use Yii;
use yii\helpers\ArrayHelper;

use app\modules\master\models\KategoriTiket;
use app\modules\master\models\KategoriPerorangan;
use app\modules\master\models\Wisata;

/**
 * This is the model class for table "tiket".
 *
 * @property integer $id
 * @property integer $kategori_tiket
 * @property integer $kategori_perorangan
 * @property integer $harga
 */
class HargaTiket extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'harga_tiket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wisata', 'kategori_tiket', 'kategori_perorangan', 'harga'], 'required'],
            [['kategori_tiket', 'kategori_perorangan'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kategori_tiket' => 'Kategori Tiket',
            'kategori_perorangan' => 'Kategori Perorangan',
            'harga' => 'Harga',
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
    
    public static function getListtiket() {
        $list = ArrayHelper::map(KategoriTiket::find()->orderBy('id')->all(), 'id', 'kategori');
        
        return $list;
    }
    
    public static function getListperorangan() {
        $list = ArrayHelper::map(KategoriPerorangan::find()->orderBy('id')->all(), 'id', 'kategori');
        
        return $list;
    }
    
    public static function getListwisata() {
        $list = ArrayHelper::map(Wisata::find()->orderBy('id')->all(), 'id', 'wisata');
        
        return $list;
    }
}
