<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%word_count_types}}`.
 */
class m220327_180631_create_word_count_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%word_count_types}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'lower_value' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%word_count_types}}');
    }
}
