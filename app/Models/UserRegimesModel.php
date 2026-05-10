<?php

namespace App\Models;

use CodeIgniter\Model;

class UserRegimesModel extends Model
{
    protected $table            = 'user_regimes';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = [
        'user_id',
        'regime_id',
        'date_debut',
        'date_fin',
        'prix_paye',
        'statut',
        'created_at',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
    protected $protectFields     = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = null;
    protected $deletedField  = null;

    // Validations
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation       = true;
    protected $cleanValidationRules = true;

    protected $allowCallbacks = true;

    /**
     * Get active regimes for a user
     */
    public function getActiveRegimes($userId)
    {
        return $this->where('user_id', $userId)
                    ->where('statut', 'actif')
                    ->where('date_fin >=', date('Y-m-d H:i:s'))
                    ->findAll();
    }

    /**
     * Get regime history for a user
     */
    public function getUserRegimeHistory($userId)
    {
        return $this->where('user_id', $userId)
                    ->orderBy('date_debut', 'DESC')
                    ->findAll();
    }

    /**
     * Check if user is already subscribed to a regime
     */
    public function isSubscribed($userId, $regimeId)
    {
        return $this->where('user_id', $userId)
                    ->where('regime_id', $regimeId)
                    ->where('statut', 'actif')
                    ->where('date_fin >=', date('Y-m-d H:i:s'))
                    ->countAllResults() > 0;
    }

    /**
     * Cancel an active regime subscription
     */
    public function cancelRegime($userRegimeId)
    {
        return $this->update($userRegimeId, ['statut' => 'annule']);
    }
}
