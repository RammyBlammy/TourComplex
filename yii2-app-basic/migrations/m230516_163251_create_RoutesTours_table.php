<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%RoutesTours}}`.
 */
class m230516_163251_create_RoutesTours_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%RoutesTours}}', [
            'id' => $this->primaryKey(),
            'idTour' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
        ]);

        $this->addForeignKey(
            'idTour',  // это "условное имя" ключа
            'RoutesTours', // это название текущей таблицы
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
        $this->dropTable('{{%RoutesTours}}');

        $this->dropForeignKey(
            'idTour',
            'tours'
        );
    }


}
