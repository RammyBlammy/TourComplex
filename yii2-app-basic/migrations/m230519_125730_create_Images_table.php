<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%Images}}`.
 */
class m230519_125730_create_Images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%Images}}', [
            'id' => $this->primaryKey(),
            'tour' =>$this->integer()->notNull(),
            'image' => $this->string()->notNull(),
        ]);

        $this->addForeignKey(
            'tour',  // это "условное имя" ключа
            'Images', // это название текущей таблицы
            'tour', // это имя поля в текущей таблице, которое будет ключом
            'Tours', // это имя таблицы, с которой хотим связаться
            'id', // это поле таблицы, с которым хотим связаться
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%Images}}');
        $this->dropForeignKey(
            'tour',
            'tours'
        );
    }
}
