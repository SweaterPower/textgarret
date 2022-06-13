<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%text_file}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%file_data}}`
 */
class m220327_203634_create_text_file_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%text_file}}', [
            'id' => $this->primaryKey(),
            'filename' => $this->string()->notNull(),
            'code' => $this->string()->notNull()->unique(),
            'upload_datetime' => $this->datetime(),
            'file_data_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `file_data_id`
        $this->createIndex(
            '{{%idx-text_file-file_data_id}}',
            '{{%text_file}}',
            'file_data_id'
        );

        // add foreign key for table `{{%file_data}}`
        $this->addForeignKey(
            '{{%fk-text_file-file_data_id}}',
            '{{%text_file}}',
            'file_data_id',
            '{{%file_data}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%file_data}}`
        $this->dropForeignKey(
            '{{%fk-text_file-file_data_id}}',
            '{{%text_file}}'
        );

        // drops index for column `file_data_id`
        $this->dropIndex(
            '{{%idx-text_file-file_data_id}}',
            '{{%text_file}}'
        );

        $this->dropTable('{{%text_file}}');
    }
}
