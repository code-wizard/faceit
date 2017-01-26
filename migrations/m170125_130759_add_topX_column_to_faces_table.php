<?php

use yii\db\Migration;

/**
 * Handles adding topX to table `faces`.
 */
class m170125_130759_add_topX_column_to_faces_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('faces', 'top_left_x', $this->integer());
        $this->addColumn('faces', 'top_left_y', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('faces', 'top_left_x');
        $this->dropColumn('faces', 'top_left_y');
    }
}
