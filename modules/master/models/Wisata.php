<?php

namespace app\modules\master\models;

use Yii;

/**
 * This is the model class for table "wisata".
 *
 * @property integer $id
 * @property string $wisata
 */
class Wisata extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wisata';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wisata'], 'required'],
            [['wisata'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'wisata' => 'Wisata',
        ];
    }
}
