<?php

namespace App\Controllers\Admin;

use App\Models\RegimeModel;
use App\Models\ActiviteSportiveModel;
use App\Models\CodeModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AdminDashboard extends \App\Controllers\BaseController
{
    protected $regimeModel;
    protected $activiteModel;
    protected $codeModel;
    protected $userModel;

    public function __construct()
    {
        $this->regimeModel = new RegimeModel();
        $this->activiteModel = new ActiviteSportiveModel();
        $this->codeModel = new CodeModel();
        $this->userModel = new UserModel();
    }

    /**
     * Check if user is admin (you can add role-based system later)
     */
    protected function checkAdmin()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        // For now, allow only specific admin emails
        $adminEmails = ['admin@regime.local'];
        if (!in_array(session()->get('user_email'), $adminEmails)) {
            return redirect()->to('/dashboard')->with('error', 'Accès refusé.');
        }
    }

    /**
     * Show admin dashboard
     */
    public function index()
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        $totalUsers = $this->userModel->countAll();
        $goldUsers = $this->userModel->where('is_gold', 1)->countAllResults();
        $totalRegimes = $this->regimeModel->countAll();
        $totalActivites = $this->activiteModel->countAll();
        $totalCodes = $this->codeModel->countAll();

        $data = [
            'total_users'    => $totalUsers,
            'gold_users'     => $goldUsers,
            'total_regimes'  => $totalRegimes,
            'total_activites' => $totalActivites,
            'total_codes'    => $totalCodes,
            'users'          => $this->userModel->orderBy('created_at', 'DESC')->limit(10)->findAll(),
        ];

        return view('admin/dashboard', $data);
    }

    // ============ REGIME MANAGEMENT ============

    /**
     * List regimes
     */
    public function regimes()
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        $regimes = $this->regimeModel->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'regimes' => $regimes,
        ];

        return view('admin/regimes/list', $data);
    }

    /**
     * Create regime form
     */
    public function createRegime()
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        return view('admin/regimes/create');
    }

    /**
     * Store new regime
     */
    public function storeRegime()
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        $rules = [
            'nom'                   => 'required|string|max_length[150]',
            'pourcentage_viande'    => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]',
            'pourcentage_poisson'   => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]',
            'pourcentage_volaille'  => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]',
            'prix_base'             => 'required|numeric|greater_than[0]',
            'duree_jours'           => 'required|numeric|greater_than[0]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $viande = (int)$this->request->getPost('pourcentage_viande');
        $poisson = (int)$this->request->getPost('pourcentage_poisson');
        $volaille = (int)$this->request->getPost('pourcentage_volaille');

        if (($viande + $poisson + $volaille) != 100) {
            return redirect()->back()->withInput()->with('error', 'Les pourcentages doivent totaliser 100%.');
        }

        $data = [
            'nom'                    => $this->request->getPost('nom'),
            'description'            => $this->request->getPost('description'),
            'pourcentage_viande'     => $viande,
            'pourcentage_poisson'    => $poisson,
            'pourcentage_volaille'   => $volaille,
            'prix_base'              => (float)$this->request->getPost('prix_base'),
            'duree_jours'            => (int)$this->request->getPost('duree_jours'),
            'poids_variation_min'    => (float)$this->request->getPost('poids_variation_min') ?? null,
            'poids_variation_max'    => (float)$this->request->getPost('poids_variation_max') ?? null,
            'created_at'             => date('Y-m-d H:i:s'),
        ];

        if ($this->regimeModel->insert($data)) {
            return redirect()->to('/admin/regimes')->with('success', 'Régime créé avec succès.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Erreur lors de la création.');
        }
    }

    /**
     * Edit regime form
     */
    public function editRegime($id)
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        $regime = $this->regimeModel->find($id);
        if (!$regime) {
            return redirect()->to('/admin/regimes')->with('error', 'Régime non trouvé.');
        }

        $data = [
            'regime' => $regime,
        ];

        return view('admin/regimes/edit', $data);
    }

    /**
     * Update regime
     */
    public function updateRegime($id)
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        $regime = $this->regimeModel->find($id);
        if (!$regime) {
            return redirect()->to('/admin/regimes')->with('error', 'Régime non trouvé.');
        }

        $rules = [
            'nom'                   => 'required|string|max_length[150]',
            'pourcentage_viande'    => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]',
            'pourcentage_poisson'   => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]',
            'pourcentage_volaille'  => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]',
            'prix_base'             => 'required|numeric|greater_than[0]',
            'duree_jours'           => 'required|numeric|greater_than[0]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $viande = (int)$this->request->getPost('pourcentage_viande');
        $poisson = (int)$this->request->getPost('pourcentage_poisson');
        $volaille = (int)$this->request->getPost('pourcentage_volaille');

        if (($viande + $poisson + $volaille) != 100) {
            return redirect()->back()->withInput()->with('error', 'Les pourcentages doivent totaliser 100%.');
        }

        $data = [
            'nom'                    => $this->request->getPost('nom'),
            'description'            => $this->request->getPost('description'),
            'pourcentage_viande'     => $viande,
            'pourcentage_poisson'    => $poisson,
            'pourcentage_volaille'   => $volaille,
            'prix_base'              => (float)$this->request->getPost('prix_base'),
            'duree_jours'            => (int)$this->request->getPost('duree_jours'),
            'poids_variation_min'    => (float)$this->request->getPost('poids_variation_min') ?? null,
            'poids_variation_max'    => (float)$this->request->getPost('poids_variation_max') ?? null,
        ];

        if ($this->regimeModel->update($id, $data)) {
            return redirect()->to('/admin/regimes')->with('success', 'Régime mis à jour.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Erreur lors de la mise à jour.');
        }
    }

    /**
     * Delete regime
     */
    public function deleteRegime($id)
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        if ($this->regimeModel->delete($id)) {
            return redirect()->to('/admin/regimes')->with('success', 'Régime supprimé.');
        } else {
            return redirect()->back()->with('error', 'Erreur lors de la suppression.');
        }
    }

    // ============ ACTIVITY MANAGEMENT ============

    /**
     * List activities
     */
    public function activites()
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        $activites = $this->activiteModel->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'activites' => $activites,
        ];

        return view('admin/activites/list', $data);
    }

    /**
     * Create activity form
     */
    public function createActivite()
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        return view('admin/activites/create');
    }

    /**
     * Store new activity
     */
    public function storeActivite()
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        $rules = [
            'nom'        => 'required|string|max_length[150]',
            'difficulte' => 'required|in_list[facile,moyen,difficile]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nom'               => $this->request->getPost('nom'),
            'description'       => $this->request->getPost('description'),
            'calories_brulees'  => (int)$this->request->getPost('calories_brulees') ?? null,
            'difficulte'        => $this->request->getPost('difficulte'),
            'created_at'        => date('Y-m-d H:i:s'),
        ];

        if ($this->activiteModel->insert($data)) {
            return redirect()->to('/admin/activites')->with('success', 'Activité créée.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Erreur lors de la création.');
        }
    }

    /**
     * Delete activity
     */
    public function deleteActivite($id)
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        if ($this->activiteModel->delete($id)) {
            return redirect()->to('/admin/activites')->with('success', 'Activité supprimée.');
        } else {
            return redirect()->back()->with('error', 'Erreur lors de la suppression.');
        }
    }

    // ============ CODE MANAGEMENT ============

    /**
     * List codes
     */
    public function codes()
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        $codes = $this->codeModel->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'codes' => $codes,
        ];

        return view('admin/codes/list', $data);
    }

    /**
     * Create code form
     */
    public function createCode()
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        return view('admin/codes/create');
    }

    /**
     * Store new code
     */
    public function storeCode()
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        $rules = [
            'code'    => 'required|string|max_length[20]|is_unique[codes_portefeuille.code]',
            'montant' => 'required|numeric|greater_than[0]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'code'       => strtoupper($this->request->getPost('code')),
            'montant'    => (float)$this->request->getPost('montant'),
            'is_used'    => 0,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        if ($this->codeModel->insert($data)) {
            return redirect()->to('/admin/codes')->with('success', 'Code créé.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Erreur lors de la création.');
        }
    }

    /**
     * Delete code
     */
    public function deleteCode($id)
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        if ($this->codeModel->delete($id)) {
            return redirect()->to('/admin/codes')->with('success', 'Code supprimé.');
        } else {
            return redirect()->back()->with('error', 'Erreur lors de la suppression.');
        }
    }
}
