<?php

use yii\db\Migration;

/**
 * Handles the creation of table `question`.
 */
class m180511_105913_create_question_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('question', [
            'id' => $this->primaryKey(),
            'test_id' => $this->integer()->notNull(),
            'text' => $this->text()->notNull(),
            'option1' => $this->text()->notNull(),
            'option2' => $this->text()->notNull(),
            'option3' => $this->text()->notNull(),
            'option4' => $this->text()->notNull(),
            'correct_option' => $this->integer(2)->notNull(),
        ]);

        $this->addForeignKey(
            'fk-question-test_id',
            'question',
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
        $this->dropForeignKey('fk-question-test_id', 'question');
        $this->dropTable('question');
    }
}
