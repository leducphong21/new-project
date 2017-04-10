<?php

namespace common\models\project;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\project\ProductCategory;

/**
 * ProductCategorySearch represents the model behind the search form about `common\models\project\ProductCategory`.
 */
class ProductCategorySearch extends ProductCategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'safe'],
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
        $query = ProductCategory::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        $query->joinWith('author');
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'username', $this->created_by])
            ->andFilterWhere(['like', 'username', $this->updated_by]);

        return $dataProvider;
    }
}
