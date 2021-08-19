
<div class="container my-4">
    <a href="<?= $router->generate('user-users') ?>" class="btn btn-success float-right">Retour</a>
    <h2><?= isset($user) ? 'Modifier' : 'Ajouter' ?> un utilisateur</h2>

    <form action="<?= $router->generate('user-createUser') ?>" method="POST" class="mt-5">
        <!-- CSRF token pour eviter les attaques CSRF -->
        <input type="hidden" name="csrf_token" value="<?= $token ?>">
        <div class="form-group">
            <label for="name">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Email de l'utilisateur" name="email" value="<?= isset($user) ? $user->getEmail() : '' ?>">
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" id="password" placeholder="Mot de passe de l'utilisateur" name="password" value="<?= isset($user) ? $user->getPassword() : '' ?>">
        </div>
        
        <div class="form-group">
            <label for="lastname">Nom</label>
            <input value="adelbert" type="name" class="form-control" id="lastname" placeholder="Nom de l'utilisateur" name="lastname" value="<?= isset($user) ?  $user->getName() : ''?>">
        </div>
        <div class="form-group">
            <label for="role">Choisir un rôle : </label>
            <select class="form-control" id="role" name="role">
                <option value="catalog-manager">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <div class="form-group">
            <label for="status">Choisir un statut</label>
            <select class="form-control" id="status" name="status">
                <option value="-" disabled>-</option>
                <option value=1>Actif</option>
                <option value=2>Désactivé</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>
</div>