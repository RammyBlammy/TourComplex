<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%Tours}}`.
 */
class m230515_174142_create_Tours_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%Tours}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'hours' => $this->integer()->notNull(),
            'price' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%Tours}}');
    }
}
