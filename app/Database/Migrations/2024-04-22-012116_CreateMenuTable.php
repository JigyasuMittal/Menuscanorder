<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMenuTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'item_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'user_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'item_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2'
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'category' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ]
        ]);

        $this->forge->addKey('item_id', true);
        $this->forge->createTable('menu');
    }

    public function down()
    {
        $this->forge->dropTable('menu');
    }
}
