<?php if($errorMessage): ?>
    <div class="alert alert-danger" role="alert">
        <?= $errorMessage ?>
    </div>
<?php endif; ?>


<div class="container my-4">
  <form action="<?= $router->generate('user-connexion-control')?>" method="POST" class="mt-5">
    <!-- CSRF token pour eviter les attaques CSRF -->
    <input type="hidden" name="csrf_token" value="<?= $token ?>">
    <div class="form-group">
      <label for="email">Email </label>
      <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email">
    </div>
    <div class="form-group">
      <label for="password">Mot de Passe </label>
      <input type="password" class="form-control" id="password" placeholder="mot de passe" name="password">
    </div>
    <button type="submit" class="btn btn-primary btn-block mt-5">Se connecter</button>
    <a href="<?= $router->generate('main-home') ?>" class="btn btn-light btn-block">Retour</a>
  </form>
</div>