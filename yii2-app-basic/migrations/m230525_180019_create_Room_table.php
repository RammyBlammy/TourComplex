<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%Room}}`.
 */
class m230525_180019_create_Room_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%Room}}', [
            'id' => $this->primaryKey(),
            'idApart' =>$this->integer()->notNull(),
            'idCli' =>$this->integer()->notNull(),
            'dateIn' =>$this->date(),
            'dateOut' => $this->date(),
        ]);

        $this->addForeignKey(
            'idApart',  // это "условное имя" ключа
            'Room', // это название текущей таблицы
            'idApart', // это имя поля в текущей таблице, которое будет ключом
            'Apartment', // это имя таблицы, с которой хотим связаться
            'id', // это поле таблицы, с которым хотим связаться
            'CASCADE'
        );
        $this->addForeignKey(
            'idCli',  // это "условное имя" ключа
            'Room', // это название текущей таблицы
            'idCli', // это имя поля в текущей таблице, которое будет ключом
            'Clients', // это имя таблицы, с которой хотим связаться
            'id', // это поле таблицы, с которым хотим связаться
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%Room}}');
        $this->dropForeignKey(
            'idApart',
            'Apartment'
        );

        $this->dropForeignKey(
            'idCli',
            'Clients'
        );
    }
}
