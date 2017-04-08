<?php

namespace common\models\gara\repair;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\gara\repair\RepairCommand;

/**
 * RepairCommandSearch represents the model behind the search form about `common\models\gara\repair\RepairCommand`.
 */
class RepairCommandSearch extends RepairCommand
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
            [['id', 'invoice_id', 'technician_id', 'car_id', 'customer_id', 'contacter_id', 'repair_by', 'pay_type', 'repaire_type', 'status', 'created_by', 'updated_by'], 'integer'],
            [['document_id', 'date', 'note', 'from_date', 'to_date', 'cname', 'created_at', 'updated_at'], 'safe'],
            [['vat', 'discount', 'total_price'], 'number'],
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
        $query = RepairCommand::find();

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
            $query->andFilterWhere(['between', 'm_repair_command.created_at', $from_Date, $to_Date]);
        } elseif ($from_Date && empty($to_Date)) {
            $query->andFilterWhere(['>=', 'm_repair_command.created_at', $from_Date]);
        } elseif ($to_Date && empty($from_Date)) {
            $query->andFilterWhere(['<=', 'm_repair_command.created_at', $to_Date]);
        }

        // Find Repair Command by Customer;
        if ($this->cname) {
            $query->leftJoin('m_customer', '`m_repair_command`.`customer_id` = `m_customer`.`id`');
            $query->andWhere(['like', 'm_customer.name', $this->cname]);
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'invoice_id' => $this->invoice_id,
            'technician_id' => $this->technician_id,
            'customer_id' => $this->customer_id,
            'contacter_id' => $this->contacter_id,
            'repair_by' => $this->repair_by,
            'pay_type' => $this->pay_type,
            'repaire_type' => $this->repaire_type,
            'vat' => $this->vat,
            'discount' => $this->discount,
            'total_price' => $this->total_price,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'document_id', $this->document_id])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
