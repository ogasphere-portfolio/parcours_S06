<div class="container my-4">
    <a href="<?= $router->generate('product-products') ?>" class="btn btn-success float-right">Retour</a>
    <h2><?= isset($product) ? 'Modifier' : 'Ajouter' ?> un produit</h2>

    <form action="<?= isset($product) ? $router->generate('product-updateProduct', ['id' => $product->getId()])  : $router->generate('product-createProduct')  ?>" method="POST" class="mt-5">
        <!-- CSRF token pour eviter les attaques CSRF -->
        <input type="hidden" name="csrf_token" value="<?= $token ?>">
        <div class="form-group ">
            <input type="hidden" class="form-control" id="id" name="id" value="<?= isset($product) ?  $product->getId() : '' ?>">
        </div>
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= isset($product) ?  $product->getName() : '' ?>">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input value="Ceci est un produit" type="text" class="form-control" name="description" id="description" placeholder="" value="<?= isset($product) ? $product->getDescription() : '' ?>" aria-describedby="subtitleHelpBlock">

        </div>

        <div class="form-group">
            <label for="price">Prix</label>
            <input type="float" class="form-control" name="price" id="price" placeholder="" value="<?= isset($product) ?  $product->getPrice() : '' ?>" aria-describedby="pictureHelpBlock">
        </div>
        <div class="form-group">
            <label for="rate">Note</label>
            <input type="text" class="form-control" id="rate" name="rate" placeholder="Note du produit" value="<?= isset($product) ? $product->getRate() : '' ?>">
        </div>
        <div class="form-group">
            <label for="picture">Image</label>
            <input type="text" class="form-control" id="picture" name="picture" value="<?= isset($product) ? $product->getPicture() : '' ?>" aria-describedby="pictureHelpBlock">
            <small id="pictureHelpBlock" class="form-text text-muted">
                URL relative d'une image (jpg, gif, svg ou png) fournie sur <a href="https://benoclock.github.io/S06-images/" target="_blank">cette page</a>
            </small>
        </div>
       
        <div class="form-group">
            <div class="row">
                <div class="col-4">
                    <label for="brand">Marque :</label>
                    <select name="brand_id" id="brand" class="form-control">
                        <?php foreach ($brands as $brand) : ?>
                            <option value="<?= $brand->getId() ?>" <?= isset($product) && $brand->getId() == $product->getBrandId()  ? ' selected' : '' ?>><?= $brand->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                         
                <div class="col-4">
                    <label for="category">Catégories :</label>
                    <select name="category_id" id="category" class="form-control">
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category->getId() ?>" <?= isset($product) && $category->getId() == $product->getCategoryId() ? ' selected' : '' ?>><?= $category->getName() ?></option>

                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-4">
                    <label for="type">Types de produits :</label>
                    <select name="type_id" id="type" class="form-control">
                        <?php foreach ($types as $type) : ?>
                            <option value="<?= $type->getId() ?>" <?= isset($product) && $type->getId() == $product->getTypeId() ? ' selected' : '' ?>><?= $type->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <?php 
                        foreach($tags as $tag =>$value):?>
                        
                        <label for="tag<?=$tag +1 ?>">""</label><input type="checkbox" name="tags[<?=$tag +1 ?>]" id="tag<?=$tag + 1?>" value="<?= $tag->getId() ?>">
                       
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label for="emplacement5">Emplacement #5</label>
                <select class="form-control" id="emplacement5" name="emplacement[5]">
                    <option value="">choisissez :</option>
                    <?php foreach($categories as $category): ?>
                        <option <?= $category->getHomeOrder() === '5' ? 'selected' : '' ?> value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>
</div>


<!--     <div class="form-group">
                <label for="idType">l'id du Type</label>
                <select name="typeId" id="typeId">
                    <?php for ($i = 1; $i < 51; $i++) : ?>
                    <option value="1"><?= $i ?></option>
                    <?php endfor; ?>
                </select>
                <label for="idBrand">l'id de la Marque</label>
                <select name="brandId" id="brandId">
                    <?php for ($i = 1; $i < 51; $i++) : ?>
                    <option value="1"><?= $i ?></option>
                    <?php endfor; ?>
                </select>
                <label for="idCategory">l'id de la Catégorie</label>
                <select name="brandId" id="brandId">
                    <?php for ($i = 1; $i < 51; $i++) : ?>
                    <option value="1"><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
        </form> -->