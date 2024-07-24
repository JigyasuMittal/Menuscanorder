<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MenuscanorderDataSeeder extends Seeder
{
    public function run()
    {
        $menuData = [
            [
                'item_id' => 'item1',
                'user_id' => 'user1',
                'item_name' => 'Margherita Pizza',
                'price' => '7.99',
                'description' => 'Classic Margherita with mozzarella cheese and fresh basil',
                'category' => 'Pizza'
            ],
            [
                'item_id' => 'item2',
                'user_id' => 'user1',
                'item_name' => 'Pepperoni Pizza',
                'price' => '8.99',
                'description' => 'Pepperoni with mozzarella and tomato sauce',
                'category' => 'Pizza'
            ],
            // Add more items as needed
        ];

        foreach ($menuData as $data) {
            // Using Query Builder
            $this->db->table('menu')->insert($data);
        }
    }
}
