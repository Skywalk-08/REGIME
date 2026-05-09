<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ObjectiveModel;
use CodeIgniter\HTTP\ResponseInterface;

class Profile extends BaseController
{
    protected $userModel;
    protected $objectiveModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->objectiveModel = new ObjectiveModel();
    }

    /**
     * Complete profile - select objectives
     */
    public function complete()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        $data = [
            'user' => $user,
        ];

        return view('profile/complete', $data);
    }

    /**
     * Save objectives
     */
    public function saveObjectives()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        $userId = session()->get('user_id');
        $objectives = $this->request->getPost('objectives');

        if (!is_array($objectives) || empty($objectives) || count($objectives) > 3) {
            return redirect()->back()->with('error', 'Veuillez sélectionner entre 1 et 3 objectifs.');
        }

        // Remove existing objectives
        $this->objectiveModel->where('user_id', $userId)->delete();

        // Save new objectives
        foreach ($objectives as $type) {
            $this->objectiveModel->insert([
                'user_id' => $userId,
                'type'    => $type,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        // Mark profile as completed
        $this->userModel->update($userId, ['profile_completed' => 1]);

        return redirect()->to('/dashboard')->with('success', 'Profil complété avec succès!');
    }

    /**
     * View profile
     */
    public function view()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);
        $objectives = $this->objectiveModel->getUserObjectives($userId);

        $data = [
            'user'       => $user,
            'objectives' => $objectives,
        ];

        return view('profile/view', $data);
    }

    /**
     * Edit profile
     */
    public function edit()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        $data = [
            'user' => $user,
        ];

        return view('profile/edit', $data);
    }

    /**
     * Update profile
     */
    public function update()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth/login');
        }

        $userId = session()->get('user_id');

        $rules = [
            'nom'    => 'required|string|min_length[3]|max_length[100]',
            'taille' => 'required|numeric|greater_than[50]|less_than[300]',
            'poids'  => 'required|numeric|greater_than[20]|less_than[300]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $taille = (int)$this->request->getPost('taille');
        $poids = (float)$this->request->getPost('poids');

        // Calculate IMC
        $taille_m = $taille / 100;
        $imc = round($poids / ($taille_m * $taille_m), 2);

        $updateData = [
            'nom'    => $this->request->getPost('nom'),
            'taille' => $taille,
            'poids'  => $poids,
            'imc'    => $imc,
        ];

        if ($this->userModel->update($userId, $updateData)) {
            return redirect()->to('/profile/view')->with('success', 'Profil mis à jour avec succès!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Une erreur est survenue.');
        }
    }
}
