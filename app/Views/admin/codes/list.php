<?= $this->extend('layout') ?>

<?= $this->section('title') ?>Admin - Codes<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row mb-4">
    <div class="col-lg-9">
        <h2><i class="fas fa-gift"></i> Gestion des codes portefeuille</h2>
    </div>
    <div class="col-lg-3 text-end">
        <a href="/admin/codes/create" class="btn btn-info">
            <i class="fas fa-plus-circle me-2"></i> Créer
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Code</th>
                        <th>Montant</th>
                        <th>Utilisé</th>
                        <th>Par</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($codes as $code): ?>
                        <tr>
                            <td><code><?= $code['code'] ?></code></td>
                            <td><?= $code['montant'] ?>€</td>
                            <td>
                                <?php if ($code['is_used']): ?>
                                    <span class="badge bg-success">Oui</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Non</span>
                                <?php endif; ?>
                            </td>
                            <td><?= $code['utilisateur_id'] ? $code['utilisateur_id'] : '-' ?></td>
                            <td><?= $code['used_at'] ? date('d/m/Y', strtotime($code['used_at'])) : '-' ?></td>
                            <td>
                                <form method="POST" action="/admin/codes/delete/<?= $code['id'] ?>" style="display:inline;">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
