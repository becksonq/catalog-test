<?php

use console\migrations\Migration;

/**
 * Handles the creation of table `{{%prices}}`.
 */
class m210318_075635_create_prices_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
//        $this->createTable('{{%prices}}', [
//            'id'          => $this->primaryKey(),
//            'price'       => $this->float(10.2)->defaultValue(0),
//            'oldprice'    => $this->float(10.2)->defaultValue(0),
//            'currency_id' => $this->integer()->notNull(),
//        ]);
//
//        $this->createIndex('idx-pricies-price', '{{%prices}}', 'price');
//
//        $this->dropForeignKey('fk-products-currency_id', '{{%products}}');
//
//        $this->dropColumn('{{%products}}', 'price');
//        $this->dropColumn('{{%products}}', 'old_price');
//        $this->dropColumn('{{%products}}', 'currency_id');
//
//        $this->addColumn('{{%products}}', 'price_id', $this->integer());
//
//        $this->addForeignKey('fk-products-price_id', '{{%products}}', 'price_id', '{{%prices}}', 'id', $this->restrict,
//            $this->cascade);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
//        $this->dropForeignKey('fk-products-price_id', '{{%products}}');
//
//        $this->dropColumn('{{%products}}', 'price_id');
//
//        $this->addColumn('{{%products}}', 'currency_id', $this->integer());
//        $this->addColumn('{{%products}}', 'old_price', $this->float(10.2));
//        $this->addColumn('{{%products}}', 'price', $this->float(10.2));
//
//        $this->addForeignKey('fk-products-currency_id', '{{%products}}', 'currency_id', '{{%currency}}', 'id');
//
//        $this->dropIndex('idx-pricies-price', '{{%prices}}');
//
//        $this->dropTable('{{%prices}}');
    }
}
