<?php

use yii\db\Migration;

/**
 * Class m171213_074359_create_fight_single_order
 */
class m171213_074359_create_fight_single_order extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('fight_single_order', [
            'id' => $this->primaryKey(),
            'good_id' => 'INT(11) NOT NULL DEFAULT 0',
            'created_at' => 'INT(11) NOT NULL DEFAULT 0'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171213_074359_create_fight_single_order cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171213_074359_create_fight_single_order cannot be reverted.\n";

        return false;
    }
    */
}
