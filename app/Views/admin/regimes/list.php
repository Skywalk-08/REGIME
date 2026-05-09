<?= $this->extend('layout') ?>

<?= $this->section('title') ?>Admin - Régimes<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row mb-4">
    <div class="col-lg-9">
        <h2><i class="fas fa-utensils"></i> Gestion des régimes</h2>
    </div>
    <div class="col-lg-3 text-end">
        <a href="/admin/regimes/create" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i> Créer un régime
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
                        <th>Viande</th>
                        <th>Poisson</th>
                        <th>Volaille</th>
                        <th>Prix</th>
                        <th>Durée</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($regimes as $regime): ?>
                        <tr>
                            <td><?= $regime['nom'] ?></td>
                            <td><?= $regime['pourcentage_viande'] ?>%</td>
                            <td><?= $regime['pourcentage_poisson'] ?>%</td>
                            <td><?= $regime['pourcentage_volaille'] ?>%</td>
                            <td><?= $regime['prix_base'] ?>€</td>
                            <td><?= $regime['duree_jours'] ?> jours</td>
                            <td>
                                <a href="/admin/regimes/edit/<?= $regime['id'] ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="/admin/regimes/delete/<?= $regime['id'] ?>" style="display:inline;">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Êtes-vous sûr?')">
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
