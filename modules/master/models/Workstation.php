<?php

namespace app\modules\master\models;

use Yii;
use yii\helpers\ArrayHelper;

use app\modules\master\models\Wisata;
use app\modules\master\models\KategoriWorkstation;

/**
 * This is the model class for table "workstation".
 *
 * @property integer $id
 * @property string $workstation
 * @property string $workstation_ip
 */
class Workstation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'workstation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['workstation','wisata','kategori'], 'required', 'message'=>'{attribute} tidak boleh kosong.'],
            [['workstation'], 'string', 'max' => 50],
            [['workstation_ip'], 'string', 'max' => 15],
            [['workstation_ip'],'default','value' => null],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'workstation' => 'Workstation',
            'workstation_ip' => 'Workstation IP',
        ];
    }
    
    public function getWisatanya()
    {
        return $this->hasOne(Wisata::className(), ['id' => 'wisata']);
    }
    
    public function getDetailkategori()
    {
        return $this->hasOne(KategoriWorkstation::className(), ['id' => 'kategori']);
    }
    
    public static function getListwisata() {
        $list = ArrayHelper::map(Wisata::find()->orderBy('id')->all(), 'id', 'wisata');
        
        return $list;
    }
    
    public static function getListkategori() {
        $list = ArrayHelper::map(KategoriWorkstation::find()->orderBy('id')->all(), 'id', 'kategori');
        
        return $list;
    }
    
    public function getWisatadesc() {
        if (isset($this->wisatanya)) {
            return $this->wisatanya->wisata;
        } else {
            return null;
        }
    }
    
}
