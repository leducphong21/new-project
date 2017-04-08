<?php

namespace common\models\gara\purchase;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\gara\purchase\ProductOrderDetail;

/**
 * ProductOrderDetailSearch represents the model behind the search form about `common\models\gara\purchase\ProductOrderDetail`.
 */
class ProductOrderDetailSearch extends ProductOrderDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_order_id', 'product_id', 'cid', 'maker_id', 'repo_id', 'repo_status', 'count', 'status'], 'integer'],
            [['name', 'cid_name', 'maker_name', 'repo_name', 'unit', 'created_at', 'updated_at'], 'safe'],
            [['price', 'discount'], 'number'],
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
        $query = ProductOrderDetail::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => env('PAGE_SIZE'),
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'product_order_id' => $this->product_order_id,
            'product_id' => $this->product_id,
            'cid' => $this->cid,
            'maker_id' => $this->maker_id,
            'repo_id' => $this->repo_id,
            'repo_status' => $this->repo_status,
            'price' => $this->price,
            'count' => $this->count,
            'discount' => $this->discount,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'cid_name', $this->cid_name])
            ->andFilterWhere(['like', 'maker_name', $this->maker_name])
            ->andFilterWhere(['like', 'repo_name', $this->repo_name])
            ->andFilterWhere(['like', 'unit', $this->unit]);

        return $dataProvider;
    }
}
