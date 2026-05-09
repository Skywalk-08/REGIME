<?= $this->extend('layout') ?>

<?= $this->section('title') ?>Connexion<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body p-5">
                <h3 class="card-title text-center mb-4">
                    <i class="fas fa-sign-in-alt"></i> Connexion
                </h3>

                <form method="POST" action="/auth/login">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="<?= old('email') ?>" required>
                        <?php if (isset($errors['email'])): ?>
                            <small class="text-danger"><?= $errors['email'] ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <?php if (isset($errors['password'])): ?>
                            <small class="text-danger"><?= $errors['password'] ?></small>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Se connecter
                    </button>
                </form>

                <hr class="my-4">

                <p class="text-center">
                    Pas encore de compte? 
                    <a href="/auth/register-step1">S'inscrire</a>
                </p>

                <div class="alert alert-info mt-4" role="alert">
                    <i class="fas fa-info-circle"></i> 
                    <strong>Compte de test:</strong><br>
                    Email: jean@test.com<br>
                    Mot de passe: password123
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
