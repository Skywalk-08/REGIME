<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ActiviteSportiveSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nom'               => 'Course à pied',
                'description'       => 'Course d\'endurance',
                'calories_brulees'  => 600,
                'difficulte'        => 'moyen',
                'created_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'nom'               => 'Musculation',
                'description'       => 'Entraînement avec poids',
                'calories_brulees'  => 500,
                'difficulte'        => 'difficile',
                'created_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'nom'               => 'Yoga',
                'description'       => 'Étirement et flexibility',
                'calories_brulees'  => 200,
                'difficulte'        => 'facile',
                'created_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'nom'               => 'Natation',
                'description'       => 'Entraînement cardiovasculaire',
                'calories_brulees'  => 700,
                'difficulte'        => 'difficile',
                'created_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'nom'               => 'Cyclisme',
                'description'       => 'Vélo sur route ou montagne',
                'calories_brulees'  => 550,
                'difficulte'        => 'moyen',
                'created_at'        => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('activites_sportives')->insertBatch($data);
    }
}
