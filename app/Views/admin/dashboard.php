<?= $this->extend('layout') ?>

<?= $this->section('title') ?>Admin - Tableau de bord<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row mb-4">
    <div class="col-lg-12">
        <h2><i class="fas fa-cog"></i> Panneau d'administration</h2>
    </div>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card border-left-primary">
            <div class="card-body">
                <h6 class="text-muted mb-1">Utilisateurs</h6>
                <h3 class="mb-0"><?= $total_users ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-left-success">
            <div class="card-body">
                <h6 class="text-muted mb-1">Premium</h6>
                <h3 class="mb-0"><?= $gold_users ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-left-info">
            <div class="card-body">
                <h6 class="text-muted mb-1">Régimes</h6>
                <h3 class="mb-0"><?= $total_regimes ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-left-warning">
            <div class="card-body">
                <h6 class="text-muted mb-1">Codes</h6>
                <h3 class="mb-0"><?= $total_codes ?></h3>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mb-4">
    <div class="col-lg-12">
        <h4>Actions rapides</h4>
    </div>
    <div class="col-md-3">
        <a href="/admin/regimes" class="btn btn-primary w-100 mb-2">
            <i class="fas fa-utensils me-2"></i> Gérer régimes
        </a>
    </div>
    <div class="col-md-3">
        <a href="/admin/activites" class="btn btn-success w-100 mb-2">
            <i class="fas fa-dumbbell me-2"></i> Gérer activités
        </a>
    </div>
    <div class="col-md-3">
        <a href="/admin/codes" class="btn btn-info w-100 mb-2">
            <i class="fas fa-gift me-2"></i> Gérer codes
        </a>
    </div>
    <div class="col-md-3">
        <a href="/dashboard" class="btn btn-secondary w-100 mb-2">
            <i class="fas fa-arrow-left me-2"></i> Retour dashboard
        </a>
    </div>
</div>

<!-- Recent Users -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Utilisateurs récents</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>IMC</th>
                                <th>Status</th>
                                <th>Date création</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $u): ?>
                                <tr>
                                    <td><?= $u['nom'] ?></td>
                                    <td><?= $u['email'] ?></td>
                                    <td><?= $u['imc'] ?></td>
                                    <td>
                                        <?php if ($u['is_gold']): ?>
                                            <span class="badge bg-warning">Premium</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Standard</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($u['created_at'])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
