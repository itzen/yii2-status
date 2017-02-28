<?php

use yii\db\Migration;

/**
 * Class m170228_094606_status
 */
class m170228_094606_status extends Migration
{
    /** @inheritdoc */
    function safeUp()
    {
        $this->createTable('{{%status}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(45)->unique()->notNull()->comment("The name of the status"),
            'priority' => $this->integer(),
            'object_key' => $this->string(128)->notNull()->comment("The object of the status")
        ]);
    }

    /** @inheritdoc */
    function safeDown()
    {
        $this->dropTable('{{%status}}');
    }
}
