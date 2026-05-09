<?= $this->extend('layout') ?>

<?= $this->section('title') ?>Admin - Créer un régime<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-plus-circle"></i> Créer un régime</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="/admin/regimes/store">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom du régime *</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="pourcentage_viande" class="form-label">Viande (%) *</label>
                            <input type="number" class="form-control" id="pourcentage_viande" 
                                   name="pourcentage_viande" min="0" max="100" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="pourcentage_poisson" class="form-label">Poisson (%) *</label>
                            <input type="number" class="form-control" id="pourcentage_poisson" 
                                   name="pourcentage_poisson" min="0" max="100" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="pourcentage_volaille" class="form-label">Volaille (%) *</label>
                            <input type="number" class="form-control" id="pourcentage_volaille" 
                                   name="pourcentage_volaille" min="0" max="100" required>
                        </div>
                    </div>

                    <div class="alert alert-info" id="total_percentage">
                        Total: 0%
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="prix_base" class="form-label">Prix (€) *</label>
                            <input type="number" class="form-control" id="prix_base" name="prix_base" 
                                   step="0.01" min="0" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="duree_jours" class="form-label">Durée (jours) *</label>
                            <input type="number" class="form-control" id="duree_jours" name="duree_jours" 
                                   min="1" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="poids_variation_min" class="form-label">Var. poids min (kg)</label>
                            <input type="number" class="form-control" id="poids_variation_min" 
                                   name="poids_variation_min" step="0.1">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="poids_variation_max" class="form-label">Var. poids max (kg)</label>
                            <input type="number" class="form-control" id="poids_variation_max" 
                                   name="poids_variation_max" step="0.1">
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Créer le régime
                        </button>
                        <a href="/admin/regimes" class="btn btn-outline-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('pourcentage_viande').addEventListener('change', updateTotal);
document.getElementById('pourcentage_poisson').addEventListener('change', updateTotal);
document.getElementById('pourcentage_volaille').addEventListener('change', updateTotal);

function updateTotal() {
    const viande = parseInt(document.getElementById('pourcentage_viande').value) || 0;
    const poisson = parseInt(document.getElementById('pourcentage_poisson').value) || 0;
    const volaille = parseInt(document.getElementById('pourcentage_volaille').value) || 0;
    const total = viande + poisson + volaille;
    
    const alert = document.getElementById('total_percentage');
    alert.textContent = `Total: ${total}%`;
    alert.className = total === 100 ? 'alert alert-success' : 'alert alert-info';
}
</script>

<?= $this->endSection() ?>
