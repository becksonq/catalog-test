<?php

use yii\db\Migration;

/**
 * Handles the creation of table '{{%data}}'.
 */
class m210311_173918_create_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        Yii::$app->db->createCommand()->batchInsert('currency', ['type', 'rate'], [
            ['рубль', '1'],
            ['доллар', '8'],
            ['евро', '10'],
        ])->execute();

        Yii::$app->db->createCommand()->batchInsert('promocodes', ['name', 'value', 'type', 'start', 'end'], [
            ['Скидка 10 рублей', 10, 1, null, null],
            ['Скидка 10 процентов', 10, 0, null, null],
        ])->execute();

        Yii::$app->db->createCommand()->batchInsert('products', [
            'name',
            'slug',
            'price',
            'old_price',
            'currency_id',
            'status',
            'created_at',
            'updated_at',
            'promocode_id',
            'promo_status'
        ], [
            ['Product 1 (рубль)', 'product-1-rubl', 90, 100, 1, 1, 1615322729, 1615483650, 1, 1],
            ['Product 2 (dollar)', 'product-2-dollar', 1.8, 2, 2, 1, 1615362164, 1615483581, 2, 1],
            ['Product 3 (euro)', 'product-3-euro', 3, null, 3, 1, 1615363966, 1615365970, null, 0],
            ['Product 4 (Rubles)', 'product-4-rubles', 600, null, 1, 1, 1615444567, 1615483659, 2, 0],
        ])->execute();

        Yii::$app->db->createCommand()->delete('user')->execute();

        Yii::$app->db->createCommand()->insert('user', [
            'username'             => 'admin',
            'auth_key'             => 'PjLpOWZel4UjZP2r5Xo1N24XXttiIwBr',
            'password_hash'        => '$2y$13$ahGSc8OGxalUcQDFxYJEFefaIBnzT9M.zgGzpQngYvnH21WXwp9ly',
            'password_reset_token' => null,
            'email'                => 'admin@mail.ru',
            'status'               => 10,
            'created_at'           => 1615312597,
            'updated_at'           => 1615312597,
            'verification_token'   => 'osi7W9nVxb6U-9Ay6CLjdmuC8sgI4CQK_1615312597',
        ])->execute();
    }
}
