<?php

use yii\db\Migration;

/**
 * Handles the creation of table `m_regency`.
 */
class m170416_042254_create_m_regency_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('m_regency', [
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
        $this->dropTable('m_regency');
    }
}
