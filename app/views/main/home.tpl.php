<div class="container my-4">
  <p class="display-4">
    Bienvenue dans le backOffice <strong>Dans les shoe</strong>...
  </p>

  <div class="row mt-5">
    <div class="col-12 col-md-6">
      <div class="card text-white mb-3">
        <div class="card-header bg-primary">Liste des catégories</div>
        <div class="card-body">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($homeCategories as $homeCategory) : ?>
                <tr>
                  <th scope="row"><?= $homeCategory->getId() ?></th>
                  <td><?= $homeCategory->getName() ?></td>
                  <td class="text-right">
                    <a href="" class="btn btn-sm btn-warning">
                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                    <!-- Example single danger button -->
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Oui, je veux supprimer</a>
                        <a class="dropdown-item" href="#" data-toggle="dropdown">Oups !</a>
                      </div>
                    </div>
                  </td>
                </tr>
              <?php endforeach ; ?>
            </tbody>
          </table>
          <a href="<?= $router->generate('category-categories') ?>" class="btn btn-block btn-success">Voir plus</a>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6">
      <div class="card text-white mb-3">
        <div class="card-header bg-primary">Liste des produits</div>
        <div class="card-body">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($homeProducts as $homeProduct) : ?>
              <tr>
                <th scope="row"><?= $homeProduct->getId() ?></th>
                <td><?= $homeProduct->getName() ?></td>
                <td class="text-right">
                  <a href="" class="btn btn-sm btn-warning">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                  </a>
                  <!-- Example single danger button -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="#">Oui, je veux supprimer</a>
                      <a class="dropdown-item" href="#" data-toggle="dropdown">Oups !</a>
                    </div>
                  </div>
                </td>
              </tr>
              <?php endforeach ; ?>

            </tbody>
          </table>
          <a href="<?= $router->generate('product-products') ?>" class="btn btn-block btn-success">Voir plus</a>
        </div>
      </div>
    </div>
  </div>
</div>