<?php

namespace common\models\gara\stock;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\gara\stock\Bill;

/**
 * BillSearch represents the model behind the search form about `common\models\gara\stock\Bill`.
 */
class BillSearch extends Bill
{
    public $from_date;
    public $to_date;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'input_type', 'suplly_id', 'document_id', 'invoice_number', 'status', 'created_by', 'updated_by'], 'integer'],
            [['coupon_id', 'date', 'note', 'created_name', 'from_date', 'to_date', 'created_at', 'updated_at'], 'safe'],
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
        $query = Bill::find()
            ->active()
            ->andWhere(['type' => $params['BillSearch']['type']]);

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

        $from_Date = '';
        $to_Date = '';
        if (isset($this->from_date) && !empty($this->from_date)) {
            $from_Date = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $this->from_date)));
        }
        if (isset($this->to_date) && !empty($this->to_date)) {
            $to_Date = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $this->to_date). "+1 days"));
        }
        if ($from_Date && $to_Date) {
            $query->andFilterWhere(['between', 'm_bill.created_at', $from_Date, $to_Date]);
        } elseif ($from_Date && empty($to_Date)) {
            $query->andFilterWhere(['>=', 'm_bill.created_at', $from_Date]);
        } elseif ($to_Date && empty($from_Date)) {
            $query->andFilterWhere(['<=', 'm_bill.created_at', $to_Date]);
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'type' => $this->type,
            'input_type' => $this->input_type,
            'suplly_id' => $this->suplly_id,
            'document_id' => $this->document_id,
            'invoice_number' => $this->invoice_number,
            'date' => $this->date,
            'vat' => $this->vat,
            'discount' => $this->discount,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'coupon_id', $this->coupon_id])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'created_name', $this->created_name]);

        return $dataProvider;
    }
}
