<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%file_data}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%file_formats}}`
 * - `{{%size_types}}`
 * - `{{%word_count_types}}`
 */
class m220327_202053_create_file_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%file_data}}', [
            'id' => $this->primaryKey(),
            'size' => $this->integer(),
            'word_count' => $this->integer(),
            'file_format_id' => $this->integer(),
            'size_type_id' => $this->integer(),
            'word_count_type_id' => $this->integer(),
        ]);

        // creates index for column `file_format_id`
        $this->createIndex(
            '{{%idx-file_data-file_format_id}}',
            '{{%file_data}}',
            'file_format_id'
        );

        // add foreign key for table `{{%file_formats}}`
        $this->addForeignKey(
            '{{%fk-file_data-file_format_id}}',
            '{{%file_data}}',
            'file_format_id',
            '{{%file_formats}}',
            'id',
            'SET NULL'
        );

        // creates index for column `size_type_id`
        $this->createIndex(
            '{{%idx-file_data-size_type_id}}',
            '{{%file_data}}',
            'size_type_id'
        );

        // add foreign key for table `{{%size_types}}`
        $this->addForeignKey(
            '{{%fk-file_data-size_type_id}}',
            '{{%file_data}}',
            'size_type_id',
            '{{%size_types}}',
            'id',
            'SET NULL'
        );

        // creates index for column `word_count_type_id`
        $this->createIndex(
            '{{%idx-file_data-word_count_type_id}}',
            '{{%file_data}}',
            'word_count_type_id'
        );

        // add foreign key for table `{{%word_count_types}}`
        $this->addForeignKey(
            '{{%fk-file_data-word_count_type_id}}',
            '{{%file_data}}',
            'word_count_type_id',
            '{{%word_count_types}}',
            'id',
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%file_formats}}`
        $this->dropForeignKey(
            '{{%fk-file_data-file_format_id}}',
            '{{%file_data}}'
        );

        // drops index for column `file_format_id`
        $this->dropIndex(
            '{{%idx-file_data-file_format_id}}',
            '{{%file_data}}'
        );

        // drops foreign key for table `{{%size_types}}`
        $this->dropForeignKey(
            '{{%fk-file_data-size_type_id}}',
            '{{%file_data}}'
        );

        // drops index for column `size_type_id`
        $this->dropIndex(
            '{{%idx-file_data-size_type_id}}',
            '{{%file_data}}'
        );

        // drops foreign key for table `{{%word_count_types}}`
        $this->dropForeignKey(
            '{{%fk-file_data-word_count_type_id}}',
            '{{%file_data}}'
        );

        // drops index for column `word_count_type_id`
        $this->dropIndex(
            '{{%idx-file_data-word_count_type_id}}',
            '{{%file_data}}'
        );

        $this->dropTable('{{%file_data}}');
    }
}
