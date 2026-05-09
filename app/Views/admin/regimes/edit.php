<?= $this->extend('layout') ?>

<?= $this->section('title') ?>Admin - Modifier un régime<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-edit"></i> Modifier le régime</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="/admin/regimes/update/<?= $regime['id'] ?>">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom du régime *</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="<?= $regime['nom'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"><?= $regime['description'] ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="pourcentage_viande" class="form-label">Viande (%) *</label>
                            <input type="number" class="form-control" id="pourcentage_viande" 
                                   name="pourcentage_viande" min="0" max="100" value="<?= $regime['pourcentage_viande'] ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="pourcentage_poisson" class="form-label">Poisson (%) *</label>
                            <input type="number" class="form-control" id="pourcentage_poisson" 
                                   name="pourcentage_poisson" min="0" max="100" value="<?= $regime['pourcentage_poisson'] ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="pourcentage_volaille" class="form-label">Volaille (%) *</label>
                            <input type="number" class="form-control" id="pourcentage_volaille" 
                                   name="pourcentage_volaille" min="0" max="100" value="<?= $regime['pourcentage_volaille'] ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="prix_base" class="form-label">Prix (€) *</label>
                            <input type="number" class="form-control" id="prix_base" name="prix_base" 
                                   step="0.01" min="0" value="<?= $regime['prix_base'] ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="duree_jours" class="form-label">Durée (jours) *</label>
                            <input type="number" class="form-control" id="duree_jours" name="duree_jours" 
                                   min="1" value="<?= $regime['duree_jours'] ?>" required>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Mettre à jour
                        </button>
                        <a href="/admin/regimes" class="btn btn-outline-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
