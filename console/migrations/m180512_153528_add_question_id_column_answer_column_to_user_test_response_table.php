<?php

use yii\db\Migration;

/**
 * Handles adding question_id_column_answer to table `user_test_response`.
 */
class m180512_153528_add_question_id_column_answer_column_to_user_test_response_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user_test_response', 'question_id', $this->integer());

        $this->addForeignKey(
            'fk-user_test_response-question_id',
            'user_test_response',
            'question_id',
            'question',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-user_test_response-question_id', 'user_test_response');
        $this->dropColumn('user_test_response', 'question_id');
    }
}
