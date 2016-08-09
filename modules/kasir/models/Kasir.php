<?php

namespace app\modules\kasir\models;

use Yii;
use yii\helpers\ArrayHelper;

use app\modules\user\models\User;
use app\modules\master\models\Workstation;

/**
 * This is the model class for table "kasir".
 *
 * @property string $kasir_id
 * @property string $status
 * @property integer $user
 * @property integer $workstation
 * @property string $open_date
 * @property double $open_bal
 * @property string $close_date
 * @property double $close_bal
 * @property double $real_close_bal
 * @property integer $transactions
 * @property integer $open_by
 * @property integer $close_by
 */
class Kasir extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kasir';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kasir_id', 'status', 'user', 'workstation', 'open_date', 'open_bal', 'open_by'], 'required'],
            [['user', 'workstation', 'transactions', 'open_by', 'close_by'], 'integer'],
            [['open_date', 'close_date'], 'safe'],
//            [['open_bal', 'close_bal', 'real_close_bal'], 'number'],
            [['kasir_id', 'status'], 'string', 'max' => 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kasir_id' => 'Kasir ID',
            'status' => 'Status',
            'user' => 'User',
            'workstation' => 'Workstation',
            'open_date' => 'Buka Kasir',
            'open_bal' => 'Kas Buka Kasir',
            'close_date' => 'Tutup Kasir',
            'close_bal' => 'Kas Tutup Kasir',
            'real_close_bal' => 'Real Close Bal',
            'transactions' => 'Jumlah Transaksi',
            'open_by' => 'Open By',
            'close_by' => 'Close By',
        ];
    }
    
    public function getDetailuser()
    {
        return $this->hasOne(User::className(), ['id' => 'user']);
    }
    
    public function getDetailworkstation()
    {
        return $this->hasOne(Workstation::className(), ['id' => 'workstation']);
    }
    
    public static function getListuser() {
        $sql = 'SELECT * FROM t_user WHERE "role" = \'Kasir\' AND id not in ( SELECT "user" FROM kasir WHERE status = \'OPEN\' )';
        $user = User::findBySql($sql)->all();
        $list = ArrayHelper::map($user, 'id', 'name');
        
        return $list;
    }
    
    public static function getListusers() {
        $sql = 'SELECT * FROM t_user WHERE "role" = \'Kasir\'';
        $user = User::findBySql($sql)->all();
        $list = ArrayHelper::map($user, 'id', 'name');
        
        return $list;
    }
    
    public static function getKasirworkstation() {
        $list = ArrayHelper::map(Workstation::find()->where(['kategori'=>1])->orderBy('id')->all(), 'id', 'workstation');
        
        return $list;
    }
    
    public static function getGateworkstation() {
        $list = ArrayHelper::map(Workstation::find()->where(['kategori'=>2])->orderBy('id')->all(), 'id', 'workstation');
        
        return $list;
    }
}
