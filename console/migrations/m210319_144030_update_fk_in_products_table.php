<?php

use console\migrations\Migration;

/**
 * Class m210319_144030_update_fk_in_products_table
 */
class m210319_144030_update_fk_in_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk-products-promocode_id', '{{%products}}');
        $this->addForeignKey('fk-products-promocode_id', '{{%products}}', 'promocode_id', '{{%promocodes}}', 'id',
            'SET NULL', $this->cascade);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-products-promocode_id', '{{%products}}');
        $this->addForeignKey('fk-products-promocode_id', '{{%products}}', 'promocode_id', '{{%promocodes}}', 'id');
    }
}
