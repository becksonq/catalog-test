<?php

use console\migrations\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m210309_173307_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products}}', [
            'id'          => $this->primaryKey(),
            'name'        => $this->string()->notNull(),
            'slug'        => $this->string()->unique(),
            'price'       => $this->integer(),
            'currency_id' => $this->integer(),
            'status'      => $this->integer(1),
            'created_at'  => $this->integer()->unsigned()->notNull(),
            'updated_at'  => $this->integer()->unsigned()->notNull(),
        ]);

        $this->createIndex('idx-products-price', '{{%products}}', 'price');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-products-price', '{{%products}}');
        $this->dropTable('{{%products}}');
    }
}
