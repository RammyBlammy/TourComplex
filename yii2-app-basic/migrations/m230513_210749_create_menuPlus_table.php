<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%menuPlus}}`.
 */
class m230513_210749_create_menuPlus_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%menuPlus}}', [
            'id' => $this->primaryKey(),
            'foodId' => $this->integer()->notNull(),
            '1ed' => $this->integer()->notNull(),
            'unit' => $this->string(10)->notNull(),
            'count' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'foodIndex',  // это "условное имя" ключа
            'menuPlus', // это название текущей таблицы
            'foodId', // это имя поля в текущей таблице, которое будет ключом
            'foodCatalog', // это имя таблицы, с которой хотим связаться
            'id', // это поле таблицы, с которым хотим связаться
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%menuPlus}}');
        $this->dropForeignKey(
            'foodId',
            'foodCatalog'
        );
    }
}
