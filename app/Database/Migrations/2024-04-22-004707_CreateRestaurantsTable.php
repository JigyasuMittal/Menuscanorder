<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRestaurantsTable extends Migration
{
    public function up()
    {
        // Creating the 'restaurant' table
        $this->forge->addField([
            'user_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => true
            ],
            'contact' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ]
        ]);
        
        $this->forge->addKey('user_id', true); // Assuming 'user_id' is the primary key
        $this->forge->createTable('restaurant');
    }

    public function down()
    {
        // Dropping the 'restaurant' table
        $this->forge->dropTable('restaurant');
    }
}
