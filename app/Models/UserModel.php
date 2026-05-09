<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = [
        'nom',
        'email',
        'genre',
        'taille',
        'poids',
        'imc',
        'password',
        'is_gold',
        'gold_purchased_at',
        'wallet_balance',
        'profile_completed',
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
        'nom'      => 'required|string|max_length[100]',
        'email'    => 'required|valid_email|is_unique[users.email,id,{id}]',
        'genre'    => 'required|in_list[M,F]',
        'taille'   => 'required|numeric|greater_than[0]',
        'poids'    => 'required|numeric|greater_than[0]',
        'password' => 'required|min_length[6]',
    ];

    protected $validationMessages = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['hashPassword'];
    protected $beforeUpdate   = ['hashPassword', 'calculateIMC'];

    /**
     * Hash password before insert
     */
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
        }
        return $data;
    }

    /**
     * Calculate IMC before update
     */
    protected function calculateIMC(array $data)
    {
        if (isset($data['data']['taille']) || isset($data['data']['poids'])) {
            $taille = $data['data']['taille'] ?? $this->db->table('users')->select('taille')->where('id', $data['data']['id'] ?? 0)->get()->getRow()->taille ?? 0;
            $poids = $data['data']['poids'] ?? $this->db->table('users')->select('poids')->where('id', $data['data']['id'] ?? 0)->get()->getRow()->poids ?? 0;
            
            if ($taille > 0 && $poids > 0) {
                $taille_m = $taille / 100;
                $data['data']['imc'] = $poids / ($taille_m * $taille_m);
            }
        }
        return $data;
    }

    /**
     * Verify password
     */
    public function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    /**
     * Get user by email
     */
    public function getUserByEmail(string $email)
    {
        return $this->where('email', $email)->first();
    }

    /**
     * Update wallet balance
     */
    public function updateWallet(int $userId, float $amount): bool
    {
        return $this->update($userId, ['wallet_balance' => $this->db->raw("wallet_balance + $amount")]);
    }

    /**
     * Get objectives for user
     */
    public function getObjectives(int $userId)
    {
        return $this->db->table('objectives')->where('user_id', $userId)->get()->getResult();
    }

    /**
     * Get active regimes for user
     */
    public function getActiveRegimes(int $userId)
    {
        return $this->db->table('user_regimes')
            ->join('regimes', 'regimes.id = user_regimes.regime_id')
            ->where('user_regimes.user_id', $userId)
            ->where('user_regimes.statut', 'actif')
            ->get()
            ->getResult();
    }
}
