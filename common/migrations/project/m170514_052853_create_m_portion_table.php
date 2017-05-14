<?php

use yii\db\Migration;

/**
 * Handles the creation of table `m_portion`.
 */
class m170514_052853_create_m_portion_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('m_portion', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(255),
            'code'=>$this->string(8),
            'project_id'=>$this->integer(),
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
        $this->dropTable('m_portion');
    }
}
