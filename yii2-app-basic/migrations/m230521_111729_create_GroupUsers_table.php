<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%GroupUsers}}`.
 */
class m230521_111729_create_GroupUsers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%GroupUsers}}', [
            'id' => $this->primaryKey(),
            'idGroup' => $this->integer()->notNull(),
            'idClient' => $this->integer()->notNull(),
            'count' => $this->integer()->notNull(),
            'menuStand' => $this->integer(),
            'menuPl' => $this->integer(),
            'menuCh' => $this->integer(),
            'confirm' => $this->boolean(),
            'price' => $this->integer()->defaultValue(0),
        ]);

        $this->addForeignKey(
            'idGroup',  // это "условное имя" ключа
            'GroupUsers', // это название текущей таблицы
            'idGroup', // это имя поля в текущей таблице, которое будет ключом
            'Groups', // это имя таблицы, с которой хотим связаться
            'id', // это поле таблицы, с которым хотим связаться
            'CASCADE'
        );

        $this->addForeignKey(
            'idClient',  // это "условное имя" ключа
            'GroupUsers', // это название текущей таблицы
            'idClient', // это имя поля в текущей таблице, которое будет ключом
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
        $this->dropTable('{{%GroupUsers}}');
        $this->dropForeignKey(
            'idGroup',
            'Groups'
        );
        $this->dropForeignKey(
            'idClient',
            'Clients'
        );
    }
}
