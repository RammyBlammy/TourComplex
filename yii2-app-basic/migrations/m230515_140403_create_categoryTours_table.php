<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%categoryTours}}`.
 */
class m230515_140403_create_categoryTours_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%categoryTours}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%categoryTours}}');
    }
}
