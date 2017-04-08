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
