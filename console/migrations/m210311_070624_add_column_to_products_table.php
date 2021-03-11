<?php

use console\migrations\Migration;

/**
 * Handles adding columns to table `{{%products}}`.
 */
class m210311_070624_add_column_to_products_table extends Migration
{
    protected $table = '{{%products}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->table, 'promo_status', $this->boolean()->defaultValue(0));
        $this->createIndex('idx-products-promo_status', $this->table, 'promo_status');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-products-promo_status', $this->table);
        $this->dropColumn($this->table, 'promo_status');
    }
}
