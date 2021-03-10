<?php

use console\migrations\Migration;

/**
 * Handles the creation of table `{{%currency}}`.
 */
class m210309_174236_create_currency_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%currency}}', [
            'id'   => $this->primaryKey(),
            'type' => $this->string()->notNull(),
            'rate' => $this->decimal()->notNull(),
        ]);

        $this->addForeignKey('fk-products-currency_id', '{{%products}}', 'currency_id', '{{%currency}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-products-currency_id', '{{%products}}');
        $this->dropTable('{{%currency}}');
    }
}
