<?php

use yii\db\Migration;

/**
 * Handles the creation of table `m_county`.
 */
class m170406_144937_create_m_county_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('m_county', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'code' => $this->string(8),
            'city_id' => $this->integer(),
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
        $this->dropTable('m_county');
    }
}
