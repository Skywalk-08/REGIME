<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RegimeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nom'                    => 'Regime Proteines',
                'description'            => 'Riche en protéines pour la prise de muscle',
                'pourcentage_viande'     => 40,
                'pourcentage_poisson'    => 30,
                'pourcentage_volaille'   => 30,
                'prix_base'              => 15.99,
                'duree_jours'            => 30,
                'poids_variation_min'    => -1.0,
                'poids_variation_max'    => 5.0,
                'created_at'             => date('Y-m-d H:i:s'),
            ],
            [
                'nom'                    => 'Regime Equilibre',
                'description'            => 'Régime équilibré pour la stabilisation',
                'pourcentage_viande'     => 25,
                'pourcentage_poisson'    => 35,
                'pourcentage_volaille'   => 40,
                'prix_base'              => 12.99,
                'duree_jours'            => 30,
                'poids_variation_min'    => -2.0,
                'poids_variation_max'    => 2.0,
                'created_at'             => date('Y-m-d H:i:s'),
            ],
            [
                'nom'                    => 'Regime Minceur',
                'description'            => 'Régime hypocalorique pour la perte de poids',
                'pourcentage_viande'     => 30,
                'pourcentage_poisson'    => 40,
                'pourcentage_volaille'   => 30,
                'prix_base'              => 18.99,
                'duree_jours'            => 30,
                'poids_variation_min'    => -5.0,
                'poids_variation_max'    => -1.0,
                'created_at'             => date('Y-m-d H:i:s'),
            ],
            [
                'nom'                    => 'Regime Athletique',
                'description'            => 'Régime sportif haute performance',
                'pourcentage_viande'     => 35,
                'pourcentage_poisson'    => 35,
                'pourcentage_volaille'   => 30,
                'prix_base'              => 22.99,
                'duree_jours'            => 60,
                'poids_variation_min'    => -3.0,
                'poids_variation_max'    => 3.0,
                'created_at'             => date('Y-m-d H:i:s'),
            ],
            [
                'nom'                    => 'Regime Vegetarien',
                'description'            => 'Régime sans viande mais riche en protéines',
                'pourcentage_viande'     => 0,
                'pourcentage_poisson'    => 50,
                'pourcentage_volaille'   => 50,
                'prix_base'              => 14.99,
                'duree_jours'            => 30,
                'poids_variation_min'    => -2.5,
                'poids_variation_max'    => 1.5,
                'created_at'             => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('regimes')->insertBatch($data);
    }
}
