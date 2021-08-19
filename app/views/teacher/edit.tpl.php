
<?php if($errorMessage): ?>
    <div class="alert alert-danger" role="alert">
        <?= $errorMessage ?>
    </div>
<?php endif; ?>

   
    <div class="container my-4"> <a href="<?= $router->generate('teacher-teachers') ?>" class="btn btn-success float-right">Retour</a>
    <h2><?= isset($teacher) ? 'Modifier' : 'Ajouter' ?> un prof</h2>

        <form action="<?= isset($teacher) ? $router->generate('teacher-updateTeacher', ['id' => $teacher->getId()]) : $router->generate('teacher-createTeacher')  ?>" method="POST" class="mt-5">
            <!-- CSRF token pour eviter les attaques CSRF -->
            <input type="hidden" name="csrf_token" value="<?= $token ?>">    
            <div class="form-group">
                <label for="firstname">Prénom</label>
                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="" value="<?= isset($teacher) ?  $teacher->getFirstname() : '' ?>">
            </div>
            <div class="form-group">
                <label for="lastname">Nom</label>
                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="" value="<?= isset($teacher) ?  $teacher->getLastname() : '' ?>">
            </div>

            <div class="form-group">
                <label for="job">Job</label>
                <input type="text" class="form-control" name="job" id="job" placeholder="" value="<?= isset($teacher) ?  $teacher->getJob() : '' ?>">
            </div>
            <div class="form-group">
                <label for="status">Statut</label>
                <select name="status" id="status" class="form-control">
                    <option value="0"<?= isset($teacher) && $teacher->getStatus() == "0" ? ' selected' : '' ?>>-</option>
                    <option value="1"<?= isset($teacher) && $teacher->getStatus() == "1" ? ' selected' : '' ?>>actif</option>
                    <option value="2"<?= isset($teacher) && $teacher->getStatus() == "2" ? ' selected' : '' ?>>désactivé</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
        </form>
    </div>

   