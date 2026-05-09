<?php

namespace App\Models;

use CodeIgniter\Model;

class ActiviteSportiveModel extends Model
{
    protected $table            = 'activites_sportives';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = [
        'nom',
        'description',
        'calories_brulees',
        'difficulte',
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
        'nom'           => 'required|string|max_length[150]',
        'difficulte'    => 'required|in_list[facile,moyen,difficile]',
        'calories_brulees' => 'numeric|greater_than[0]',
    ];

    protected $validationMessages = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    /**
     * Get activities by difficulty
     */
    public function getByDifficulty(string $difficulty)
    {
        return $this->where('difficulte', $difficulty)->findAll();
    }

    /**
     * Get high-calorie activities (> 500 cal/hour)
     */
    public function getHighCalorieActivities()
    {
        return $this->where('calories_brulees >=', 500)->findAll();
    }

    /**
     * Get user activities history
     */
    public function getUserActivities(int $userId)
    {
        return $this->db->table('user_activites')
            ->select('user_activites.*, activites_sportives.*')
            ->join('activites_sportives', 'activites_sportives.id = user_activites.activite_id')
            ->where('user_activites.user_id', $userId)
            ->get()
            ->getResult();
    }
}
