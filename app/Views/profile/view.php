<?= $this->extend('layout') ?>

<?= $this->section('title') ?>Mon Profil<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    <i class="fas fa-user-circle"></i> Mon Profil
                </h4>
            </div>
            <div class="card-body p-4">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted">Informations personnelles</h6>
                        <p class="mb-2">
                            <strong>Nom:</strong> <?= $user['nom'] ?>
                        </p>
                        <p class="mb-2">
                            <strong>Email:</strong> <?= $user['email'] ?>
                        </p>
                        <p class="mb-2">
                            <strong>Genre:</strong> 
                            <?= $user['genre'] === 'M' ? 'Homme' : 'Femme' ?>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Informations de santé</h6>
                        <p class="mb-2">
                            <strong>Taille:</strong> <?= $user['taille'] ?> cm
                        </p>
                        <p class="mb-2">
                            <strong>Poids:</strong> <?= $user['poids'] ?> kg
                        </p>
                        <p class="mb-2">
                            <strong>IMC:</strong> <span class="badge bg-info"><?= $user['imc'] ?></span>
                        </p>
                    </div>
                </div>

                <hr>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted">Status Premium</h6>
                        <?php if ($user['is_gold']): ?>
                            <p class="mb-0">
                                <i class="fas fa-crown text-warning"></i> 
                                <span class="badge bg-warning text-dark">PREMIUM</span>
                            </p>
                        <?php else: ?>
                            <p class="mb-0">
                                <span class="badge bg-secondary">Standard</span>
                            </p>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Portefeuille</h6>
                        <p class="mb-0">
                            <strong><?= $user['wallet_balance'] ?>€</strong>
                        </p>
                    </div>
                </div>

                <hr>

                <h6 class="mb-3">Objectifs</h6>
                <?php if (!empty($objectives)): ?>
                    <div class="row mb-4">
                        <?php foreach ($objectives as $obj): ?>
                            <div class="col-md-4">
                                <div class="alert alert-info mb-2">
                                    <?php
                                        $labels = [
                                            'gain_weight' => '📈 Augmenter poids',
                                            'lose_weight' => '📉 Réduire poids',
                                            'ideal_imc' => '❤️ IMC idéal'
                                        ];
                                    ?>
                                    <?= $labels[$obj['type']] ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-muted">Aucun objectif défini</p>
                <?php endif; ?>

                <div class="mt-4">
                    <a href="/profile/edit" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i> Modifier le profil
                    </a>
                    <a href="/dashboard" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i> Retour
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
