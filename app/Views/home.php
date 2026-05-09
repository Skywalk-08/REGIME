<?= $this->extend('layout') ?>

<?= $this->section('title') ?>Accueil<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="hero py-5">
    <div class="row align-items-center">
        <div class="col-lg-6">
            <h1 class="display-4 fw-bold mb-3">
                <i class="fas fa-leaf"></i> Régime Alimentaire Personnalisé
            </h1>
            <p class="lead mb-4">
                Trouvez le régime alimentaire qui correspond à vos objectifs et transformez votre vie!
            </p>
            <div>
                <?php if (session()->get('logged_in')): ?>
                    <a href="/dashboard" class="btn btn-primary btn-lg me-3">
                        <i class="fas fa-chart-line me-2"></i> Mon Dashboard
                    </a>
                <?php else: ?>
                    <a href="/auth/register-step1" class="btn btn-primary btn-lg me-3">
                        <i class="fas fa-user-plus me-2"></i> S'inscrire
                    </a>
                    <a href="/auth/login" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-sign-in-alt me-2"></i> Se connecter
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-lg-6">
            <img src="https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=500&q=80" 
                 alt="Healthy Food" class="img-fluid rounded-3">
        </div>
    </div>
</div>

<hr class="my-5">

<!-- Features -->
<div class="row my-5">
    <div class="col-md-4 mb-4">
        <div class="text-center">
            <h3 class="mb-3">
                <i class="fas fa-calculator text-primary fa-2x"></i>
            </h3>
            <h5>Calcul d'IMC</h5>
            <p class="text-muted">
                Nous calculons automatiquement votre Indice de Masse Corporelle pour un suivi précis.
            </p>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="text-center">
            <h3 class="mb-3">
                <i class="fas fa-utensils text-success fa-2x"></i>
            </h3>
            <h5>Régimes Variés</h5>
            <p class="text-muted">
                Choisissez parmi nos régimes spécialisés adaptés à vos objectifs de santé.
            </p>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="text-center">
            <h3 class="mb-3">
                <i class="fas fa-crown text-warning fa-2x"></i>
            </h3>
            <h5>Option Premium</h5>
            <p class="text-muted">
                Bénéficiez de 15% de réduction avec notre option premium annuelle.
            </p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
