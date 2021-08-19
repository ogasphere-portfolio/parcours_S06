
<?php if($errorMessage): ?>
    <div class="alert alert-danger" role="alert">
        <?= $errorMessage ?>
    </div>
<?php endif; ?>

<div class="container my-4">
    <a href="<?= $router->generate('user-users') ?>" class="btn btn-success float-right">Retour</a>
    <h2><?= isset($user) ? 'Modifier' : 'Ajouter' ?> un utilisateur</h2>

    <form action="<?= isset($user) ? $router->generate('user-updateUser', ['id' => $user->getId()]) : $router->generate('user-createUser')  ?>" method="POST" class="mt-5">
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
            <label for="name">Nom</label>
            <input type="name" class="form-control" id="name" placeholder="Nom de l'utilisateur" name="name" value="<?= isset($user) ?  $user->getName() : ''?>">
        </div>
        <div class="form-group">
            <label for="role">Choisir un rôle : </label>
            <select class="form-control" id="role" name="role">
                <option value="user" <?= isset($user) && $user->getRole() == "user" ? ' selected' : '' ?>>User</option>
                <option value="admin" <?= isset($user) && $user->getRole() == "admin" ? ' selected' : '' ?>>Admin</option>
            </select>
        </div>
        <div class="form-group">
                <label for="status">Statut</label>
                <select name="status" id="status" class="form-control">
                    <option value="0"<?= isset($user) && $user->getStatus() == "0" ? ' selected' : '' ?>>-</option>
                    <option value="1"<?= isset($user) && $user->getStatus() == "1" ? ' selected' : '' ?>>actif</option>
                    <option value="2"<?= isset($user) && $user->getStatus() == "2" ? ' selected' : '' ?>>désactivé</option>
                </select>
            </div>
        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>
</div>