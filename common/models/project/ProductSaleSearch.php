<?php

namespace common\models\project;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\project\ProductSale;

/**
 * ProductSearch represents the model behind the search form about `common\models\project\Product`.
 */
class ProductSaleSearch extends ProductSale
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type','name','floors','bedrooms','rooms','bathrooms','id', 'product_category_id', 'project_id', 'county_id', 'city_id', 'price', 'acreage', 'total_price', 'status_description', 'status', 'deleted', 'created_by', 'updated_by'], 'integer'],
            [['code', 'created_at', 'updated_at','portion_id','land_id'], 'safe'],
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
        $query = ProductSale::find()->where(["type" => 1])->active();

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
            'name' => 'Tên sản phẩm',
            'product_category_id' => $this->product_categoru_id,
            'type' => $this->type,
            'project_id' => $this->project_id,
            'county_id' => $this->county_id,
            'city_id' => $this->city_id,
            'price' => $this->price,
            'acreage' => $this->acreage,
            'total_price' => $this->total_price,
            'status_description' => $this->status_description,
            'status' => $this->status,
            'deleted' => $this->deleted,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
            'rooms' => $this->rooms,
            'bedrooms' => $this->bedrooms,
            'bathrooms' => $this->bathrooms,
            'foors' => $this->floors,
            'portion_id' => $this->project_id,
            'land_id' => $this->land_id
        ]);

        $query->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }
}
