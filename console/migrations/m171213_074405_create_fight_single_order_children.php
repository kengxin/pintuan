<?php

use yii\db\Migration;

/**
 * Class m171213_074405_create_fight_single_order_children
 */
class m171213_074405_create_fight_single_order_children extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('fight_single_order_children', [
            'id' => $this->primaryKey(),
            'username' => 'VARCHAR(255) NOT NULL DEFAULT ""',
            'tel' => 'VARCHAR(11) NOT NULL DEFAULT 0',
            'is_chief' => 'TINYINT(1) NOT NULL DEFAULT 0',
            'pid' => 'INT(11) NOT NULL DEFAULT 0',
            'created_at' => 'INT(11) NOT NULL DEFAULT 0'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171213_074405_create_fight_single_order_children cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171213_074405_create_fight_single_order_children cannot be reverted.\n";

        return false;
    }
    */
}
