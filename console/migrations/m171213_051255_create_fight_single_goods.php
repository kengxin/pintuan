<?php

use yii\db\Migration;

/**
 * Class m171213_051255_create_fight_single_goods
 */
class m171213_051255_create_fight_single_goods extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('fight_single_goods', [
            'id' => $this->primaryKey(),
            'name' => 'VARCHAR(255) NOT NULL DEFAULT ""',
            'thumb' => 'VARCHAR(255) NOT NULL DEFAULT ""',
            'price' => 'INT(11) NOT NULL DEFAULT 0',
            'discount' => 'INT(11) NOT NULL DEFAULT 0',
            'member_count' => 'TINYINT(3) NOT NULL DEFAULT 0',
            'content' => 'TEXT',
            'created_at' => 'INT(11) NOT NULL DEFAULT 0'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171213_051255_create_fight_single_goods cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171213_051255_create_fight_single_goods cannot be reverted.\n";

        return false;
    }
    */
}
