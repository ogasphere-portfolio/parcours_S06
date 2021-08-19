
  <?php if($errorMessage): ?>
    <div class="alert alert-danger" role="alert">
        <?= $errorMessage ?>
    </div>
<?php endif; ?>

  <div class="container my-4"> <a href="<?= $router->generate('student-students') ?>" class="btn btn-success float-right">Retour</a>
        <h2>Mettre à jour un étudiant</h2>

        <form action="" method="POST" class="mt-5">
             <!-- CSRF token pour eviter les attaques CSRF -->
             <input type="hidden" name="csrf_token" value="<?= $token ?>">   
             <div class="form-group">
                <label for="firstname">Prénom</label>
                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="" value="<?= isset($student) ?  $student->getFirstname() : '' ?>">
            </div>
            <div class="form-group">
                <label for="lastname">Nom</label>
                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="" value="<?= isset($student) ?  $student->getLastname() : '' ?>">
            </div>
            
            <div class=form-group">
                    <label for="teacher">Professeurs :</label>
                    <select name="teacher_id" id="teacher" class="form-control">
                        <?php foreach ($teachers as $teacher) : ?>
                            <option value="<?= $teacher->getId() ?>" <?= isset($student) && $teacher->getId() == $student->getTeacher_id() ? ' selected' : '' ?>><?= $teacher->getFirstname().' '. $teacher->getLastname() ?></option>

                        <?php endforeach; ?>
                    </select>
                </div>


            <div class="form-group">
                <label for="status">Statut</label>
                <select name="status" id="status" class="form-control">
                    <option value="0"<?= isset($student) && $student->getStatus() == "0" ? ' selected' : '' ?>>-</option>
                    <option value="1"<?= isset($student) && $student->getStatus() == "1" ? ' selected' : '' ?>>actif</option>
                    <option value="2"<?= isset($student) && $student->getStatus() == "2" ? ' selected' : '' ?>>désactivé</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
        </form>
    </div>

   