<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%supplier}}`.
 */
class m220606_113230_create_supplier_table extends Migration
{
    private $_table = '{{%supplier}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sqlDir = Yii::getAlias('@console/migrations/sql/supplier.sql');
        $sql = file_get_contents($sqlDir);

        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->_table);
    }
}
