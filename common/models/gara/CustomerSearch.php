<?php

namespace common\models\gara;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\gara\Customer;

/**
 * CustomerSearch represents the model behind the search form about `common\models\gara\Customer`.
 */
class CustomerSearch extends Customer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cid', 'customer_category_id', 'type', 'number', 'status', 'created_by', 'updated_by'], 'integer'],
            [['name', 'mobile', 'email', 'address', 'resource', 'identity_card', 'birthday', 'customer_tax', 'company_name', 'company_address', 'company_email', 'company_tax', 'website', 'bank_name', 'bank_no', 'bank_address', 'other', 'avartar_path', 'avartar_base_url', 'created_at', 'updated_at'], 'safe'],
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
        $query = Customer::find()->active();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ],
                //'attributes' => ['id','name', 'mobile']
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
            'customer_category_id' => $this->customer_category_id,
            'cid' => $this->cid,
            'type' => $this->type,
            'number' => $this->number,
            'birthday' => $this->birthday,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'resource', $this->resource])
            ->andFilterWhere(['like', 'identity_card', $this->identity_card])
            ->andFilterWhere(['like', 'customer_tax', $this->customer_tax])
            ->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'company_address', $this->company_address])
            ->andFilterWhere(['like', 'company_email', $this->company_email])
            ->andFilterWhere(['like', 'company_tax', $this->company_tax])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'bank_name', $this->bank_name])
            ->andFilterWhere(['like', 'bank_no', $this->bank_no])
            ->andFilterWhere(['like', 'bank_address', $this->bank_address])
            ->andFilterWhere(['like', 'other', $this->other])
            ->andFilterWhere(['like', 'avatar_path', $this->avatar_path])
            ->andFilterWhere(['like', 'avatar_base_url', $this->avatar_base_url]);

        return $dataProvider;
    }
}
