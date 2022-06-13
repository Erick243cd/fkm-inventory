<main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">
        <div class="card mb-4 wow fadeIn">
            <div class="card-body d-sm-flex justify-content-between">
                <h4 class="mb-2 mb-sm-0 pt-1">
                    <a href="<?php echo base_url()?>pages/dashboards" target="_blank">Page d'accueil</a>
                    <span>/</span>
                    <span><?php echo $title;?></span>
                </h4>
            </div>
        </div>
       <div class="card fadeIn">
           <div class="card-body">
               <?php echo form_open_multipart('articles/update'); ?>
               <input type="hidden" name="id_article" value="<?= $article['id_article'] ?>">
               <div class="md-form">
                   <label for="">Nom de l'article</label>
                   <input type="text" class="form-control" name="designation" required="required" value="<?= $article['designation'] ?>">
               </div>
               <div class="md-form">
                   <select class="browser-default custom-select mdb-select" name="id_categorie" required="required">
                       <option value="<?= $article['id_categorie'] ?>" selected><?= $article['nom_categorie'] ?></option>
                       <option value="" disabled>Catégorie</option>
                       <?php foreach ($categories as $row):?>
                           <option value="<?= $row->id_categorie; ?>"><?= $row->nom_categorie; ?></option>
                       <?php endforeach;?>
                   </select>
               </div>
               <div class="md-form">
                   <label for="">Prix Unitaire</label>
                   <input type="number" class="form-control" name="prix_unitaire" required="required" value="<?= $article['prix_unitaire'] ?>">
               </div>
               <div class="md-form">
                   <select class="browser-default custom-select mdb-select" name="devise" required="required">
                       <option value="<?= $article['devise'] ?>" selected><?= $article['devise'] ?></option>
                       <option value="USD">USD</option>
                       <option value="CDF">CDF</option>
                   </select>
               </div>
               <div class="md-form">
                   <label for="">Quantité initial</label>
                   <input type="number" class="form-control" name="qte_initial" required="required" value="<?= $article['qte_initial'] ?>">
               </div>
               <div class="col-sm-12 mb-0">
                   <button type="submit" class="btn btn-md blue-gradient mt-3" style="margin-bottom: 10px">Modifier</button>
               </div>
           </div>
           </form>
    </div>
       </div>
    </div>
</main>