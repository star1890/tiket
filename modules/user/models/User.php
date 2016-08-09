<?php

namespace app\modules\user\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "t_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string $role
 * @property string $last_ip
 * @property string $last_login
 * @property integer $status
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'name', 'role'], 'required','message'=>'{attribute} tidak boleh kosong.'],
            [['last_login'], 'safe'],
            [['status'], 'integer'],
            [['username', 'name', 'role'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 100],
            [['last_ip'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'name' => 'Nama',
            'role' => 'Role',
            'last_ip' => 'Last IP',
            'last_login' => 'Last Login',
            'status' => 'Status',
        ];
    }
    
    public static function getRole() {
//        $sql = "SELECT * FROM auth_item where type = 1 ORDER BY name";
        $sql = "SELECT * FROM auth_item where type = 1 and name != 'Admin App' ORDER BY name";
        $rule = Yii::$app->db->createCommand($sql)->queryAll();
        $list_rule = ArrayHelper::map($rule, 'name', 'description');
        
        return $list_rule;
    }
    
    public static function getStatus($status) {
        if ($status) {
            return 'Aktif';
        } else {
            return 'Tidak Aktif';
        }
    }
}
