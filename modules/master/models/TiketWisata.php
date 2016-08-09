<?php

namespace app\modules\master\models;

use Yii;

/**
 * This is the model class for table "tiket_wisata".
 *
 * @property integer $id_tiket
 * @property integer $id_wisata
 */
class TiketWisata extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tiket_wisata';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tiket', 'id_wisata'], 'required'],
            [['id_tiket', 'id_wisata'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_tiket' => 'Tiket',
            'id_wisata' => 'Wisata',
        ];
    }
}
