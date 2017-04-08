<?php

namespace common\models\gara\repair;

use common\models\gara\Product;
use common\models\gara\Service;
use common\models\gara\repair\Ticket;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "m_ticket_detail".
 *
 * @property integer $id
 * @property integer $ticket_id
 * @property string $name
 * @property integer $type
 * @property integer $product_id
 * @property string $product_name
 * @property integer $count
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class TicketDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_ticket_detail';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ticket_id', 'name'], 'required'],
            [['ticket_id', 'type', 'product_id', 'count', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'product_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ticket_id' => 'Ticket ID',
            'name' => 'Name',
            'type' => 'Type',
            'product_id' => 'Product ID',
            'product_name' => 'Product Name',
            'count' => 'Count',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicket()
    {
        return $this->hasOne(Ticket::className(), ['id' => 'ticket_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::className(), ['id' => 'product_id']);
    }
}
