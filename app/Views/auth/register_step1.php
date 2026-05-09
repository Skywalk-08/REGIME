<?= $this->extend('layout') ?>

<?= $this->section('title') ?>Inscription - Étape 1<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body p-5">
                <h3 class="card-title text-center mb-4">
                    <i class="fas fa-user-plus"></i> Créer un compte
                </h3>

                <p class="text-center text-muted mb-4">Étape 1: Informations personnelles</p>

                <form method="POST" action="/auth/register-step1">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom complet</label>
                        <input type="text" class="form-control" id="nom" name="nom" 
                               value="<?= old('nom') ?>" required>
                        <?php if (isset($errors['nom'])): ?>
                            <small class="text-danger"><?= $errors['nom'] ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="<?= old('email') ?>" required>
                        <?php if (isset($errors['email'])): ?>
                            <small class="text-danger"><?= $errors['email'] ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="mb-4">
                        <label for="genre" class="form-label">Genre</label>
                        <select class="form-select" id="genre" name="genre" required>
                            <option value="">-- Sélectionner --</option>
                            <option value="M" <?= old('genre') === 'M' ? 'selected' : '' ?>>Homme</option>
                            <option value="F" <?= old('genre') === 'F' ? 'selected' : '' ?>>Femme</option>
                        </select>
                        <?php if (isset($errors['genre'])): ?>
                            <small class="text-danger"><?= $errors['genre'] ?></small>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Continuer vers l'étape 2 <i class="fas fa-arrow-right ms-2"></i>
                    </button>
                </form>

                <p class="text-center mt-4">
                    Vous avez déjà un compte? 
                    <a href="/auth/login">Connectez-vous</a>
                </p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
