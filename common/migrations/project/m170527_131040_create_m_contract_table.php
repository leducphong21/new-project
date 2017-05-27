<?php

use yii\db\Migration;

/**
 * Handles the creation of table `m_contract`.
 */
class m170527_131040_create_m_contract_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('m_contract', [
            'id' => $this->primaryKey(),
            'code' => $this->string(8),
            'code_product' => $this->string(8),
            'ticket_id'=> $this->integer(),
            'name_product' => $this->string(),
            'total_price' => $this->integer(),
            'name_buyer' => $this->string(),
            'code_buyer' => $this->string(8),
            'address_buyer' => $this->string(255),
            'mobile_buyer' => $this->string(16),
            'name_seller' => $this->string(),
            'code_seller' => $this->string(8),
            'address_seller' => $this->string(255),
            'mobile_seller' => $this->string(16),
            'handover_dateline'=> $this->date(),
            'guarantee'=> $this->string(32),
            'renter_dateline'=> $this->date(),
            'deleted'=> $this->smallInteger(2)->defaultValue(1),
            'created_by' => $this->integer(),
            'created_at' => $this->date(),
            'updated_by' => $this->integer(),
            'updated_at' => $this->date(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('m_contract');
    }
}
