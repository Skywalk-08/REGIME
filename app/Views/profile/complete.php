<?= $this->extend('layout') ?>

<?= $this->section('title') ?>Complétez votre profil<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body p-5">
                <h3 class="card-title text-center mb-4">
                    <i class="fas fa-target"></i> Définissez vos objectifs
                </h3>

                <p class="text-center text-muted mb-4">Sélectionnez jusqu'à 3 objectifs</p>

                <form method="POST" action="/profile/save-objectives">
                    <?= csrf_field() ?>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="objectives[]" 
                                       id="gain_weight" value="gain_weight">
                                <label class="form-check-label" for="gain_weight">
                                    <i class="fas fa-arrow-up text-success"></i> Augmenter mon poids
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="objectives[]" 
                                       id="lose_weight" value="lose_weight">
                                <label class="form-check-label" for="lose_weight">
                                    <i class="fas fa-arrow-down text-danger"></i> Réduire mon poids
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="objectives[]" 
                                       id="ideal_imc" value="ideal_imc">
                                <label class="form-check-label" for="ideal_imc">
                                    <i class="fas fa-heart text-primary"></i> Atteindre mon IMC idéal
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <strong>Votre profil actuel:</strong>
                        <ul class="mb-0">
                            <li>Taille: <?= $user['taille'] ?> cm</li>
                            <li>Poids: <?= $user['poids'] ?> kg</li>
                            <li>IMC: <?= $user['imc'] ?></li>
                        </ul>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-check-circle me-2"></i> Continuer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
