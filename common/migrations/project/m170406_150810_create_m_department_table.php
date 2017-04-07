<?php

use yii\db\Migration;

/**
 * Handles the creation of table `m_department`.
 */
class m170406_150810_create_m_department_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('m_department', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('m_department');
    }
}
