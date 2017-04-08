<?php

namespace common\models\gara\purchase;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\gara\purchase\ProductOrder;

/**
 * ProductOrderSearch represents the model behind the search form about `common\models\gara\purchase\ProductOrder`.
 */
class ProductOrderSearch extends ProductOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'supply_id', 'pay_type', 'order_status', 'status', 'created_by', 'updated_by'], 'integer'],
            [['no', 'date', 'date_order', 'created_name', 'address_delivery', 'note', 'created_at', 'updated_at'], 'safe'],
            [['vat', 'discount'], 'number'],
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
        $query = ProductOrder::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ],
            'pagination' => [
                'pageSize' => Yii::$app->keyStorage->get('pageSize', 15),
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'date_order' => $this->date_order,
            'supply_id' => $this->supply_id,
            'pay_type' => $this->pay_type,
            'order_status' => $this->order_status,
            'vat' => $this->vat,
            'discount' => $this->discount,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'no', $this->no])
            ->andFilterWhere(['like', 'created_name', $this->created_name])
            ->andFilterWhere(['like', 'address_delivery', $this->address_delivery])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
