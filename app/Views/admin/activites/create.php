<?= $this->extend('layout') ?>

<?= $this->section('title') ?>Admin - Créer une activité<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0"><i class="fas fa-plus-circle"></i> Créer une activité</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="/admin/activites/store">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom *</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="calories_brulees" class="form-label">Calories brûlées/heure</label>
                        <input type="number" class="form-control" id="calories_brulees" name="calories_brulees" min="0">
                    </div>

                    <div class="mb-3">
                        <label for="difficulte" class="form-label">Difficulté *</label>
                        <select class="form-select" id="difficulte" name="difficulte" required>
                            <option value="facile">Facile</option>
                            <option value="moyen">Moyen</option>
                            <option value="difficile">Difficile</option>
                        </select>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-2"></i> Créer
                        </button>
                        <a href="/admin/activites" class="btn btn-outline-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
