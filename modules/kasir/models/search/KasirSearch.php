<?php

namespace app\modules\kasir\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\kasir\models\Kasir;

/**
 * KasirSearch represents the model behind the search form about `app\modules\kasir\models\Kasir`.
 */
class KasirSearch extends Kasir
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kasir_id', 'status', 'open_date', 'close_date'], 'safe'],
            [['user', 'workstation', 'transactions', 'open_by', 'close_by'], 'integer'],
            [['open_bal', 'close_bal', 'real_close_bal'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function open($params)
    {
        $query = Kasir::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        $query->where("status = 'OPEN'");

        $query->andFilterWhere([
            'user' => $this->user,
            'workstation' => $this->workstation,
            'open_date' => $this->open_date,
            'open_bal' => $this->open_bal,
            'close_date' => $this->close_date,
            'close_bal' => $this->close_bal,
            'real_close_bal' => $this->real_close_bal,
            'transactions' => $this->transactions,
            'open_by' => $this->open_by,
            'close_by' => $this->close_by,
        ]);

        $query->andFilterWhere(['like', 'kasir_id', $this->kasir_id])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
