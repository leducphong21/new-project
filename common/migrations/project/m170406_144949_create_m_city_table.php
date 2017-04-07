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
