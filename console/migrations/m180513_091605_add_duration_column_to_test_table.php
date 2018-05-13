<?php

use yii\db\Migration;

/**
 * Handles adding duration to table `test`.
 */
class m180513_091605_add_duration_column_to_test_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('test', 'duration', $this->integer()->defaultValue(10));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('test', 'duration');
    }
}
