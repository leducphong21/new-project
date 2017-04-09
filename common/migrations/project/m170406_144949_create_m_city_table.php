<?php

use yii\db\Migration;

/**
 * Handles the creation of table `m_city`.
 */
class m170406_144949_create_m_city_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('m_city', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'code' => $this->string(8),
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
        $this->dropTable('m_city');
    }
}
