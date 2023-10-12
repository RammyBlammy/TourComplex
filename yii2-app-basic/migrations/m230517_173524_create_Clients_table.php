<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%Clients}}`.
 */
class m230517_173524_create_Clients_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%Clients}}', [
            'id' => $this->primaryKey(),
            'userId' => $this->integer()->notNull(),
            'Familia' => $this->string(40)->notNull(),
            'Imya' => $this->string(40)->notNull(),
            'Otchestvo' =>$this->string(60)->notNull(),
            'birthday' => $this->date()->notNull(),
            'phone' => $this->string(20)->notNull(),
        ]);

        $this->addForeignKey(
            'userId',  // это "условное имя" ключа
            'Clients', // это название текущей таблицы
            'userId', // это имя поля в текущей таблице, которое будет ключом
            'User', // это имя таблицы, с которой хотим связаться
            'id', // это поле таблицы, с которым хотим связаться
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%Clients}}');
        $this->dropForeignKey(
            'userId',
            'User'
        );
    }
}
