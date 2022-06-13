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
            'lower_value' => 134217728,
        ]);
        $this->insert('{{%size_types}}', [
            'code' => 'st_large',
            'lower_value' => 268435456,
        ]);
        $this->insert('{{%size_types}}', [
            'code' => 'st_giant',
            'lower_value' => 536870912,
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
