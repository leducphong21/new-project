<?php

use yii\db\Migration;

/**
 * Handles the creation of table `m_project_category`.
 */
class m170406_155226_create_m_project_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('m_project_category', [
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
        $this->dropTable('m_project_category');
    }
}
