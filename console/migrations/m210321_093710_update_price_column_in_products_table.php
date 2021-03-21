<?php

use console\migrations\Migration;

/**
 * Class m210321_093710_update_price_column_in_products_table
 */
class m210321_093710_update_price_column_in_products_table extends Migration
{
    protected $table = '{{%products}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn($this->table, 'price', $this->float()->defaultValue(0.00));
        $this->alterColumn($this->table, 'old_price', $this->float()->defaultValue(0.00));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210321_093710_update_price_column_in_products_table cannot be reverted.\n";

        return false;
    }
}
