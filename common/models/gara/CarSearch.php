<?php

namespace common\models\gara;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\gara\Car;

/**
 * CarSearch represents the model behind the search form about `common\models\gara\Car`.
 */
class CarSearch extends Car
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'car_carry_id', 'car_model_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['no', 'number', 'machine', 'gear_box', 'code_furniture', 'color', 'model', 'capacity', 'register_no', 'register_date', 'register_address', 'created_at', 'updated_at'], 'safe'],
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
        $query = Car::find()->active();

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
            'car_carry_id' => $this->car_carry_id,
            'car_model_id' => $this->car_model_id,
            'register_date' => $this->register_date,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'no', $this->no])
            ->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'machine', $this->machine])
            ->andFilterWhere(['like', 'gear_box', $this->gear_box])
            ->andFilterWhere(['like', 'code_furniture', $this->code_furniture])
            ->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'capacity', $this->capacity])
            ->andFilterWhere(['like', 'register_no', $this->register_no])
            ->andFilterWhere(['like', 'register_address', $this->register_address]);

        return $dataProvider;
    }
}
