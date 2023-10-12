<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%Apartment}}`.
 */
class m230525_171659_create_Apartment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%Apartment}}', [
            'id' => $this->primaryKey(),
            'type' =>$this->integer()->notNull(),
            'count' =>$this->integer()->notNull(),
            'floor' =>$this->integer()->notNull(),
            'area' => $this->integer()->notNull(),
            'price' => $this->integer()->defaultValue(0),
            'descrip'=>$this->text(),
        ]);

        $this->addForeignKey(
            'type',  // это "условное имя" ключа
            'Apartment', // это название текущей таблицы
            'type', // это имя поля в текущей таблице, которое будет ключом
            'TypeRoom', // это имя таблицы, с которой хотим связаться
            'id', // это поле таблицы, с которым хотим связаться
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%Apartment}}');
        $this->dropForeignKey(
            'type',
            'TypeRoom'
        );
    }
}
