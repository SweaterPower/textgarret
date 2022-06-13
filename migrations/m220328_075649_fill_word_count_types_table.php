<?php

use yii\db\Migration;

/**
 * Class m220328_075649_fill_word_count_types_table
 */
class m220328_075649_fill_word_count_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%word_count_types}}', [
            'code' => 'wc_small',
            'lower_value' => 0,
        ]);
        $this->insert('{{%word_count_types}}', [
            'code' => 'wc_medium',
            'lower_value' => 1000,
        ]);
        $this->insert('{{%word_count_types}}', [
            'code' => 'wc_large',
            'lower_value' => 10000,
        ]);
        $this->insert('{{%word_count_types}}', [
            'code' => 'wc_giant',
            'lower_value' => 100000,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%word_count_types}}');
    }
}
