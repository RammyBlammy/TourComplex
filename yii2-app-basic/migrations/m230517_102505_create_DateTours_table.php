<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%DateTours}}`.
 */
class m230517_102505_create_DateTours_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%DateTours}}', [
            'id' => $this->primaryKey(),
            'idTour' => $this->integer()->notNull(),
            'start' => $this->date()->notNull(),
            'end' => $this->date()->notNull(),
            'days' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'idTour1',  // это "условное имя" ключа
            'DateTours', // это название текущей таблицы
            'idTour', // это имя поля в текущей таблице, которое будет ключом
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
        $this->dropTable('{{%DateTours}}');
        $this->dropForeignKey(
            'idTour',
            'tours'
        );
    }
}
