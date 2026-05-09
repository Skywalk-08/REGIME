<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nom'                 => 'Jean Dupont',
                'email'               => 'jean@test.com',
                'genre'               => 'M',
                'taille'              => 180,
                'poids'               => 85.5,
                'imc'                 => 26.4,
                'password'            => password_hash('password123', PASSWORD_BCRYPT),
                'is_admin'            => 0,
                'wallet_balance'      => 50.00,
                'profile_completed'   => 1,
                'created_at'          => date('Y-m-d H:i:s'),
            ],
            [
                'nom'                 => 'Marie Martin',
                'email'               => 'marie@test.com',
                'genre'               => 'F',
                'taille'              => 165,
                'poids'               => 62.3,
                'imc'                 => 22.9,
                'password'            => password_hash('password123', PASSWORD_BCRYPT),
                'is_admin'            => 0,
                'wallet_balance'      => 30.00,
                'profile_completed'   => 1,
                'created_at'          => date('Y-m-d H:i:s'),
            ],
            [
                'nom'                 => 'Pierre Lefevre',
                'email'               => 'pierre@test.com',
                'genre'               => 'M',
                'taille'              => 175,
                'poids'               => 92.1,
                'imc'                 => 30.1,
                'password'            => password_hash('password123', PASSWORD_BCRYPT),
                'is_admin'            => 0,
                'wallet_balance'      => 0.00,
                'profile_completed'   => 1,
                'created_at'          => date('Y-m-d H:i:s'),
            ],
            [
                'nom'                 => 'Sophie Bernard',
                'email'               => 'sophie@test.com',
                'genre'               => 'F',
                'taille'              => 170,
                'poids'               => 58.2,
                'imc'                 => 20.1,
                'password'            => password_hash('password123', PASSWORD_BCRYPT),
                'is_admin'            => 0,
                'wallet_balance'      => 100.00,
                'profile_completed'   => 1,
                'created_at'          => date('Y-m-d H:i:s'),
            ],
            [
                'nom'                 => 'Thomas Moreau',
                'email'               => 'thomas@test.com',
                'genre'               => 'M',
                'taille'              => 182,
                'poids'               => 75.5,
                'imc'                 => 22.8,
                'password'            => password_hash('password123', PASSWORD_BCRYPT),
                'is_admin'            => 0,
                'wallet_balance'      => 75.50,
                'profile_completed'   => 0,
                'created_at'          => date('Y-m-d H:i:s'),
            ],
            [
                'nom'                 => 'Admin Régime',
                'email'               => 'admin@regime.local',
                'genre'               => 'M',
                'taille'              => 180,
                'poids'               => 80.0,
                'imc'                 => 24.7,
                'password'            => password_hash('password123', PASSWORD_BCRYPT),
                'is_admin'            => 1,
                'wallet_balance'      => 999.99,
                'profile_completed'   => 1,
                'created_at'          => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
