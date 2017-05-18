<?php

use yii\db\Migration;

/**
 * Handles the creation of table `m_ticket`.
 */
class m170517_032132_create_m_ticket_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('m_ticket', [
            'id' => $this->primaryKey(),
            'code' => $this->string(8),
            'type' => $this->smallInteger(8),
            'code_product' => $this->string(8),
            'name_product' => $this->integer(),
            'total_price' => $this->integer(),
            'ticket_price' => $this->integer(),
            'status' => $this->smallInteger(8)->defaultValue(1),
            'name_buyer' => $this->integer(),
            'code_buyer' => $this->string(8),
            'address_buyer' => $this->string(255),
            'mobile_buyer' => $this->string(16),
            'name_seller' => $this->integer(),
            'code_seller' => $this->string(8),
            'address_seller' => $this->string(255),
            'mobile_seller' => $this->string(16),
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
        $this->dropTable('m_ticket');
    }
}
