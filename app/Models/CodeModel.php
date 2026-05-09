<?php

namespace App\Models;

use CodeIgniter\Model;

class CodeModel extends Model
{
    protected $table            = 'codes_portefeuille';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'code',
        'montant',
        'is_used',
        'utilisateur_id',
        'used_at',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';

    // Validations
    protected $validationRules    = [
        'code'      => 'required|string|max_length[20]|is_unique[codes_portefeuille.code]',
        'montant'   => 'required|numeric|greater_than[0]',
    ];

    protected $validationMessages = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    /**
     * Get code by code string
     */
    public function getByCode(string $code)
    {
        return $this->where('code', $code)->first();
    }

    /**
     * Check if code is valid (exists and not used)
     */
    public function isCodeValid(string $code): bool
    {
        $codeData = $this->getByCode($code);
        return $codeData && !$codeData['is_used'];
    }

    /**
     * Use a code
     */
    public function useCode(string $code, int $userId): bool
    {
        $codeData = $this->getByCode($code);
        
        if (!$codeData) {
            return false;
        }

        return $this->update($codeData['id'], [
            'is_used'        => 1,
            'utilisateur_id' => $userId,
            'used_at'        => date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Get unused codes
     */
    public function getUnusedCodes()
    {
        return $this->where('is_used', 0)->findAll();
    }

    /**
     * Get used codes
     */
    public function getUsedCodes()
    {
        return $this->where('is_used', 1)->findAll();
    }
}
