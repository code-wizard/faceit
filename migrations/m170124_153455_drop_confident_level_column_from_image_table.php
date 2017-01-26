<?php

use yii\db\Migration;

/**
 * Handles dropping confident_level from table `image`.
 */
class m170124_153455_drop_confident_level_column_from_image_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn('image', 'confident_level');
        $this->dropColumn('image', 'gender');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn('image', 'confident_level', $this->integer());
        $this->addColumn('image', 'gender', $this->string());
    }
}
