<?php

use yii\db\Migration;

/**
 * Class m220820_201429_service_ids
 */
class m220820_201429_service_ids extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%service}}', 'games_id');

        $this->createTable('{{%service_games}}', [
            'id' => $this->primaryKey(),
            'service_id' => $this->text(),
            'games_id' => $this->text()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220820_201429_service_ids cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220820_201429_service_ids cannot be reverted.\n";

        return false;
    }
    */
}
