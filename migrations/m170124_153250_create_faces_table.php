<?php

use yii\db\Migration;

/**
 * Handles the creation of table `faces`.
 * Has foreign keys to the tables:
 *
 * - `image`
 */
class m170124_153250_create_faces_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('faces', [
            'id' => $this->primaryKey(),
            'image_id' => $this->integer()->notNull(),
            'confident_level' => $this->string(),
            'gender' => $this->string(),
        ]);

        // creates index for column `image_id`
        $this->createIndex(
            'idx-faces-image_id',
            'faces',
            'image_id'
        );

        // add foreign key for table `image`
        $this->addForeignKey(
            'fk-faces-image_id',
            'faces',
            'image_id',
            'image',
            'id',
            'CASCADE'
        );
    }

    
    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `image`
        $this->dropForeignKey(
            'fk-faces-image_id',
            'faces'
        );

        // drops index for column `image_id`
        $this->dropIndex(
            'idx-faces-image_id',
            'faces'
        );

        $this->dropTable('faces');
    }
}
