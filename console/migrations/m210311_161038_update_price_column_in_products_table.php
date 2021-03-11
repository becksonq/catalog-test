<?php

use console\migrations\Migration;

/**
 * Class m210311_161038_update_price_column_in_products_table
 */
class m210311_161038_update_price_column_in_products_table extends Migration
{
    protected $table = '{{%products}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn($this->table, 'price', $this->float(10.2));
        $this->alterColumn($this->table, 'old_price', $this->float(10.2));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn($this->table, 'old_price', $this->integer());
        $this->alterColumn($this->table, 'price', $this->integer());
    }
}
