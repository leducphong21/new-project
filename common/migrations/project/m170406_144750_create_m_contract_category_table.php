<?php

use yii\db\Migration;

/**
 * Handles the creation of table `m_contract_category`.
 */
class m170406_144750_create_m_contract_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('m_contract_category', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
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
        $this->dropTable('m_contract_category');
    }
}
