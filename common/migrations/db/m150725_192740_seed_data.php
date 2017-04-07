<?php

use common\models\User;
use yii\db\Migration;

class m150725_192740_seed_data extends Migration
{
    public function safeUp()
    {
        $this->insert('{{%user}}', [
            'id' => 1,
            'username' => 'administrator',
            'email' => 'administrator@example.com',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('123456'),
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
            'access_token' => Yii::$app->getSecurity()->generateRandomString(40),
            'status' => User::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $this->insert('{{%user_profile}}', [
            'user_id' => 1,
            'locale' => Yii::$app->sourceLanguage,
            'firstname' => 'Admin',
            'lastname' => ''
        ]);


        $this->insert('{{%page}}', [
            'slug' => 'about',
            'title' => 'About',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'status' => \common\models\Page::STATUS_PUBLISHED,
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('{{%article_category}}', [
            'id' => 1,
            'slug' => 'news',
            'title' => 'News',
            'status' => \common\models\ArticleCategory::STATUS_ACTIVE,
            'created_at' => time()
        ]);

        $this->insert('{{%key_storage_item}}', [
            'key' => 'backend.theme-skin',
            'value' => 'skin-blue',
            'comment' => 'skin-blue, skin-black, skin-purple, skin-green, skin-red, skin-yellow'
        ]);

        $this->insert('{{%key_storage_item}}', [
            'key' => 'backend.layout-fixed',
            'value' => 0
        ]);

        $this->insert('{{%key_storage_item}}', [
            'key' => 'backend.layout-boxed',
            'value' => 0
        ]);

        $this->insert('{{%key_storage_item}}', [
            'key' => 'backend.layout-collapsed-sidebar',
            'value' => 0
        ]);

        $this->insert('{{%key_storage_item}}', [
            'key' => 'frontend.maintenance',
            'value' => 'disabled',
            'comment' => 'Set it to "true" to turn on maintenance mode'
        ]);

        $this->insert('{{%key_storage_item}}', [
            'key' => 'pageSize',
            'value' => '5',
            'comment' => 'Số Item mỗi trang'
        ]);

        $this->insert('{{%key_storage_item}}', [
            'key' => 'gara.year',
            'value' => '2017',
            'comment' => 'Năm tài chính'
        ]);
    }

    public function safeDown()
    {
        $this->delete('{{%key_storage_item}}', [
            'key' => 'frontend.maintenance'
        ]);

        $this->delete('{{%key_storage_item}}', [
            'key' => [
                'backend.theme-skin',
                'backend.layout-fixed',
                'backend.layout-boxed',
                'backend.layout-collapsed-sidebar',
                'garage.pageSize',
            ],
        ]);

        $this->delete('{{%article_category}}', [
            'id' => 1
        ]);

        $this->delete('{{%page}}', [
            'slug' => 'about'
        ]);

        $this->delete('{{%user_profile}}', [
            'user_id' => [1]
        ]);

        $this->delete('{{%user}}', [
            'id' => [1]
        ]);
    }
}
