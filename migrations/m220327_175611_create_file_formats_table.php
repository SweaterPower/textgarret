<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%file_formats}}`.
 */
class m220327_175611_create_file_formats_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%file_formats}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(128)->notNull(),
            'extension' => $this->string(10)->notNull(),
            'mime_type' => $this->string(128)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%file_formats}}');
    }
}
