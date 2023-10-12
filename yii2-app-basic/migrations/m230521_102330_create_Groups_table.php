<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%Groups}}`.
 */
class m230521_102330_create_Groups_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%Groups}}', [
            'id' => $this->primaryKey(),
            'idT' => $this->integer()->notNull(),
            'idDate' => $this->integer()->notNull(),
            'CountMin' => $this->integer()->notNull(),
            'CountMax' => $this->integer()->notNull(),
            'CountCur' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'idT',  // это "условное имя" ключа
            'Groups', // это название текущей таблицы
            'idT', // это имя поля в текущей таблице, которое будет ключом
            'Tours', // это имя таблицы, с которой хотим связаться
            'id', // это поле таблицы, с которым хотим связаться
            'CASCADE'
        );

        $this->addForeignKey(
            'idDate',  // это "условное имя" ключа
            'Groups', // это название текущей таблицы
            'idDate', // это имя поля в текущей таблице, которое будет ключом
            'DateTours', // это имя таблицы, с которой хотим связаться
            'id', // это поле таблицы, с которым хотим связаться
            'CASCADE'
        );

        $this->addForeignKey(
            'status',  // это "условное имя" ключа
            'Groups', // это название текущей таблицы
            'status', // это имя поля в текущей таблице, которое будет ключом
            'Statuses', // это имя таблицы, с которой хотим связаться
            'id', // это поле таблицы, с которым хотим связаться
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%Groups}}');
        $this->dropForeignKey(
            'idT',
            'Tours'
        );
        $this->dropForeignKey(
            'idDate',
            'DateTours'
        );
        $this->dropForeignKey(
            'status',
            'Statuses'
        );
    }
}
