<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%menuStandart}}`.
 */
class m230512_161231_create_menuStandart_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%menuStandart}}', [
            'id' => $this->primaryKey(),
            'foodId' => $this->integer()->notNull(),
            '1ed' => $this->integer()->notNull(),
            'unit' => $this->string(10)->notNull(),
            'count' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'foodId',  // это "условное имя" ключа
            'menuStandart', // это название текущей таблицы
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
        $this->dropTable('{{%menuStandart}}');

        $this->dropForeignKey(
            'foodId',
            'foodCatalog'
        );
    }
}
