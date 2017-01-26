<?php

use yii\db\Migration;

/**
 * Handles the creation of table `image`.
 */
class m170124_122823_create_image_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('image', [
            'id' => $this->primaryKey(),
            'name' => $this->string(40)->notNull(),
            'width' => $this->integer(),
            'height' => $this->integer(),
            'confident_level' => $this->integer(),
            'gender' => $this->string(8),
            'link' => $this->string(1000),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('image');
    }
}
