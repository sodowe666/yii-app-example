<?php


/**
 * Class m180113_075529_admin
 */
class m180113_075529_adminLog extends \yii\mongodb\Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        if ($this->db !== 'mongodb') {
            return false;
        }
        $tableOptions = null;
        $this->createCollection('{{%admin_log}}',
            [
                'uid' => 'int',
                'username' => 'string',
            ]);
        return true;
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        echo "m180113_075529_admin cannot be reverted.\n";
        //$this->dropTable('{{%admin}}');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180113_075529_admin cannot be reverted.\n";

        return false;
    }
    */
}
