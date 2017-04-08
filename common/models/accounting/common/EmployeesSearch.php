<?php

namespace common\models\accounting\common;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\accounting\common\Employees;

/**
 * EmployeesSearch represents the model behind the search form about `common\models\accounting\common\Employees`.
 */
class EmployeesSearch extends Employees
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'gender', 'status', 'created_by', 'updated_by'], 'integer'],
            [['name', 'department', 'date_start', 'created_at', 'updated_at'], 'safe'],
            [['base_pay', 'seniority'], 'number'],
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
        $query = Employees::find()->active();

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
            'base_pay' => $this->base_pay,
            'seniority' => $this->seniority,
            'date_start' => $this->date_start,
            'gender' => $this->gender,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'department', $this->department]);

        return $dataProvider;
    }
}
