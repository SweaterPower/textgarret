<?php

use yii\db\Migration;

/**
 * Class m220328_075537_fill_size_types_table
 */
class m220328_075537_fill_size_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%size_types}}', [
            'code' => 'st_small',
            'lower_value' => 0,
        ]);
        $this->insert('{{%size_types}}', [
            'code' => 'st_medium',
            'lower_value' => 10240,
        ]);
        $this->insert('{{%size_types}}', [
            'code' => 'st_large',
            'lower_value' => 10485760,
        ]);
        $this->insert('{{%size_types}}', [
            'code' => 'st_giant',
            'lower_value' => 1048576000,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%size_types}}');
    }
}
