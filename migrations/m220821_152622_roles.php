<?php

use yii\db\Migration;

/**
 * Class m220821_152622_roles
 */
class m220821_152622_roles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('roles', [
            'id' => $this->primaryKey(),
            'type' => $this->string()->notNull()->unique()
        ]);

        $this->insert('roles',
            ['type'=>'Admin']
        );

        $this->insert('roles',
            ['type'=>'User']
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220821_152622_roles cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220821_152622_roles cannot be reverted.\n";

        return false;
    }
    */
}
