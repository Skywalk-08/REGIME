<?php

namespace App\Models;

use CodeIgniter\Model;

class RegimeModel extends Model
{
    protected $table            = 'regimes';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = [
        'nom',
        'description',
        'pourcentage_viande',
        'pourcentage_poisson',
        'pourcentage_volaille',
        'prix_base',
        'duree_jours',
        'poids_variation_min',
        'poids_variation_max',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validations
    protected $validationRules    = [
        'nom'                   => 'required|string|max_length[150]',
        'pourcentage_viande'    => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]',
        'pourcentage_poisson'   => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]',
        'pourcentage_volaille'  => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]',
        'prix_base'             => 'required|numeric|greater_than[0]',
        'duree_jours'           => 'required|numeric|greater_than[0]',
    ];

    protected $validationMessages = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    protected $allowCallbacks = true;
    protected $beforeInsert   = ['validatePercentages'];
    protected $beforeUpdate   = ['validatePercentages'];

    /**
     * Validate that percentages sum to 100
     */
    protected function validatePercentages(array $data)
    {
        $viande = $data['data']['pourcentage_viande'] ?? 0;
        $poisson = $data['data']['pourcentage_poisson'] ?? 0;
        $volaille = $data['data']['pourcentage_volaille'] ?? 0;
        
        if (($viande + $poisson + $volaille) != 100) {
            throw new \Exception('Les pourcentages de viande, poisson et volaille doivent totaliser 100%');
        }
        return $data;
    }

    /**
     * Calculate price based on duration
     */
    public function calculatePrice(int $regimeId, int $dureeJours): float
    {
        $regime = $this->find($regimeId);
        if (!$regime) {
            return 0;
        }
        
        $baseDuration = $regime['duree_jours'];
        $basePrice = $regime['prix_base'];
        $pricePerDay = $basePrice / $baseDuration;
        
        return round($pricePerDay * $dureeJours, 2);
    }

    /**
     * Get regimes based on objectives
     */
    public function getRecommendedRegimes(string $objective): array
    {
        if ($objective == 'gain_weight') {
            return $this->where('pourcentage_viande >=', 35)->orderBy('prix_base', 'ASC')->findAll();
        } elseif ($objective == 'lose_weight') {
            return $this->where('pourcentage_poisson >=', 35)->orderBy('prix_base', 'ASC')->findAll();
        } else {
            return $this->orderBy('prix_base', 'ASC')->findAll();
        }
    }
}
