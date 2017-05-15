<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news`.
 * Has foreign keys to the tables:
 *
 * - `category`
 */
class m170512_133133_create_news_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('news', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->defaultValue(1),
            'title' => $this->string(),
            'preview' => $this->string(200),
            'content' => $this->text(),
            'date' => $this->timestamp(),
        ]);

        // creates index for column `category_id`
        $this->createIndex(
            'idx-news-category_id',
            'news',
            'category_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-news-category_id',
            'news',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `category`
        $this->dropForeignKey(
            'fk-news-category_id',
            'news'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-news-category_id',
            'news'
        );

        $this->dropTable('news');
    }
}
