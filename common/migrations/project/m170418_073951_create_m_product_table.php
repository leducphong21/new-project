<?php

use yii\db\Migration;

/**
 * Handles the creation of table `m_product`.
 */
class m170418_073951_create_m_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('m_product', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'code' => $this->string(8),
            'product_category_id' => $this->integer(),
            'type' => $this->integer(),
            'project_id' => $this->integer(),
            'county_id' =>$this->integer(),
            'city_id' => $this->integer(),
            'price' => $this->integer(),
            'acreage' => $this->integer(),
            'total_price' => $this->integer(),
            'interest' => $this->integer(),
            'status_description' => $this->smallInteger(8)->defaultValue(1),
            'status' => $this->smallInteger(8)->defaultValue(1),
            'deleted' => $this->smallInteger(8)->defaultValue(1),
            'name_seller'=>$this->string(255),
            'address_seller'=>$this->string(255),
            'mobile_seller'=> $this->string(16),
            'email_seller'=> $this->string(255),
            'created_by' => $this->integer(),
            'created_at' => $this->date(),
            'updated_by' => $this->integer(),
            'updated_at' => $this->date(),
            'address' => $this->string(255),
            'floors' => $this->integer(),
            'rooms' => $this->integer(),
            'bedrooms' => $this->integer(),
            'bathrooms' => $this->integer(),
            'description' => $this->text(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('m_product');
    }
}
