<?php

use yii\db\Migration;

/**
 * Handles adding cancelled to table `user_test`.
 */
class m180513_085823_add_completed_column_to_user_test_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user_test', 'completed', $this->integer(2)->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user_test', 'completed');
    }
}
