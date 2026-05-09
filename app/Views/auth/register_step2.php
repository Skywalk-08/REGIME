<?= $this->extend('layout') ?>

<?= $this->section('title') ?>Inscription - Étape 2<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body p-5">
                <h3 class="card-title text-center mb-4">
                    <i class="fas fa-heartbeat"></i> Complétez votre profil
                </h3>

                <p class="text-center text-muted mb-4">Étape 2: Informations de santé</p>

                <form method="POST" action="/auth/register-step2">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="taille" class="form-label">Taille (cm)</label>
                        <input type="number" class="form-control" id="taille" name="taille" 
                               min="50" max="300" value="<?= old('taille') ?>" required
                               placeholder="ex: 180">
                        <?php if (isset($errors['taille'])): ?>
                            <small class="text-danger"><?= $errors['taille'] ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="poids" class="form-label">Poids (kg)</label>
                        <input type="number" class="form-control" id="poids" name="poids" 
                               min="20" max="300" step="0.1" value="<?= old('poids') ?>" required
                               placeholder="ex: 75.5">
                        <?php if (isset($errors['poids'])): ?>
                            <small class="text-danger"><?= $errors['poids'] ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" required
                               placeholder="Minimum 6 caractères">
                        <?php if (isset($errors['password'])): ?>
                            <small class="text-danger"><?= $errors['password'] ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="mb-4">
                        <label for="confirm_password" class="form-label">Confirmer le mot de passe</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required
                               placeholder="Confirmez votre mot de passe">
                        <?php if (isset($errors['confirm_password'])): ?>
                            <small class="text-danger"><?= $errors['confirm_password'] ?></small>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-check-circle me-2"></i> Créer mon compte
                    </button>
                </form>

                <p class="text-center mt-4">
                    <small class="text-muted">Vos données sont sécurisées et confidentielles</small>
                </p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
