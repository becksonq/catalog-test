<?php

use console\migrations\Migration;

/**
 * Handles the creation of table `{{%promocodes}}`.
 */
class m210310_213343_create_promocodes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%promocodes}}', [
            'id'    => $this->primaryKey(),
            'name'  => $this->string()->notNull(),
            'value' => $this->integer()->notNull(),
            'type'  => $this->smallInteger(1),
            'start' => $this->integer()->comment('Дата начала действия промокода'),
            'end'   => $this->integer()->comment('Дата окончания действия промокода'),
        ]);

        $this->addColumn('{{%products}}', 'promocode_id', $this->integer()->defaultValue(null));

        $this->createIndex('idx-products-promocode_id', '{{%products}}', 'promocode_id');
        $this->addForeignKey('fk-products-promocode_id', '{{%products}}', 'promocode_id', '{{%promocodes}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-products-promocode_id', '{{%products}}');
        $this->dropIndex('idx-products-promocode_id', '{{%products}}');

        $this->dropColumn('{{%products}}', 'promocode_id');

        $this->dropTable('{{%promocodes}}');
    }
}
