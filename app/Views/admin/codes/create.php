<?= $this->extend('layout') ?>

<?= $this->section('title') ?>Admin - Créer un code<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0"><i class="fas fa-plus-circle"></i> Créer un code portefeuille</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="/admin/codes/store">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="code" class="form-label">Code *</label>
                        <input type="text" class="form-control" id="code" name="code" placeholder="ex: CODE2026" required>
                        <small class="text-muted">Le code sera automatiquement mis en majuscules</small>
                    </div>

                    <div class="mb-3">
                        <label for="montant" class="form-label">Montant (€) *</label>
                        <input type="number" class="form-control" id="montant" name="montant" 
                               step="0.01" min="0.01" required placeholder="ex: 50.00">
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-info">
                            <i class="fas fa-save me-2"></i> Créer le code
                        </button>
                        <a href="/admin/codes" class="btn btn-outline-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
