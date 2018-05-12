<?php

use yii\db\Migration;

/**
 * Handles the creation of table `test`.
 */
class m180509_181305_create_test_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('test', [
            'id' => $this->primaryKey(),
            'discipline_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->text()->notNull()
        ]);

        $this->addForeignKey(
            'fk-test-discipline_id',
            'test',
            'discipline_id',
            'discipline',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-test-author_id',
            'test',
            'author_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-test-author_id', 'test');
        $this->dropForeignKey('fk-test-discipline_id', 'test');
        $this->dropTable('test');
    }
}
