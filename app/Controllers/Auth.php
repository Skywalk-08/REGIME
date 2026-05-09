<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Show register page - Step 1 (User Info)
     */
    public function registerStep1()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/register_step1');
    }

    /**
     * Process register step 1
     */
    public function registerStep1Post()
    {
        $rules = [
            'nom'   => 'required|string|min_length[3]|max_length[100]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'genre' => 'required|in_list[M,F]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userData = [
            'nom'   => $this->request->getPost('nom'),
            'email' => $this->request->getPost('email'),
            'genre' => $this->request->getPost('genre'),
        ];

        session()->set('register_data', $userData);

        return redirect()->to('/auth/register-step2');
    }

    /**
     * Show register page - Step 2 (Health Info)
     */
    public function registerStep2()
    {
        if (!session()->get('register_data')) {
            return redirect()->to('/auth/register-step1');
        }

        return view('auth/register_step2');
    }

    /**
     * Process register step 2
     */
    public function registerStep2Post()
    {
        $rules = [
            'taille'   => 'required|numeric|greater_than[50]|less_than[300]',
            'poids'    => 'required|numeric|greater_than[20]|less_than[300]',
            'password' => 'required|min_length[6]|max_length[255]',
            'confirm_password' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $registerData = session()->get('register_data');
        $taille = (int)$this->request->getPost('taille');
        $poids = (float)$this->request->getPost('poids');

        // Calculate IMC: poids (kg) / (taille (m))²
        $taille_m = $taille / 100;
        $imc = round($poids / ($taille_m * $taille_m), 2);

        $newUser = [
            'nom'       => $registerData['nom'],
            'email'     => $registerData['email'],
            'genre'     => $registerData['genre'],
            'taille'    => $taille,
            'poids'     => $poids,
            'imc'       => $imc,
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'profile_completed' => 0,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        if ($this->userModel->insert($newUser)) {
            session()->remove('register_data');
            return redirect()->to('/auth/login')->with('success', 'Inscription réussie! Veuillez vous connecter.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Une erreur est survenue lors de l\'inscription.');
        }
    }

    /**
     * Show login page
     */
    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/login');
    }

    /**
     * Process login
     */
    public function loginPost()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('email', $email)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Email ou mot de passe incorrect.');
        }

        // Set session
        session()->set([
            'user_id'     => $user['id'],
            'user_email'  => $user['email'],
            'user_nom'    => $user['nom'],
            'is_gold'     => $user['is_gold'],
            'logged_in'   => true,
        ]);

        if ($user['profile_completed']) {
            return redirect()->to('/dashboard');
        } else {
            return redirect()->to('/profile/complete');
        }
    }

    /**
     * Logout
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/')->with('success', 'Déconnexion réussie.');
    }
}
