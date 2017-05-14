<?php

use yii\db\Migration;

/**
 * Handles the creation of table `m_land`.
 */
class m170514_052909_create_m_land_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('m_land', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(255),
            'code'=>$this->string(8),
            'project_id'=>$this->integer(),
            'portion_id'=>$this->integer(),
            'acreage'=>$this->integer(),
            'location'=>$this->string(255),
            'deleted' => $this->smallInteger(8)->defaultValue(1),
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
        $this->dropTable('m_land');
    }
}
