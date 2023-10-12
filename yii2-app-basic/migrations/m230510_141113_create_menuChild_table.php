<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%menuChild}}`.
 */
class m230510_141113_create_menuChild_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%menuChild}}', [
            'id' => $this->primaryKey(),
            'foodId' => $this->integer()->notNull(),
            '1ed' => $this->integer()->notNull(),
            'unit' => $this->string(10)->notNull(),
            'count' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'foodInd',  // это "условное имя" ключа
            'menuChild', // это название текущей таблицы
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
        $this->dropTable('{{%menuChild}}');

        $this->dropForeignKey(
            'foodId',
            'foodCatalog'
        );
    }
}
