<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= $router->generate('main-home') ?>">Skoule</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= $router->generate('main-home') ?>">Accueil <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->generate('teacher-teachers') ?>">Profs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->generate('student-students') ?>">Etudiants</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->generate('user-users') ?>">Utilisateurs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Se déconnecter</a>
                    </li>
                    
                    <?php if(isset($_SESSION['connectedUser']) && $_SESSION['connectedUser'] !== '' && $_SESSION['connectedUser']->getRole() === 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=$router->generate('user-users') ?>">Utilisateurs</a>
                        </li>
                    <?php endif; ?>
                </ul>
                  <!-- Si on est connecté -->
                  <?php if(isset($_SESSION['connectedUser']) && $_SESSION['connectedUser'] !== ''): ?>
                    <!-- On affiche le firstname de l'utilisateur -->
                    <span class="nav-link"><?= $_SESSION['connectedUser']->getFirstname() ?></span>
                    <a class="nav-link" href="<?=$router->generate('auth-disconnect') ?>">Deconnexion</a>
                <?php else: ?>
                    <!-- Lien vers formulaire de connexion -->
                    <a class="nav-link" href="<?=$router->generate('auth-connexion') ?>">Connexion</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

   