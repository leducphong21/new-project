<?php

use yii\db\Migration;

/**
 * Handles the creation of table `m_employee`.
 */
class m170416_024332_create_m_employee_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('m_employee', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'code' => $this->string(8),
            'regency_id' => $this->integer(),
            'branch_id' => $this->integer(),
            'department_id' => $this->integer(),
            'phone_number' => $this->string(16),
            'address' => $this->string(255),
            "deleted" => $this->smallInteger(2)->defaultValue(1),
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
        $this->dropTable('m_employee');
    }
}
