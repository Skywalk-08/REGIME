<?= $this->extend('layout') ?>

<?= $this->section('title') ?>Admin - Activités<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row mb-4">
    <div class="col-lg-9">
        <h2><i class="fas fa-dumbbell"></i> Gestion des activités sportives</h2>
    </div>
    <div class="col-lg-3 text-end">
        <a href="/admin/activites/create" class="btn btn-success">
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
                        <th>Nom</th>
                        <th>Calories/h</th>
                        <th>Difficulté</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($activites as $act): ?>
                        <tr>
                            <td><?= $act['nom'] ?></td>
                            <td><?= $act['calories_brulees'] ?></td>
                            <td>
                                <span class="badge bg-<?= $act['difficulte'] === 'facile' ? 'success' : ($act['difficulte'] === 'moyen' ? 'warning' : 'danger') ?>">
                                    <?= ucfirst($act['difficulte']) ?>
                                </span>
                            </td>
                            <td>
                                <form method="POST" action="/admin/activites/delete/<?= $act['id'] ?>" style="display:inline;">
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
