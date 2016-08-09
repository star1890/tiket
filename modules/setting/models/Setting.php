<?php

namespace app\modules\setting\models;

use Yii;

/**
 * This is the model class for table "setting".
 *
 * @property string $parameter
 * @property string $value
 */
class Setting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parameter', 'value'], 'required'],
            [['parameter', 'value'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'parameter' => 'Parameter',
            'value' => 'Value',
        ];
    }
    
    public static function getReload() {
        $sql = 'SELECT * FROM setting WHERE "parameter" = \'reload\'';
        $result = Yii::$app->db->createCommand($sql)->queryOne();
        $result = $result['value'];
        
        return $result;
    }
}
