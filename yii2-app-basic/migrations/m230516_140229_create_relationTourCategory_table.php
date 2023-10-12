<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%relationTourCategory}}`.
 */
class m230516_140229_create_relationTourCategory_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%relationTourCategory}}', [
            'id' => $this->primaryKey(),
            'tourId' => $this->integer()->notNull(),
            'categoryId' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'tourId',  // это "условное имя" ключа
            'relationTourCategory', // это название текущей таблицы
            'tourId', // это имя поля в текущей таблице, которое будет ключом
            'tours', // это имя таблицы, с которой хотим связаться
            'id', // это поле таблицы, с которым хотим связаться
            'CASCADE'
        );

        $this->addForeignKey(
            'categoryId',  // это "условное имя" ключа
            'relationTourCategory', // это название текущей таблицы
            'categoryId', // это имя поля в текущей таблице, которое будет ключом
            'categoryTours', // это имя таблицы, с которой хотим связаться
            'id', // это поле таблицы, с которым хотим связаться
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%relationTourCategory}}');

        $this->dropForeignKey(
            'tourId',
            'tours'
        );
        $this->dropForeignKey(
            'categoryId',
            'categoryTours'
        );
    }
}
