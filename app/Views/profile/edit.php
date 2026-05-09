<?= $this->extend('layout') ?>

<?= $this->section('title') ?>Éditer mon profil<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    <i class="fas fa-edit"></i> Modifier mon profil
                </h4>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="/profile/update">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom complet</label>
                        <input type="text" class="form-control" id="nom" name="nom" 
                               value="<?= $user['nom'] ?>" required>
                        <?php if (isset($errors['nom'])): ?>
                            <small class="text-danger"><?= $errors['nom'] ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="taille" class="form-label">Taille (cm)</label>
                            <input type="number" class="form-control" id="taille" name="taille" 
                                   min="50" max="300" value="<?= $user['taille'] ?>" required>
                            <?php if (isset($errors['taille'])): ?>
                                <small class="text-danger"><?= $errors['taille'] ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="poids" class="form-label">Poids (kg)</label>
                            <input type="number" class="form-control" id="poids" name="poids" 
                                   min="20" max="300" step="0.1" value="<?= $user['poids'] ?>" required>
                            <?php if (isset($errors['poids'])): ?>
                                <small class="text-danger"><?= $errors['poids'] ?></small>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <strong>IMC actuel:</strong> <?= $user['imc'] ?>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Sauvegarder
                        </button>
                        <a href="/profile/view" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-2"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
