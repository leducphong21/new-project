<?php

namespace common\models\gara;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\gara\Product;

/**
 * ProductSearch represents the model behind the search form about `common\models\gara\Product`.
 */
class ServiceSearch extends Service
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'supply_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['name', 'unit', 'made_in', 'guarantee', 'note', 'image_path', 'image_base_url', 'created_at', 'updated_at'], 'safe'],
            [['price'], 'number'],
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
        $query = Service::find()->active();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ],
            'pagination' => [
                'pageSize' => Yii::$app->keyStorage->get('pageSize', 5),
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'supply_id' => $this->supply_id,
            'price' => $this->price,
            //'type' => $this->type,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'made_in', $this->made_in])
            ->andFilterWhere(['like', 'guarantee', $this->guarantee])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'image_path', $this->image_path])
            ->andFilterWhere(['like', 'image_base_url', $this->image_base_url]);

        return $dataProvider;
    }
}
