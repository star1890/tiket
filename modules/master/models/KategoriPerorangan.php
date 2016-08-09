<?php

namespace app\modules\master\models;

use Yii;

/**
 * This is the model class for table "kategori_perorangan".
 *
 * @property integer $id
 * @property string $kategori
 * @property string $deskripsi
 */
class KategoriPerorangan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kategori_perorangan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kategori'], 'required'],
            [['kategori', 'deskripsi'], 'string', 'max' => 50],
            [['deskripsi'],'default','value' => null],
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
            'deskripsi' => 'Deskripsi',
        ];
    }
}
