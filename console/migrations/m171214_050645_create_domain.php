<?php

use yii\db\Migration;

/**
 * Class m171214_050645_create_domain
 */
class m171214_050645_create_domain extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('domain', [
            'id' => $this->primaryKey(),
            'domain' => 'VARCHAR(255) NOT NULL DEFAULT ""',
            'status' => 'TINYINT(1) NOT NULL DEFAULT 0',
            'closed_at' => 'INT(11) NOT NULL DEFAULT 0',
            'created_at' => 'INT(11) NOT NULL DEFAULT 0'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171214_050645_create_domain cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171214_050645_create_domain cannot be reverted.\n";

        return false;
    }
    */
}
