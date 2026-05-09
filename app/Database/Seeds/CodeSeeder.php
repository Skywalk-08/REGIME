<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CodeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['code' => 'CODE2026BIENVENUE', 'montant' => 10.00, 'is_used' => 0, 'utilisateur_id' => null, 'used_at' => null, 'created_at' => date('Y-m-d H:i:s')],
            ['code' => 'DISCOUNT50', 'montant' => 50.00, 'is_used' => 1, 'utilisateur_id' => 1, 'used_at' => date('Y-m-d H:i:s'), 'created_at' => date('Y-m-d H:i:s')],
            ['code' => 'GOLD20', 'montant' => 20.00, 'is_used' => 0, 'utilisateur_id' => null, 'used_at' => null, 'created_at' => date('Y-m-d H:i:s')],
            ['code' => 'SUMMER100', 'montant' => 100.00, 'is_used' => 0, 'utilisateur_id' => null, 'used_at' => null, 'created_at' => date('Y-m-d H:i:s')],
            ['code' => 'WELCOME25', 'montant' => 25.00, 'is_used' => 1, 'utilisateur_id' => 2, 'used_at' => date('Y-m-d H:i:s'), 'created_at' => date('Y-m-d H:i:s')],
            ['code' => 'PROMO15', 'montant' => 15.00, 'is_used' => 0, 'utilisateur_id' => null, 'used_at' => null, 'created_at' => date('Y-m-d H:i:s')],
            ['code' => 'FLASH30', 'montant' => 30.00, 'is_used' => 0, 'utilisateur_id' => null, 'used_at' => null, 'created_at' => date('Y-m-d H:i:s')],
            ['code' => 'LOYALTY40', 'montant' => 40.00, 'is_used' => 1, 'utilisateur_id' => 3, 'used_at' => date('Y-m-d H:i:s'), 'created_at' => date('Y-m-d H:i:s')],
            ['code' => 'FRIEND20', 'montant' => 20.00, 'is_used' => 0, 'utilisateur_id' => null, 'used_at' => null, 'created_at' => date('Y-m-d H:i:s')],
            ['code' => 'NEWBIE10', 'montant' => 10.00, 'is_used' => 1, 'utilisateur_id' => 4, 'used_at' => date('Y-m-d H:i:s'), 'created_at' => date('Y-m-d H:i:s')],
            ['code' => 'POWER50', 'montant' => 50.00, 'is_used' => 0, 'utilisateur_id' => null, 'used_at' => null, 'created_at' => date('Y-m-d H:i:s')],
            ['code' => 'EXTRA25', 'montant' => 25.00, 'is_used' => 0, 'utilisateur_id' => null, 'used_at' => null, 'created_at' => date('Y-m-d H:i:s')],
            ['code' => 'MEGA100', 'montant' => 100.00, 'is_used' => 0, 'utilisateur_id' => null, 'used_at' => null, 'created_at' => date('Y-m-d H:i:s')],
            ['code' => 'PRIME30', 'montant' => 30.00, 'is_used' => 0, 'utilisateur_id' => null, 'used_at' => null, 'created_at' => date('Y-m-d H:i:s')],
            ['code' => 'ULTIMATE75', 'montant' => 75.00, 'is_used' => 0, 'utilisateur_id' => null, 'used_at' => null, 'created_at' => date('Y-m-d H:i:s')],
        ];

        $this->db->table('codes_portefeuille')->insertBatch($data);
    }
}
