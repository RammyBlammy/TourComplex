<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%TypeRoom}}`.
 */
class m230525_163226_create_TypeRoom_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%TypeRoom}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(100)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%TypeRoom}}');
    }
}
