<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ObjectiveSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['user_id' => 1, 'type' => 'lose_weight', 'target_value' => 75.0, 'created_at' => date('Y-m-d H:i:s')],
            ['user_id' => 1, 'type' => 'ideal_imc', 'target_value' => 24.5, 'created_at' => date('Y-m-d H:i:s')],
            ['user_id' => 2, 'type' => 'gain_weight', 'target_value' => 65.0, 'created_at' => date('Y-m-d H:i:s')],
            ['user_id' => 3, 'type' => 'lose_weight', 'target_value' => 80.0, 'created_at' => date('Y-m-d H:i:s')],
            ['user_id' => 4, 'type' => 'ideal_imc', 'target_value' => 21.0, 'created_at' => date('Y-m-d H:i:s')],
        ];

        $this->db->table('objectives')->insertBatch($data);
    }
}
