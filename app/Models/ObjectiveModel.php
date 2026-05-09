<?php

namespace App\Models;

use CodeIgniter\Model;

class ObjectiveModel extends Model
{
    protected $table            = 'objectives';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'user_id',
        'type',
        'target_value',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';

    // Validations
    protected $validationRules    = [
        'user_id'   => 'required|numeric',
        'type'      => 'required|in_list[gain_weight,lose_weight,ideal_imc]',
        'target_value' => 'numeric',
    ];

    protected $validationMessages = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    /**
     * Get user objectives
     */
    public function getUserObjectives(int $userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }

    /**
     * Check if user has an objective
     */
    public function hasObjective(int $userId, string $type): bool
    {
        $objective = $this->where('user_id', $userId)->where('type', $type)->first();
        return $objective !== null;
    }

    /**
     * Get max 3 objectives for user
     */
    public function getMax3Objectives(int $userId)
    {
        return $this->where('user_id', $userId)->limit(3)->findAll();
    }
}
