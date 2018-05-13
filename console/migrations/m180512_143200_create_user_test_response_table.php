<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_test_response`.
 */
class m180512_143200_create_user_test_response_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_test_response', [
            'id' => $this->primaryKey(),
            'user_test_id' => $this->integer()->notNull(),
            'answer' => $this->integer(2)
        ]);

        $this->addForeignKey(
            'fk-user_test_response-user_test_id',
            'user_test_response',
            'user_test_id',
            'user_test',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-user_test_response-user_test_id', 'user_test_response');
        $this->dropTable('user_test_response');
    }
}
