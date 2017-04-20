<?php

namespace common\models\project;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\project\ModelProject;

/**
 * ProjectSearch represents the model behind the search form about `common\models\project\Project`.
 */
class ModelProjectSearch extends ModelProject
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'project_category_id', 'areage', 'number_product', 'county_id', 'city', 'deleted', 'created_by', 'updated_by'], 'integer'],
            [['name', 'code', 'created_at', 'updated_at'], 'safe'],
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
        $query = ModelProject::find()->active();

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
            'project_category_id' => $this->project_category_id,
            'areage' => $this->areage,
            'number_product' => $this->number_product,
            'county_id' => $this->county_id,
            'city' => $this->city,
            'deleted' => $this->deleted,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }
}
