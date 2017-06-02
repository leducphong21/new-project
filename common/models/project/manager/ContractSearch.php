<?php

namespace common\models\project\manager;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\project\manager\Contract;

/**
 * ContractSearch represents the model behind the search form about `common\models\project\Contract`.
 */
class ContractSearch extends Contract
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'total_price', 'created_by', 'updated_by'], 'integer'],
            [['code', 'code_product', 'name_product', 'name_buyer', 'code_buyer', 'address_buyer', 'mobile_buyer', 'name_seller', 'code_seller', 'address_seller', 'mobile_seller', 'handover_dateline', 'guarantee', 'renter_dateline', 'created_at', 'updated_at'], 'safe'],
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
        $query = Contract::find()->active();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'total_price' => $this->total_price,
            'handover_dateline' => $this->handover_dateline,
            'renter_dateline' => $this->renter_dateline,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'code_product', $this->code_product])
            ->andFilterWhere(['like', 'name_product', $this->name_product])
            ->andFilterWhere(['like', 'name_buyer', $this->name_buyer])
            ->andFilterWhere(['like', 'code_buyer', $this->code_buyer])
            ->andFilterWhere(['like', 'address_buyer', $this->address_buyer])
            ->andFilterWhere(['like', 'mobile_buyer', $this->mobile_buyer])
            ->andFilterWhere(['like', 'name_seller', $this->name_seller])
            ->andFilterWhere(['like', 'code_seller', $this->code_seller])
            ->andFilterWhere(['like', 'address_seller', $this->address_seller])
            ->andFilterWhere(['like', 'mobile_seller', $this->mobile_seller])
            ->andFilterWhere(['like', 'guarantee', $this->guarantee]);
        return $dataProvider;
    }
}
