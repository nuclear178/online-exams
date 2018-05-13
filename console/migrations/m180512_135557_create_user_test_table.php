<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_test`.
 */
class m180512_135557_create_user_test_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_test', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'test_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-user_test-user_id',
            'user_test',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-user_test-test_id',
            'user_test',
            'test_id',
            'test',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-user_test-test_id', 'user_test');
        $this->dropForeignKey('fk-user_test-user_id', 'user_test');
        $this->dropTable('user_test');
    }
}
