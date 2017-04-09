<?php

use yii\db\Migration;

/**
 * Handles the creation of table `m_branch`.
 */
class m170406_150755_create_m_branch_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('m_branch', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'address' => $this->string(255),
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
        $this->dropTable('m_branch');
    }
}
