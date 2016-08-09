<?php

namespace app\modules\master\models;

use Yii;

/**
 * This is the model class for table "kategori_tiket".
 *
 * @property integer $id
 * @property string $kategori
 */
class KategoriTiket extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kategori_tiket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kategori'], 'required'],
            [['kategori'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kategori' => 'Kategori',
        ];
    }
}
