<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RegimeModel;
use App\Models\ActiviteSportiveModel;
use App\Models\ObjectiveModel;
use App\Models\CodeModel;
use App\Models\UserRegimesModel;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    protected $userModel;
    protected $regimeModel;
    protected $activiteModel;
    protected $objectiveModel;
    protected $codeModel;
    protected $userRegimesModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->regimeModel = new RegimeModel();
        $this->activiteModel = new ActiviteSportiveModel();
        $this->objectiveModel = new ObjectiveModel();
        $this->codeModel = new CodeModel();
        $this->userRegimesModel = new UserRegimesModel();
    }

    /**
     * Show dashboard
     */
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);
        $objectives = $this->objectiveModel->getUserObjectives($userId);
        $regimes = $this->regimeModel->findAll();
        $activites = $this->activiteModel->findAll();

        $data = [
            'user'       => $user,
            'objectives' => $objectives,
            'regimes'    => $regimes,
            'activites'  => $activites,
        ];

        return view('dashboard/index', $data);
    }

    /**
     * Get recommended regimes
     */
    public function getRecommendations()
    {
        if (!session()->get('logged_in')) {
            return $this->response->setStatusCode(401)->setJSON(['error' => 'Not logged in']);
        }

        $userId = session()->get('user_id');
        $objectives = $this->objectiveModel->getUserObjectives($userId);

        $recommendations = [];
        foreach ($objectives as $objective) {
            $regimes = $this->regimeModel->getRecommendedRegimes($objective['type']);
            $recommendations[$objective['type']] = $regimes;
        }

        return $this->response->setJSON($recommendations);
    }

    public function subscribeRegime()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        $userId = session()->get('user_id');
        $regimeId = $this->request->getPost('regime_id');
        $dureeJours = (int)$this->request->getPost('duree_jours') ?? 30;

        $regime = $this->regimeModel->find($regimeId);
        if (!$regime) {
            return redirect()->back()->with('error', 'Régime non trouvé.');
        }

        $user = $this->userModel->find($userId);
        $price = $this->regimeModel->calculatePrice($regimeId, $dureeJours);

        if ($user['is_gold']) {
            $price = $price * 0.85;
        }

        if ($user['wallet_balance'] < $price) {
            return redirect()->back()->with('error', 'Solde insuffisant dans le portefeuille.');
        }

        $this->userModel->update($userId, ['wallet_balance' => $user['wallet_balance'] - $price]);

        $dateDebut = date('Y-m-d H:i:s');
        $dateFin = date('Y-m-d H:i:s', strtotime("+$dureeJours days"));

        $this->userRegimesModel->insert([
            'user_id'    => $userId,
            'regime_id'  => $regimeId,
            'date_debut' => $dateDebut,
            'date_fin'   => $dateFin,
            'prix_paye'  => $price,
            'statut'     => 'actif',
        ]);

        return redirect()->to('/dashboard')->with('success', 'Régime ajouté avec succès!');
    }

    public function useCode()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        $userId = session()->get('user_id');
        $code = strtoupper($this->request->getPost('code'));

        $codeData = $this->codeModel->getByCode($code);

        if (!$codeData) {
            return redirect()->back()->with('error', 'Code invalide.');
        }

        if ($codeData['is_used']) {
            return redirect()->back()->with('error', 'Code déjà utilisé.');
        }

        // Use the code
        $this->codeModel->useCode($code, $userId);

        // Add money to wallet
        $user = $this->userModel->find($userId);
        $this->userModel->update($userId, ['wallet_balance' => $user['wallet_balance'] + $codeData['montant']]);

        return redirect()->back()->with('success', 'Code appliqué! ' . $codeData['montant'] . '€ ajoutés au portefeuille.');
    }

    public function upgradeGold()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        if ($user['is_gold']) {
            return redirect()->back()->with('info', 'Vous êtes déjà premium!');
        }

        $goldPrice = 29.99; 

        if ($user['wallet_balance'] < $goldPrice) {
            return redirect()->back()->with('error', 'Solde insuffisant. Veuillez ajouter des fonds.');
        }

        $this->userModel->update($userId, [
            'is_gold'           => 1,
            'gold_purchased_at' => date('Y-m-d H:i:s'),
            'wallet_balance'    => $user['wallet_balance'] - $goldPrice,
        ]);


        session()->set('is_gold', 1);

        return redirect()->to('/dashboard')->with('success', 'Vous êtes maintenant premium! Bénéficiez de 15% de réduction sur tous les régimes.');
    }

    public function activeRegimes()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        $userId = session()->get('user_id');
        $regimes = $this->userModel->getActiveRegimes($userId);

        $data = [
            'regimes' => $regimes,
        ];

        return view('dashboard/active_regimes', $data);
    }


    public function cancelRegime()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        $userRegimeId = $this->request->getPost('user_regime_id');

        $this->db->table('user_regimes')->update(['statut' => 'annule'], ['id' => $userRegimeId]);

        return redirect()->back()->with('success', 'Régime annulé.');
    }
}
