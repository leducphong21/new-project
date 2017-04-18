<?php

use yii\db\Migration;

/**
 * Handles the creation of table `m_customer`.
 */
class m170417_030229_create_m_customer_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('m_customer', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'code' => $this->string(8),
            'gender' => $this->smallInteger(2),
            'birth_day' => $this->date(),
            'type' => $this->smallInteger(8),
            'address' => $this->string(255),
            'phone_number' => $this->string(16),
            'email' => $this->string(64),
            'job' => $this->string(64),
            'tax_code' => $this->string(16),
            'deleted' => $this->smallInteger(2),
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
        $this->dropTable('m_customer');
    }
}
