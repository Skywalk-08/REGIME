<?= $this->extend('layout') ?>

<?= $this->section('title') ?>Dashboard<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row mb-4">
    <div class="col-lg-12">
        <h2><i class="fas fa-chart-line"></i> Tableau de bord</h2>
        <p class="text-muted">Bienvenue, <?= session()->get('user_nom') ?>!</p>
    </div>
</div>

<!-- User Stats -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="text-muted mb-2">IMC</h6>
                <h3 class="mb-0"><?= $user['imc'] ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="text-muted mb-2">Poids</h6>
                <h3 class="mb-0"><?= $user['poids'] ?> kg</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="text-muted mb-2">Portefeuille</h6>
                <h3 class="mb-0 text-success"><?= $user['wallet_balance'] ?>€</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="text-muted mb-2">Status</h6>
                <?php if ($user['is_gold']): ?>
                    <span class="badge bg-warning text-dark fs-6">PREMIUM</span>
                <?php else: ?>
                    <span class="badge bg-secondary fs-6">Standard</span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Wallet Code Section -->
<div class="row mb-4">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-gift"></i> Ajouter du crédit</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="/dashboard/use-code">
                    <?= csrf_field() ?>
                    <div class="input-group">
                        <input type="text" class="form-control" name="code" placeholder="Entrez votre code" required>
                        <button class="btn btn-primary" type="submit">Appliquer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Premium Upgrade -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-crown"></i> Passer Premium</h5>
            </div>
            <div class="card-body">
                <?php if ($user['is_gold']): ?>
                    <p class="text-success mb-0">✓ Vous êtes Premium! Profitez de 15% de réduction sur tous les régimes.</p>
                <?php else: ?>
                    <p class="mb-3">Bénéficiez de 15% de réduction sur tous les régimes!</p>
                    <form method="POST" action="/dashboard/upgrade-gold">
                        <?= csrf_field() ?>
                        <button class="btn btn-warning w-100" type="submit">
                            <i class="fas fa-star me-2"></i> Passer Premium - 29.99€
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Regimes Section -->
<div class="row mb-4">
    <div class="col-lg-12">
        <h4 class="mb-3"><i class="fas fa-utensils"></i> Régimes disponibles</h4>
    </div>
    <?php foreach ($regimes as $regime): ?>
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><?= $regime['nom'] ?></h5>
                    <p class="card-text text-muted small"><?= substr($regime['description'], 0, 60) ?>...</p>
                    
                    <div class="row text-center mb-3">
                        <div class="col-4">
                            <small class="text-muted">🥩 Viande</small>
                            <p class="mb-0"><strong><?= $regime['pourcentage_viande'] ?>%</strong></p>
                        </div>
                        <div class="col-4">
                            <small class="text-muted">🐟 Poisson</small>
                            <p class="mb-0"><strong><?= $regime['pourcentage_poisson'] ?>%</strong></p>
                        </div>
                        <div class="col-4">
                            <small class="text-muted">🐔 Volaille</small>
                            <p class="mb-0"><strong><?= $regime['pourcentage_volaille'] ?>%</strong></p>
                        </div>
                    </div>

                    <p class="mb-2">
                        <strong><?= $regime['prix_base'] ?>€</strong>
                        <small class="text-muted">/ <?= $regime['duree_jours'] ?> jours</small>
                    </p>

                    <form method="POST" action="/dashboard/subscribe-regime">
                        <?= csrf_field() ?>
                        <input type="hidden" name="regime_id" value="<?= $regime['id'] ?>">
                        <input type="hidden" name="duree_jours" value="<?= $regime['duree_jours'] ?>">
                        <button class="btn btn-primary btn-sm w-100" type="submit">
                            <i class="fas fa-plus-circle me-1"></i> Ajouter
                        </button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Sports Activities -->
<div class="row">
    <div class="col-lg-12">
        <h4 class="mb-3"><i class="fas fa-dumbbell"></i> Activités sportives recommandées</h4>
    </div>
    <?php foreach ($activites as $activite): ?>
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= $activite['nom'] ?></h5>
                    <p class="card-text small text-muted"><?= $activite['description'] ?></p>
                    <div class="row text-center">
                        <div class="col-6">
                            <small class="text-muted">Calories</small>
                            <p class="mb-0"><strong><?= $activite['calories_brulees'] ?>/h</strong></p>
                        </div>
                        <div class="col-6">
                            <small class="text-muted">Difficulté</small>
                            <p class="mb-0">
                                <span class="badge bg-info"><?= $activite['difficulte'] ?></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>
