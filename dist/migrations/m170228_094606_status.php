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
            'group_name' => $this->string(50)->notNull()->comment("The name of the status group"),
            'label' => $this->string(128)->comment("The label of the status")
        ]);
        $this->createTable('{{%object_status}}', [
            'object_id' => $this->integer(11)->notNull()->comment("The link to your model"),
            'group_name' => $this->string(50)->notNull()->comment("The name of the status group"),
            'status_id' => $this->integer(11)->notNull()->comment("The value of the status")
        ]);
        $this->createIndex('{{%idx-object_status-group_name}}', '{{%object_status}}', ['{{%object_id}}', '{{%group_name}}'], true);
        $this->createIndex('{{%idx-object_status-status_id}}', '{{%object_status}}', ['{{%object_id}}', '{{%status_id}}'], true);
        $this->addForeignKey('{{%fk-object_status-status_id-status-id}}', '{{%object_status}}', '{{%status_Id}}', '{{%status}}', '{{%id}}', 'cascade', 'cascade');
    }

    /** @inheritdoc */
    function safeDown()
    {
        $this->dropForeignKey('{{%fk-object_status-status_id-status-id}}', '{{%object_status}}');
        $this->dropIndex('{{%idx-object_status-status_id}}', '{{%object_status}}');
        $this->dropIndex('{{%idx-object_status-group_name}}', '{{%object_status}}');
        $this->dropTable('{{%object_status}}');
        $this->dropTable('{{%status}}');
    }
}
