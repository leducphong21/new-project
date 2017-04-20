<?php

use yii\db\Migration;

/**
 * Handles the creation of table `m_image`.
 */
class m170419_124609_create_m_image_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('m_image', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'logo' => $this->string(255),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('m_image');
    }
}
