<?php

namespace app\modules\master\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\master\models\HargaTiket;

/**
 * TiketSearch represents the model behind the search form about `app\modules\master\models\Tiket`.
 */
class HargaTiketSearch extends HargaTiket
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'wisata', 'kategori_tiket', 'kategori_perorangan', 'harga'], 'integer'],
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
    public function search($params)
    {
        $query = HargaTiket::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'wisata' => $this->wisata,
            'kategori_tiket' => $this->kategori_tiket,
            'kategori_perorangan' => $this->kategori_perorangan,
            'harga' => $this->harga,
        ]);

        return $dataProvider;
    }
    
    public function listItems($params)
    {
        $query = HargaTiket::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'wisata' => $this->wisata,
            'kategori_tiket' => $this->kategori_tiket,
            'kategori_perorangan' => $this->kategori_perorangan,
            'harga' => $this->harga,
        ]);

        return $dataProvider;
    }
}
