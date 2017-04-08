<?php

namespace common\models\gara\repair\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\gara\repair\Invoice;

/**
 * InvoiceSearch represents the model behind the search form about `common\models\gara\Invoice`.
 */
class InvoiceSearch extends Invoice
{
    public $from_date;
    public $to_date;
    public $cname;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'ticket_id', 'car_id', 'customer_id', 'repaire_type', 'confirm_type', 'status', 'created_by', 'updated_by'], 'integer'],
            [['date_in', 'car_number', 'car_machine', 'documement_id', 'date', 'from_date', 'to_date', 'cname', 'note', 'created_at', 'updated_at'], 'safe'],
            [['km_in'], 'number'],
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
        $query = Invoice::find()->active()->with('car');

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
            $to_Date = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $this->to_date) . "+1 days"));
        }
        if ($from_Date && $to_Date) {
            $query->andFilterWhere(['between', 'm_invoice.created_at', $from_Date, $to_Date]);
        } elseif ($from_Date && empty($to_Date)) {
            $query->andFilterWhere(['>=', 'm_invoice.created_at', $from_Date]);
        } elseif ($to_Date && empty($from_Date)) {
            $query->andFilterWhere(['<=', 'm_invoice.created_at', $to_Date]);
        }

        // Find Invoice by Customer;
        if ($this->cname) {
            //$query->leftJoin('d_ticket_customer', '`d_ticket_customer`.`ticket_id` = `m_ticket`.`id`  AND `d_ticket_customer`.`type` = 1');
            $query->leftJoin('m_customer', '`m_invoice`.`customer_id` = `m_customer`.`id`');
            $query->andWhere(['like', 'm_customer.name', $this->cname]);
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'type' => $this->type,
            'ticket_id' => $this->ticket_id,
            'car_id' => $this->car_id,
            'customer_id' => $this->customer_id,
            'date_in' => $this->date_in,
            'km_in' => $this->km_in,
            'repaire_type' => $this->repaire_type,
            'date' => $this->date,
            'confirm_type' => $this->confirm_type,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'car_number', $this->car_number])
            ->andFilterWhere(['like', 'car_machine', $this->car_machine])
            ->andFilterWhere(['like', 'documement_id', $this->documement_id])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
