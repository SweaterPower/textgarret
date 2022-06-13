<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%size_types}}`.
 */
class m220327_180419_create_size_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%size_types}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(10)->notNull(),
            'lower_value' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%size_types}}');
    }
}
