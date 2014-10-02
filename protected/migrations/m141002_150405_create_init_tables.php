<?php

class m141002_150405_create_init_tables extends CDbMigration
{
	public function up()
	{
        $this->createTable('users', array(
            'id' => 'pk',
            'email' => 'VARCHAR(255) NOT NULL',
            'password' => 'VARCHAR(255) NOT NULL',
            'name' => 'VARCHAR(255) NOT NULL',
            'created' => 'TIMESTAMP',
        ));

        $this->createTable('lits', array(
            'id' => 'pk',
            'user_id' => 'INTEGER NOT NULL',
            'text' => 'text',
            'created' => 'TIMESTAMP',
        ));
	}

	public function down()
	{
		echo "m141002_150405_create_init_tables does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}