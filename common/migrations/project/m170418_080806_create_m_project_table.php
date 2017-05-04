<?php

use yii\db\Migration;

/**
 * Handles the creation of table `m_project`.
 */
class m170418_080806_create_m_project_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('m_project', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'code' => $this->string(8),
            'project_category_id' => $this->integer(),
            'address' => $this->string(255),
            'acreage' => $this->integer(),
            'number_product' => $this->integer(),
            'county_id' => $this->integer(),
            'city_id' => $this->integer(),
            'deleted' => $this->smallInteger(2)->defaultValue(1),
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
        $this->dropTable('m_project');
    }
}
