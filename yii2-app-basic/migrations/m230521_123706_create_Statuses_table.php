<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%Statuses}}`.
 */
class m230521_123706_create_Statuses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%Statuses}}', [
            'id' => $this->primaryKey(),
            'name' =>$this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%Statuses}}');
    }
}
