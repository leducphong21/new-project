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
