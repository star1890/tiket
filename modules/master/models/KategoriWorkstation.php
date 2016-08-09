<?php

namespace app\modules\master\models;

use Yii;

/**
 * This is the model class for table "kategori_workstation".
 *
 * @property integer $id
 * @property string $kategori
 */
class KategoriWorkstation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kategori_workstation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'kategori'], 'required'],
            [['id'], 'integer'],
            [['kategori'], 'string', 'max' => 20],
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
