<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTablesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'table_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'default' => null
            ],
            'user_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],
            'qr_code' => [
                'type' => 'VARCHAR',
                'constraint' => 300,
                'null' => true,
                'default' => null
            ]
        ]);

        $this->forge->addKey('table_id', true);
        $this->forge->createTable('tables');
    }

    public function down()
    {
        $this->forge->dropTable('tables');
    }
}
