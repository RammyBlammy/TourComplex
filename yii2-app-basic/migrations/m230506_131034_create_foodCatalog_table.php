<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%foodCatalog}}`.
 */
class m230506_131034_create_foodCatalog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%foodCatalog}}', [
            'id' => $this->primaryKey(),
            'product' => $this->string()->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%foodCatalog}}');
    }
}
